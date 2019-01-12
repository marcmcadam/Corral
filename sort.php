<?php
    header('Cache-Control: no-cache');
    
    session_start();
    require_once "staffauth.php";
    session_write_close(); // allows other pages to load this session

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
    $sql = "UPDATE unit SET sort_pid=$sortPID, sort_stop=0, sort_i=0, sort_m=0 WHERE unit_ID='$unitID'";
    $res = mysqli_query($CON, $sql);
    if (!$res)
    {
        echo "Error: " . mysqli_error($CON);
        die;
    }

    // generate dummy students to allow empty slots in groups for variable group sizes
    // the number of dummies needed depends on the difference between the total max size for projects and the number of students
    $slots = 0;
    foreach ($projects as $p => $project)
        $slots += $project->slots;
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

    $lockedStudents = [];
    $projectsLockedSize = array_fill(0, sizeof($projects), 0);
    foreach ($students as $y => $student)
    {
        if ($student->projectLocked)
        {
            array_push($lockedStudents, $y);
            $p = $student->projectIndex;
            if (!is_null($p))
                $projectsLockedSize[$p] += 1;
        }
    }

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
        $capacity = $project->slots; // or ->slots variable, shouldn't matter for this
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
        $capacity = $project->slots;
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

    // the number of slots being the same as the number of students depends on
    // whether the 2-stages of getdata.php->distribute() work correctly

    if ($index != $numFreeStudents)
        die("Distribution failed: not all students were able to be assigned.");

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
    // clean out unset entries
    $nextStudents = [];
    foreach ($students as $y => $student)
        $nextStudents[$y] = $student;
    $students = $nextStudents;

    $numStudents = sizeof($students);
    if ($numStudents == 0)
        die("There are no unlocked students to sort.");
    echo "<p>Sorting $numStudents students</p>";

    // remake getdata project->students arrays for these changes
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


    // $maxInertia = $sort->inertia;

    // set starting maxtix size to a number where the amount of improvement done is worthwhile compared to the overhead of the SQL updates
    // cannot have more size than students, because each row is a student
    // better to have less size than projects, otherwise changing multiple students in/out of a group can lead to looping changes
    $matrixLimit = min(sizeof($students), sizeof($projects));
    $endMatrixSize = min($sort->matrix, $matrixLimit);
    $matrixSize = min(min(10, $sort->matrix), $matrixLimit);
    echo "<p>Iterations limit: $sort->iterations, Matrix size limit: $endMatrixSize</p>";
    echo "<p>Matrix size: $matrixSize</p>";
    update();

    $matrixMultiplier = 1.25; // how much to multiply the size of the matrix when there are no swaps

    $noSwapsCount = 0;
    for ($batch = 0; $batch < $sort->iterations; $batch += 1)
    {
        // $progress = $batch / $sort->iterations;

        $sql = "UPDATE unit SET sort_i=$batch, sort_m=$matrixSize WHERE unit_ID='$unitID'";
        $res = mysqli_query($CON, $sql);
        if (!$res)
            die("Unable to set progress: " . mysqli_error($CON));

        $sql = "SELECT sort_pid, sort_stop FROM unit WHERE unit_ID='$unitID'";
        $res = mysqli_query($CON, $sql);
        if (!$res)
            die("Error: " . mysqli_error($CON));

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

        $numGroups = (int)ceil($numStudents / $matrixSize);
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
            $solver->inertia = 0; // (int)($maxInertia * $progress * $progress); // progress squared so that inertia is mostly applied near the end of the processing

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
                    die("Solver encountered an error.");

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
        if ($matrixSize < $endMatrixSize)
        {
            if ($swaps * $matrixSize < $numStudents)
            {
                $matrixSize = (int)ceil($matrixSize * $matrixMultiplier);
                $matrixSize = min($matrixSize, $endMatrixSize);
                echo "<p>Matrix size: $matrixSize</p>";
            }
        }
        else
        {
            if ($swaps == 0)
            {
                $noSwapsCount += 1;
                if ($noSwapsCount >= 10)
                {
                    echo "Sorting completed";
                    break;
                }
            }
            else
                $noSwapsCount = 0;
        }
        
        update();
    }
    echo "<p>Stopped</p>";

    $sql = "UPDATE unit SET sort_pid=null WHERE unit_ID='$unitID'";
    $res = mysqli_query($CON, $sql);
    if (!$res)
        die("Unable to unset flags: " . mysqli_error($CON));

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
