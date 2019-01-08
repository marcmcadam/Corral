<?php
    session_start();
    require_once "staffauth.php";
    
    header('Cache-Control: no-cache');

    require_once "solver.php";
    require_once "getdata.php";

    sortingData($unitID, $skillNames, $sort, $students, $projects);

    $numSkills = 20;

    echo "<!DOCTYPE html>
    <html>
        <head>
            <meta charset='utf-8'>
            <title>Sorting</title>
            <link rel='stylesheet' type='text/css' href='styles.css'>
            <link rel='icon' type='image/ico' href='favicon.ico'>
        </head>
    <body><div class='main' style='text-align: left; min-height: 1024px;'>";

    if (isset($sort->pid))
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
    echo "<p>To stop the sorting <a href='terminatesort?unit=$unitID&method=stop' target='_blank'>click here</a>.</p>";
    echo "<p>View the group changes from <a href='sortedgroups' target='_blank'>this page</a>.</p>";
    update();

    // store the process id and set that the sorter is not signalled to stop
    $sortPID = getmypid();
    $sql = "UPDATE unit SET sort_pid=$sortPID, sort_stop=0 WHERE unit_ID='$unitID'";
    $res = mysqli_query($CON, $sql);
    if (!$res)
    {
        echo "Error: " . mysqli_error($CON);
        die;
    }

    /* -- don't delete all. need to keep assignments that are locked
        // delete all student project assignments
        $sql = "TRUNCATE groups";
        if (!mysqli_query($CON, $sql))
            echo "<p>Error deleting project member: " . mysqli_error($CON) . "</p>";

        echo "<p>Assignments erased</p>";
        update();
    */


    // generate dummy students to allow empty slots in groups for variable group sizes
    // the number of dummies needed depends on the difference between the total max size for projects and the number of students
    $slots = 0;
    foreach ($projects as $p => $project)
        $slots += $project->allocation;
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

            $dummy = new Student();
            $dummy->skills = array_fill(0, $numSkills, 0);
            array_push($students, $dummy);
        }

        echo "<p>Dummy students created</p>";
        update();
    }

    if ($slots != sizeof($students))
    {
        echo "<p>Sizes of student and task arrays do not match</p>";
        die;
    }


    // assign students randomly first
    /*
    $studentIndices = range(0, $clevers - 1);
    shuffle($studentIndices);
    //assign dummies last
    for ($i = $clevers; $i < sizeof($students); $i += 1)
        array_push($studentIndices, $i);
    */
    $lockedStudents = [];
    $numStudents = sizeof($students);
    $projectsLockedSize = array_fill(0, sizeof($projects), 0);
    foreach ($students as $y => $student)
    {
        if ($student->projectLocked)
        {
            array_push($lockedStudents, $y);
            $p = $student->projectIndex;
            $numStudents -= 1;
            if (!is_null($p))
                $projectsLockedSize[$p] += 1;
        }
    }

    /*
    // free up all unlocked students
    $projectStudents = array_fill(0, sizeof($projects), []);
    for ($y = 0; $y < sizeof($students); $y += 1)
    {
        if (!$studentLocks[$y])
            $studentProjects[$y] = -1;
    }
    */

    // collect unassigned students
    $freeStudents = [];
    foreach ($students as $y => $student)
    {
        if (!$student->projectLocked && is_null($student->projectIndex))
            array_push($freeStudents, $y);
    }
    // free up excess students in groups
    foreach ($projects as $p => $project)
    {
        $members = sizeof($project->studentIndices);
        $capacity = $project->allocation;
        $n = $members - $capacity; // number of excess students
        // free up some unlocked excess students to reduce this project
        $freed = 0;
        foreach ($project->studentIndices as $i => $y)
        {
            $student = $students[$y];
            if ($freed >= $n)
                break;
            if (!$student->projectLocked)
            {
                $student->projectIndex = null;
                array_push($freeStudents, $y);
                unset($project->studentIndices[$i]);
                $freed += 1;
            }
        }
        if ($freed < $n)
            die("A project is locked over capacity. Please increase capacity or unlock.");
        // remove the null values
        $nextProjectStudents = [];
        foreach ($project->studentIndices as $y)
            array_push($nextProjectStudents, $y);
        $project->studentIndices = $nextProjectStudents;
    }

    $databaseChanges = [];
    $index = 0;
    $numFreeStudents = sizeof($freeStudents);
    // fill minimum requirements
    foreach ($projects as $p => $project)
    {
        $members = sizeof($project->studentIndices);
        $capacity = $project->allocation;
        $n = $capacity - $members; // number of extra students needed
        for ($t = 0; $t < $n; $t += 1)
        {
            if ($index >= $numFreeStudents)
                die("No students left. Needed $n more for project $p with $members members out of $capacity.
                        Of $numFreeStudents free students, already used $index.");
            $y = $freeStudents[$index++];
            $student = $students[$y];

            $student->projectIndex = $p;
            array_push($project->studentIndices, $y);

            $databaseChanges[$y] = $p;
        }
    }
    if ($index != $numFreeStudents)
        die("Not all students able to be assigned.");

    /* -- changed this to leave all students where they are at the start, so it resumes from last in all ways
    // assign unlocked students to random tasks to begin with
    $index = 0;
    // fill minimum requirements first
    for ($p = 0; $p < sizeof($projects); $p += 1)
    {
        $n = $projectMinima[$p] - $projectsLockedSize[$p];
        if ($n < 0)
            die("A project is locked over capacity. Please increase capacity or unlock.");
        for ($t = 0; $t < $n; $t += 1)
        {
            do $y = $studentIndices[$index++]; while ($studentLocks[$y]);
            $studentProjects[$y] = $p;
            array_push($projectStudents[$p], $y);
        }
    }
    */
    /* -- should not be any variation with proportionally set numbers
    // assign the rest to projects with space
    $projectsMaxSize = 0;
    for ($p = 0; $p < sizeof($projects); $p += 1)
    {
        $projectsMaxSize = max($projectsMaxSize, $projectMaxima[$p]);

        $n = $projectMaxima[$p] - $projectMinima[$p];
        for ($t = 0; $t < $n; $t += 1)
        {
            do $y = $studentIndices[$index++]; while ($studentLocks[$y]);
            $studentProjects[$y] = $p;
            array_push($projectStudents[$p], $y);
        }
    }
    */
    /*
    if ($index != $slots)
    {
        echo "<p>Did not place the right number of students into projects</p>";
        die;
    }
    */
    $numChanges = sizeof($databaseChanges);
    echo "<p>Setting starting group for $numChanges students</p>";
    update();

    assignDatabase($databaseChanges);

    // remove students who are locked to eliminate them from sorting
    foreach ($lockedStudents as $y)
    {
        $student = $students[$y];
        unset($students[$y]);
        $student->projectIndex = null;
    }
    if (sizeof($students) == 0)
        die("There are no unlocked students to sort.");
    echo "<p>Sorting $numStudents students</p>";

    // remake getdata arrays for these changes
    foreach ($projects as $p => $project)
        $project->studentIndices = [];
    foreach ($students as $y => $student)
        array_push($projects[$student->projectIndex]->studentIndices, $y); // all $projectIndex of remaining $students should be set

    $usedSkills = [];
    for ($s = 0; $s < $numSkills; $s += 1)
    {
        if (!is_null($skillNames[$s]))
            array_push($usedSkills, $s);
    }


    $maxInertia = $sort->inertia;
    $batchSize = min($sort->matrix, $numStudents); // large batch sizes can breach the PHP memory limit
    //$batchRatio = 2.0 * max(sizeof($students) / $batchSize, 1.0);
    //$numBatches = (int)ceil($batchRatio * $batchRatio);
    $numBatches = $sort->iterations;

    echo "<p>Total batches: $numBatches</p>";
    update();

    for ($batch = 0; $batch < $numBatches; $batch += 1)
    {
        $progress = $batch / $numBatches;

        $sql = "SELECT sort_pid, sort_stop FROM unit WHERE unit_ID='$unitID'";
        $res = mysqli_query($CON, $sql);
        if (!$res)
        {
            echo "Error: " . mysqli_error($CON);
            die;
        }

        if ($row = mysqli_fetch_assoc($res))
        {
            $pid = $row["sort_pid"];
            $stop = $row["sort_stop"];
        }
        else
            die("Unit missing.");

        if ($pid != $sortPID || $stop)
        {
            echo "<p>Sorting terminated</p>";
            break;
        }

        // split the students into separate batches randomly
        $projectStudentIndices = [];
        foreach ($projects as $p => $project)
            $projectStudentIndices[$p] = shuffleIndices(sizeof($project->studentIndices));

        $numGroups = (int)ceil($numStudents / $batchSize);
        $projectStudentIndex = array_fill(0, sizeof($projects), 0);

        $projectSkills = [];
        foreach ($projects as $p => $project)
            $projectSkills[$p] = $project->skills;

        $toDatabase = [];
        for ($g = 0; $g < $numGroups; $g += 1)
        {
            $solver = new Solver();
            $solver->numSkills = $numSkills;
            $solver->usedSkills = $usedSkills;

            $solver->randomisation = $sort->random;
            $solver->inertia = (int)($maxInertia * $progress * $progress); // progress squared so that inertia is mostly applied near the end of the processing

            $solver->students = [];
            $solver->projects = $projectSkills;

            $solver->tasks = [];
            $solver->projectTasks = array_fill(0, sizeof($projects), []);

            $solver->projectStudents = array_fill(0, sizeof($projects), []);
            $solver->studentProjects = array_fill(0, sizeof($students), -1);

            $solver->dummies = [];
            $solver->projectMinima = null; // currently not used

            $solverStudents = [];

            $remainingGroups = $numGroups - $g;

            $nextSolverY = 0;
            foreach ($projects as $p => $project)
            {
                $position = $projectStudentIndex[$p];

                $remainingStudents = sizeof($project->studentIndices) - $position;
                $r = 0.01 * rand(0, 99); // random rounding. allows groups with less than one student per project, to avoid taking zero students or all students at once
                $takeSize = floor($remainingStudents / $remainingGroups + $r);

                $projectStudentIndex[$p] = $position + $takeSize;

                for ($i = 0; $i < $takeSize; $i += 1)
                {
                    $y = $project->studentIndices[$projectStudentIndices[$p][$position + $i]];
                    $student = $students[$y];

                    $solverY = $nextSolverY++;
                    $solver->students[$solverY] = $student->skills;

                    $solverStudents[$solverY] = $y;

                    if ($y >= $clevers)
                        array_push($solver->dummies, $solverY);

                    if ($student->projectIndex != $p)
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

            if ($nextSolverY >= 2) // empty students array causes an error
            {
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
                    if ($students[$y]->projectIndex != $p)
                        $toDatabase[$y] = $p;
                }
            }
        }

        foreach ($toDatabase as $y => $p)
            $students[$y]->projectIndex = $p;

        foreach ($projects as $p => $project)
            $project->studentIndices = [];
        foreach ($students as $y => $student)
        {
            if (!is_null($student->projectIndex))
                array_push($projects[$student->projectIndex]->studentIndices, $y);
        }
        assignDatabase($toDatabase);

        $cost = $solver->cost;
        $progress = -$cost;
        $swaps = sizeof($toDatabase);

        echo "<p>Completed batch: $batch, skill gain: $progress, students swapped: $swaps</p>";
        update();
    }
    echo "<p>Finished</p>";

    $sql = "UPDATE unit SET sort_pid=null WHERE unit_ID='$unitID'";
    $res = mysqli_query($CON, $sql);
    if (!$res)
    {
        echo "Error: " . mysqli_error($CON);
        die;
    }

    function assignDatabase($studentProjects)
    {
        global $unitID;
        global $CON;
        global $students;
        global $projects;

        foreach ($studentProjects as $y => $p)
        {
            set_time_limit(30); // each entry should be quick, but in total can take a long time

            $student = $students[$y];
            $sid = $student->id;

            if (is_null($p))
                $pid = "null";
            else
            {
                $project = $projects[$p];
                $pid = $project->id;
            }

            $sql = "UPDATE surveyanswer SET pro_ID=$pid WHERE stu_id=$sid AND unit_ID='$unitID'";
            if (!mysqli_query($CON, $sql))
                echo "Error assigning project member: " . mysqli_error($CON) . "<br>";
        }
    }
?>
