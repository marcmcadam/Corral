<?php
    header('Cache-Control: no-cache');
    
    session_start();
    require_once "staffauth.php";
    session_write_close(); // allows other pages to load this session

    require_once "solver.php";
    require_once "unitdata.php";

    $unitData = unitData($unitID);
    $skillNames = $unitData->skillNames;
    $sort = $unitData->sort;
    $students = $unitData->students;
    $projects = $unitData->projects;
    $unassigned = $unitData->unassigned;

    $numSkills = 20;

    echo "<!DOCTYPE html>
    <html>
        <head>
            <meta charset='utf-8'>
            <title>Sorting</title>
            <link rel='stylesheet' type='text/css' href='styles.css'>
            <link rel='icon' type='image/ico' href='favicon.ico'>
        </head>
        <body><div class='main' style='text-align: left;'>";

    if (isset($sort->pid))
    {
        echo "<p>Stop the previous sort before starting a new one.</p>";
        die;
    }

    $displayBatches = false;
    $updateDatabase = true;

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
    
    if ($updateDatabase)
    {
        echo "<p>Setting starting group for $numChanges students</p>";
        update();
        assignDatabase($databaseChanges);
    }

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
    $matrixSize = $endMatrixSize;
    //$matrixSize = min(min(10, $sort->matrix), $matrixLimit);
    echo "<p>Iterations limit: $sort->iterations, Matrix size limit: $endMatrixSize</p>";
    echo "<p>Matrix size: $matrixSize</p>";
    update();

    $matrixMultiplier = 1.25; // how much to multiply the size of the matrix when there are no swaps

    $projectSkills = [];
    foreach ($projects as $p => $project)
        $projectSkills[$p] = $project->skills;

    $noSwapsCount = 0;
    $batch = 0;
    $swaps = 0;
    while (true)
    {
        // score the current situation
        $progress = 0.0;
        $samples = 0.0;
        foreach ($projects as $p => $project)
        {
            //$total = 0.0;
            $total = sizeof($project->studentIndices);
            foreach ($usedSkills as $s)
            {
                $sum = 0.0;
                $demand = $projectSkills[$p][$s];
                foreach ($project->studentIndices as $y)
                {
                    $memberScore = Solver::memberScore($demand, $students[$y]->skills[$s]);
                    $sum += $memberScore;
                    //$total += $change;
                }
                if ($total > 0.0)
                {
                    $progress += $demand->importance * ($sum / $total);
                    $samples += $demand->importance;
                }
            }
        }
        $progress /= $samples; // divide-out factors that change with settings

        // display the stats
        echo "<p>Iterations Completed: $batch, Group Quality Score: ".number_format(100 * $progress, 4)."%, Students Swaps: $swaps</p>";

        if ($matrixSize < $endMatrixSize)
        {
            // matrix size can increase
            if ($swaps * $matrixSize < $numStudents)
            {
                // sorting is having little affect. increase matrix size
                $matrixSize = (int)ceil($matrixSize * $matrixMultiplier);
                $matrixSize = min($matrixSize, $endMatrixSize);
                echo "<p>Matrix size: $matrixSize</p>";
            }
        }
        else
        {
            // matrix is at size limit
            if ($swaps == 0)
            {
                // nothing is changing
                $noSwapsCount += 1;
                if ($noSwapsCount >= 10)
                {
                    // nothing has changed for a while
                    echo "Sorting completed";
                    break;
                }
            }
            else // don't count to exit the loop, unless at maximum size
                $noSwapsCount = 0;
        }
        update();

        // update the database progress stats
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

        $batch += 1;
        if ($batch >= $sort->iterations)
            break;

        $toDatabase = [];
        
        $shuffledStudents = shuffleIndices(sizeof($students));
        $splits = (int)ceil(sizeof($students) / $matrixSize);
        $index = 0;
        for ($g = 0; $g < $splits; $g += 1)
        {
            $solver = new Solver();
            $solver->numSkills = $numSkills;
            $solver->usedSkills = $usedSkills;
    
            $solver->randomisation = 1; // $sort->random;
            $solver->inertia = 1; // (int)($maxInertia * $progress * $progress); // progress squared so that inertia is mostly applied near the end of the processing
    
            $solver->students = [];
            $solver->projects = $projectSkills;
    
            $solver->tasks = [];
            $solver->projectTasks = array_fill(0, sizeof($projects), []);
            $solver->taskStudents = [];
    
            $solver->projectStudents = array_fill(0, sizeof($projects), []);
            $solver->studentProjects = array_fill(0, sizeof($students), -1);
    
            $solver->dummies = [];
            $solver->projectMinima = null; // currently not used
    
            $solverStudents = [];
    

            $takenProjects = [];
            $solverY = 0;
            while ($solverY < $matrixSize)
            {
                if ($index >= sizeof($students))
                    break;
                $y = $shuffledStudents[$index];
                $index += 1;
                $student = $students[$y];
                $p = $student->projectIndex;

                if (array_key_exists($p, $takenProjects))
                    continue;
                $takenProjects[$p] = null; // signal p is used (as hashed key for quick access)

                $solver->students[$solverY] = $student->skills;

                $solverStudents[$solverY] = $y;

                if ($y >= $clevers)
                    array_push($solver->dummies, $solverY);

                $solver->studentProjects[$solverY] = $p;
                array_push($solver->projectStudents[$p], $solverY);

                $taskIndex = sizeof($solver->tasks);
                array_push($solver->tasks, $p);
                array_push($solver->projectTasks[$p], $taskIndex);
                $solver->taskStudents[$taskIndex] = $solverY;

                $solverY += 1;
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

            if (sizeof($solverStudents) >= 2) // empty students array causes an error
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
        if ($updateDatabase)
            assignDatabase($toDatabase);

        $swaps = sizeof($toDatabase);
    }

    if (!$updateDatabase)
    {
        echo "<p>Setting group for all students.</p>";
        update();
        $finalGroups = [];
        foreach ($students as $y => $student)
            $finalGroups[$y] = $student->projectIndex;
        assignDatabase($finalGroups);
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

        if (sizeof($studentProjects) == 0)
            return;

        $sql = "DROP TABLE temp";
        mysqli_query($CON, $sql);

        $sql = "CREATE TABLE temp (stu_ID INT(11), pro_ID INT(11))";
        if (!mysqli_query($CON, $sql))
            echo "<p>Error creating temporary table.</p>";
        
        $sql = "INSERT INTO temp (stu_id, pro_ID) VALUES ";
        $n = 0;
        foreach ($studentProjects as $y => $p)
        {
            $student = $students[$y];
            $sid = $student->id;

            if (is_null($p))
                $pid = "null";
            else
            {
                $project = $projects[$p];
                $pid = $project->id;
            }

            if ($n > 0)
                $sql .= ", ";
            $sql .= "($sid, $pid)";
            $n += 1;
        }

        set_time_limit(30);
        if (!mysqli_query($CON, $sql))
            echo "<p>Error setting temporary project member: " . mysqli_error($CON) . "</p>";

        $sql = "UPDATE surveyanswer s, temp t SET s.pro_ID=t.pro_ID WHERE s.unit_ID='$unitID' AND s.stu_id=t.stu_ID";
        set_time_limit(30);
        if (!mysqli_query($CON, $sql))
            echo "<p>Error assigning project members: " . mysqli_error($CON) . "</p>";

        $sql = "DROP TABLE temp";
        if (!mysqli_query($CON, $sql))
            echo "<p>Error dropping temporary table.</p>";
    }
?>
