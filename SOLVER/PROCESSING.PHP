<!DOCTYPE html>
<html><body>
<?php
    echo "Begin processing initialisation.<br>";
    flush();
    
    require "SOLVER.PHP";

    require "GETDATA.PHP";
    
    // delete all student project assignments
    $sql = "TRUNCATE groups";
    if (!mysqli_query($CON, $sql))
    // TODO: how to error for background process?
        echo "Error deleting project member: " . mysqli_error($CON) . "<br>";

    echo "Assignments erased.<br>";
    flush();
        
    $tasks = [];

    $minTasksEach = 3;
    $minStudentsEach = 3;
    
    // minimum number of students per project. TODO: get from database
    $projectMinima = array_fill(0, sizeof($projects), $minStudentsEach);

    // assign what project each task slot belongs to, and in reverse
    $projectTasks = array_fill(0, sizeof($projects), []);

    // assign each project the minimum number of slots it should have
    $tasksRemaining = sizeof($students);
    $taskIndex = 0;
    for ($p = 0; $p < sizeof($projects); $p += 1)
    {
        $n = $minTasksEach;
        for ($t = 0; $t < $n; $t += 1)
        {
            $taskNumber = $taskIndex++;
            $tasks[$taskNumber] = $p;
            array_push($projectTasks[$p], $taskNumber);
        }
        $tasksRemaining -= $n;
    }
    
    // assign each project more tasks randomly
    for ($t = 0; $t < $tasksRemaining; $t += 1)
    {
        $p = rand(0, sizeof($projects) - 1);

        $taskNumber = $taskIndex++;
        $tasks[$taskNumber] = $p;
        array_push($projectTasks[$p], $taskNumber);
    }

    echo "Project tasks created.<br>";
    flush();
        
    
    // generate dummy students to allow empty slots in groups for variables group sizes
    // the number of dummies needed depends on the difference between the total max size for projects and the number of students
    $dummySlots = 0;
    for ($p = 0; $p < sizeof($projects); $p += 1)
        $dummySlots += sizeof($projectTasks[$p]);
    $dummySlots -= sizeof($students);
    if ($dummySlots < 0)
    {
        echo "Too few tasks for the number of students!";
        die;
    }
    
    $dummies = [];
    for ($i = 0; $i < $dummySlots; $i += 1)
    {
        $y = sizeof($students);
        array_push($students, array_fill(0, $numSkills, 0));
        array_push($dummies, $y);
    }

    echo "Dummy students created.<br>";
    flush();
    
    
    if (sizeof($tasks) != sizeof($students))
    {
        echo "Sizes of student and task arrays do not match.<br>";
        die;
    }
    
    
    // assign students to random tasks to begin with
    $projectStudents = array_fill(0, sizeof($projects), []);
    $studentProjects = array_fill(0, sizeof($students), -1);
    
    $studentIndices = range(0, sizeof($students) - 1);
    shuffle($studentIndices);
    for ($i = 0; $i < sizeof($students); $i += 1)
    {
        $y = $studentIndices[$i];
        $p = $tasks[$i];
        $studentProjects[$y] = $p;
        array_push($projectStudents[$p], $y);
    }
    
    echo "Random assignments created.<br>";
    flush();
    
    assignDatabase($studentProjects); 
    
    $iteration = 0;
    while (true)
    {
        echo "iteration: $iteration<br>";
        flush();
        
        // split the students into separate batches randomly
        $projectStudentIndices = [];
        for ($p = 0; $p < sizeof($projects); $p += 1)
        {
            $indices = range(0, sizeof($projectStudents[$p]) - 1);
            shuffle($indices);
            $projectStudentIndices[$p] = $indices;
        }
        
        $batchSize = 50;
        $numGroups = (int)ceil(sizeof($students) / $batchSize);

        $projectStudentIndex = array_fill(0, sizeof($projects), 0);
        
        $toDatabase = [];
        for ($g = 0; $g < $numGroups; $g += 1)
        {
            // iterate each batch and solve
            $solver = new Solver();
            $solver->numSkills = $numSkills;
            
            $solver->inertia = 500 * $iteration;
            
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
                    
                    $studentIndex = sizeof($solver->students);
                    array_push($solver->students, $students[$y]);
                    
                    $solverStudents[$studentIndex] = $y;
                    
                    if (in_array($studentIndex, $dummies))
                        array_push($solver->dummies, $studentIndex);
                    
                    $solver->studentProjects[$studentIndex] = $p;
                    array_push($solver->projectStudents[$p], $studentIndex);
                    
                    $taskIndex = sizeof($solver->tasks);
                    array_push($solver->tasks, $p);
                    array_push($solver->projectTasks, $taskIndex);
                    
                    array_push($solver->projectStudents[$p], $studentIndex);
                    $solver->studentProjects[$studentIndex] = $p;
                }
            }
            
            $solver->iterate();
            if ($iteration < 0 || $solver->processing)
                die;
            
            foreach ($solver->studentProjects as $studentIndex => $p)
            {
                $y = $solverStudents[$studentIndex];
                $toDatabase[$y] = $p;
            }
        }
        
        assignDatabase($toDatabase);
        
        foreach ($toDatabase as $y => $p)
            $studentProjects[$y] = $p;
        $projectStudents = array_fill(0, sizeof($projects), []);
        foreach ($studentProjects as $y => $p)
            array_push($projectStudents[$p], $y);
        
        $iteration += 1;
        if ($iteration >= 32)
            break;
    }
    
    function assignDatabase($studentProjects)
    {
        global $CON;
        global $solver;
        global $studentNames;
        global $projectNames;
        
        foreach ($studentProjects as $x => $p)
        {
            set_time_limit(5); // each entry should be quick, but in total can take a long time
            
            if (!array_key_exists($x, $studentNames))
                continue;
            
            $sid = $studentNames[$x];
            $pid = $projectNames[$p];
            
            // delete student project assignments
            $sql = "DELETE FROM groups WHERE stu_id = $sid";
            if (!mysqli_query($CON, $sql))
            // TODO: how to error for background process?
                echo "Error deleting project member: " . mysqli_error($CON) . "<br>";
            
            // create new assignment
            $sql = "INSERT INTO groups (pro_num, stu_id) VALUES ($pid, $sid)";
            if (!mysqli_query($CON, $sql))
            // TODO: how to error for background process?
                echo "Error assigning project member: " . mysqli_error($CON) . "<br>";
        }
    }
?>
</body></html>