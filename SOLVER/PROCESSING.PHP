<?php
    $PageTitle = "Begin Solving";
    require "SOLVER.PHP";

    require "GETDATA.PHP";

    set_time_limit(60);
    
    $solver = new Solver();
    $solver->students = $students;
    $solver->projects = $projects;

    $solver->tasks = [];

    $minTasksEach = 3;

    $dummySlots = (int)(0.25 * sizeof($solver->students));

    for ($i = 0; $i < $dummySlots; $i += 1)
        array_push($solver->students, array_fill(0, $numSkills, 0));

    $solver->projectTasks = array_fill(0, sizeof($solver->projects), []);

    $tasksRemaining = sizeof($solver->students);
    $taskIndex = 0;
    for ($p = 0; $p < sizeof($solver->projects); $p += 1)
    {
        $n = $minTasksEach;
        for ($t = 0; $t < $n; $t += 1)
        {
            $taskNumber = $taskIndex++;
            $solver->tasks[$taskNumber] = $p;
            array_push($solver->projectTasks[$p], $taskNumber);
        }
        $tasksRemaining -= $n;
    }
    for ($t = 0; $t < $tasksRemaining; $t += 1)
    {
        $p = rand(0, sizeof($solver->projects) - 1);

        $taskNumber = $taskIndex++;
        $solver->tasks[$taskNumber] = $p;
        array_push($solver->projectTasks[$p], $taskNumber);
    }

    $solver->projectStudents = array_fill(0, sizeof($solver->projects), []);
    $solver->studentProjects = array_fill(0, sizeof($solver->students), -1);

    $solver->numSkills = $numSkills;

    while (true)
    {
        if ($solver->iteration < 0 || $solver->processing)
            die;
        $solver->iterate();
        assignDatabase();
    }
    
    function assignDatabase()
    {
        global $CON;
        global $solver;
        global $studentNames;
        global $projectNames;
        
        $studentProjects = $solver->studentProjects;
        foreach ($studentProjects as $x => $p)
        {
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