<?php
    header('Cache-Control: no-cache');
    $id = "staffuser@deakin.edu.au";
    require_once "solver.php";
    require_once "getdata.php";

    echo "<!DOCTYPE html>
    <html>
        <head>
            <meta charset='utf-8'>
            <title>Sorting</title>
            <link rel='stylesheet' type='text/css' href='styles.css'>
            <link rel='icon' type='image/ico' href='favicon.ico'>
        </head>
    <body><div class='main' style='text-align: left; min-height: 1024px;'>";

    if (isset($sortPID))
    {
        echo "<p>Stop the previous sort before starting a new one.</p>";
        die;
    }

    $displayBatches = false;

    function update()
    {
        ob_flush();
        flush();
    }

    echo "<strong>Avoid closing this page unless sorting has been stopped.</strong>";
    echo "<p>To stop the sorting <a href='terminatesort' target='_blank'>click here</a>.</p>";
    echo "<p>View the progress from <a href='sortedgroups' target='_blank'>this page</a>.</p>";
    echo "<p>Begin initialisation</p>";
    update();

    $sortPID = getmypid();

    $sql = "UPDATE staff SET sort_pid = $sortPID WHERE sta_Email = '$id'";
    $res = mysqli_query($CON, $sql);
    if (!$res)
    {
        echo "Error: " . mysqli_error($CON);
        die;
    }

    // delete all student project assignments
    $sql = "TRUNCATE groups";
    if (!mysqli_query($CON, $sql))
        echo "<p>Error deleting project member: " . mysqli_error($CON) . "</p>";

    echo "<p>Assignments erased</p>";
    update();

    // generate dummy students to allow empty slots in groups for variable group sizes
    // the number of dummies needed depends on the difference between the total max size for projects and the number of students
    $slots = 0;
    for ($p = 0; $p < sizeof($projects); $p += 1)
        $slots += $projectMaxima[$p];
    if ($slots < sizeof($students))
    {
        echo "<p>Too few tasks for the number of students</p>";
        die;
    }

    $clevers = sizeof($students);
    if ($clevers < $slots)
    {
        for ($i = $clevers; $i < $slots; $i += 1)
        {
            $y = sizeof($students);
            array_push($students, array_fill(0, $numSkills, 0));
        }
        
        echo "<p>Dummy students created</p>";
        update();
    }

    if ($slots != sizeof($students))
    {
        echo "<p>Sizes of student and task arrays do not match</p>";
        die;
    }


    // assign students to random tasks to begin with
    $projectStudents = array_fill(0, sizeof($projects), []);
    $studentProjects = array_fill(0, sizeof($students), -1);

    // assign students randomly first
    $studentIndices = range(0, $clevers - 1);
    shuffle($studentIndices);
    //assign dummies last
    for ($i = $clevers; $i < sizeof($students); $i += 1)
        array_push($studentIndices, $i);

    $index = 0;
    // fill minimum requirements first
    for ($p = 0; $p < sizeof($projects); $p += 1)
    {
        $n = $projectMinima[$p];
        for ($t = 0; $t < $n; $t += 1)
        {
            $y = $studentIndices[$index++];
            $studentProjects[$y] = $p;
            array_push($projectStudents[$p], $y);
        }
    }
    // assign the rest to projects with space
    $projectsMaxSize = 0;
    for ($p = 0; $p < sizeof($projects); $p += 1)
    {
        $projectsMaxSize = max($projectsMaxSize, $projectMaxima[$p]);

        $n = $projectMaxima[$p] - $projectMinima[$p];
        for ($t = 0; $t < $n; $t += 1)
        {
            $y = $studentIndices[$index++];
            $studentProjects[$y] = $p;
            array_push($projectStudents[$p], $y);
        }
    }
    if ($index != sizeof($students))
    {
        echo "<p>Did not place the right number of students into projects</p>";
        die;
    }

    echo "<p>Random assignments created</p>";
    update();

    assignDatabase($studentProjects, false);

    $usedSkills = [];
    for ($s = 0; $s < $numSkills; $s += 1)
        array_push($usedSkills, !is_null($skillNames[$s]));

    $maxInertia = $sortInertia;
    $queue = [];
    $projectsRequeue = $projectStudents;
    $batchSize = min($sortMatrix, sizeof($students)); // large batch sizes can breach the PHP memory limit
    //$batchRatio = 2.0 * max(sizeof($students) / $batchSize, 1.0);
    //$numBatches = (int)ceil($batchRatio * $batchRatio);
    $numBatches = $sortIterations;
    echo "<p>Total batches: $numBatches</p>";
    for ($batch = 0; $batch < $numBatches; $batch += 1)
    {
        $progress = $batch / $numBatches;
            
        $sql = "SELECT sta_Email, sort_pid FROM staff WHERE sta_Email = '$id'";
        $res = mysqli_query($CON, $sql);
        if (!$res)
        {
            echo "Error: " . mysqli_error($CON);
            die;
        }

        if ($row = mysqli_fetch_assoc($res))
            $pid = $row["sort_pid"];
        else
            $pid = null;

        if ($pid != $sortPID)
        {
            echo "<p>Sorting terminated</p>";
            break;
        }

        echo "<p>Batch: $batch</p>";
        update();

        // split the students into separate batches randomly
        $projectStudentIndices = [];
        for ($p = 0; $p < sizeof($projects); $p += 1)
        {
            $indices = range(0, sizeof($projectStudents[$p]) - 1);

            // shuffle() is very repetitive. shuffle manually:
            $choices = range(0, sizeof($projectStudents[$p]) - 1);
            $shuffled = [];
            $choicesRemaining = sizeof($choices);
            foreach ($indices as $index)
            {
                $last = $choicesRemaining - 1;
                $chosen = random_int(0, $last);
                $choice = $choices[$chosen];
                $shuffled[$choice] = $index;
                if ($chosen < $last);
                    $choices[$chosen] = $choices[$last];
                unset($choices[$last]);
                $choicesRemaining -= 1;
            }
            if ($choicesRemaining != 0)
            {
                echo "Shuffle failed";
                die;
            }

            $projectStudentIndices[$p] = $shuffled;
        }

        $numGroups = (int)ceil(sizeof($students) / $batchSize);
        $projectStudentIndex = array_fill(0, sizeof($projects), 0);

        $toDatabase = [];
        for ($g = 0; $g < $numGroups; $g += 1)
        {
            $solver = new Solver();
            $solver->numSkills = $numSkills;
            $solver->usedSkills = $usedSkills;

            $solver->randomisation = $sortRandom;
            $solver->inertia = (int)($maxInertia * $progress * $progress); // progress squared so that inertia is mostly applied near the end of the processing

            $solver->students = [];
            $solver->projects = $projects;

            $solver->tasks = [];
            $solver->projectTasks = array_fill(0, sizeof($projects), []);

            $solver->projectStudents = array_fill(0, sizeof($projects), []);
            $solver->studentProjects = array_fill(0, sizeof($students), -1);

            $solver->dummies = [];
            $solver->projectMinima = $projectMinima;

            $solverStudents = [];

            $remainingGroups = $numGroups - $g;

            $nextSolverY = 0;
            for ($p = 0; $p < sizeof($projects); $p += 1)
            {
                $position = $projectStudentIndex[$p];

                $remainingStudents = sizeof($projectStudents[$p]) - $position;
                $r = 0.01 * rand(0, 99); // random rounding. allows groups with less than one student per project, to avoid taking zero students or all students at once
                $takeSize = floor($remainingStudents / $remainingGroups + $r);

                $projectStudentIndex[$p] = $position + $takeSize;

                for ($i = 0; $i < $takeSize; $i += 1)
                {
                    $y = $projectStudents[$p][$projectStudentIndices[$p][$position + $i]];

                    $solverY = $nextSolverY++;
                    $solver->students[$solverY] = $students[$y];

                    $solverStudents[$solverY] = $y;

                    if ($y < $clevers)
                        array_push($solver->dummies, $solverY);

                    if ($studentProjects[$y] != $p)
                        echo "Student not in expected project";

                    $solver->studentProjects[$solverY] = $p;
                    array_push($solver->projectStudents[$p], $solverY);

                    $taskIndex = sizeof($solver->tasks);
                    array_push($solver->tasks, $p);
                    array_push($solver->projectTasks[$p], $taskIndex);
                }
            }

            if ($displayBatches)
            {
                asort($solverStudents);
                echo "<table cellpadding='4px' style='border-collapse: collapse;'><tr>";
                foreach ($solverStudents as $y)
                    echo "<td>$y</td>";
                echo "</tr></table>";
                update();
            }

            set_time_limit(30);
            $solver->iterate();
            if ($solver->iteration < 0)
            {
                echo "<p>Solver encountered an error.</p>";
                die;
            }

            foreach ($solver->studentProjects as $solverY => $p)
            {
                $y = $solverStudents[$solverY];
                if ($studentProjects[$y] != $p)
                    $toDatabase[$y] = $p;
                array_push($projectsRequeue[$p], $y);
            }
        }

        foreach ($toDatabase as $y => $p)
            $studentProjects[$y] = $p;

        $projectStudents = array_fill(0, sizeof($projects), []);
        foreach ($studentProjects as $y => $p)
            array_push($projectStudents[$p], $y);

        assignDatabase($toDatabase);

        $cost = $solver->cost;
        $progress = -$cost;
        $swaps = sizeof($toDatabase);

        echo "<p>Gain: $progress, Swaps: $swaps</p>";
    }
    echo "<p>Finished</p>";

    $sql = "UPDATE staff SET sort_pid = null WHERE sta_Email = '$id'";
    $res = mysqli_query($CON, $sql);
    if (!$res)
    {
        echo "Error: " . mysqli_error($CON);
        die;
    }

    function assignDatabase($studentProjects, $delete = true)
    {
        global $CON;
        global $solver;
        global $studentNames;
        global $projectNames;

        foreach ($studentProjects as $x => $p)
        {
            set_time_limit(30); // each entry should be quick, but in total can take a long time

            if (!array_key_exists($x, $studentNames))
                continue;

            $sid = $studentNames[$x];
            $pid = $projectNames[$p];

            if ($delete)
            {
                // delete student project assignments
                $sql = "DELETE FROM groups WHERE stu_id = $sid";
                if (!mysqli_query($CON, $sql))
                    echo "Error deleting project member: " . mysqli_error($CON) . "<br>";
            }

            // create new assignment
            $sql = "INSERT INTO groups (pro_num, stu_id) VALUES ($pid, $sid)";
            if (!mysqli_query($CON, $sql))
                echo "Error assigning project member: " . mysqli_error($CON) . "<br>";
        }
    }
?>
