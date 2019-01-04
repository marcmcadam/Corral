<?php
    require_once "connectdb.php";
    require_once "solver.php";
    require_once "getfunctions.php";

    $numSkills = 20;


    // get the process ID for the sorting
    $sql = "SELECT sta_Email, sort_pid, sort_matrix, sort_random, sort_inertia, sort_iterations FROM staff WHERE sta_Email = '$id'";
    $res = mysqli_query($CON, $sql);
    if (!$res)
    {
        echo "Error: " . mysqli_error($CON);
        echo $sql;
        die;
    }

    if ($row = mysqli_fetch_assoc($res))
    {
        $sortPID = $row["sort_pid"];
        $sortMatrix = $row["sort_matrix"];
        $sortRandom = $row["sort_random"];
        $sortInertia = $row["sort_inertia"];
        $sortIterations = $row["sort_iterations"];
    }
    else
    {
        $sortPID = null;
        $sortMatrix = null;
        $sortRandom = null;
        $sortInertia = null;
        $sortIterations = null;
    }
    $unit_ID = 'SIT302T218'; // TODO: Implement dynamic unit selection
    $skillnames = [];
    $skillNames = getSkillNames($CON, $numSkills, $unit_ID); // skill names decide whether numbers are relevant or not, using null


    // Fetch student names and skill assessments from database
    $sql = "SELECT a.*, s.stu_FirstName, s.stu_LastName FROM surveyanswer a, student s WHERE a.stu_Id = s.stu_Id";
    $res = mysqli_query($CON, $sql);
    if (!$res)
    {
        echo "Error: " . mysqli_error($CON);
        die;
    }

    $studentNames = [];
    $studentText = [];
    $students = [];
    $y = 0;
    while ($row = mysqli_fetch_assoc($res))
    {
        $rowY = $y++;

        $studentNames[$rowY] = $row['stu_ID'];
        $studentText[$rowY] = $row['stu_FirstName'] . " " . $row['stu_LastName'];

        $student = [];

        // Populate student skills array with stu_skill_##
        for ($i = 0; $i < $numSkills; $i += 1)
        {
            if (is_null($skillNames[$i]))
                $skill = 0;
            else
                $skill = (int)$row['stu_skill_'.sprintf('%02d', $i)];
            array_push($student, $skill);
        }
        array_push($students, $student);
    }

    // Fetch project names and skill requirements from database
    $sql = "SELECT * FROM project";
    $res = mysqli_query($CON, $sql);

    $proportionalOverride = true;
    $projectOverride = [];
    $overrideTotal = 0;

    $projectNames = [];
    $projectText = [];
    $projectMinima = [];
    $projectMaxima = [];
    $projectImportance = [];
    $projects = [];
    $projectBiases = [];
    $p = 0;
    while ($row = mysqli_fetch_assoc($res))
    {
        $pid = (int)$row['pro_ID'];

        $rowP = $p++;

        $projectText[$rowP] = $row['pro_title'] ;

        $projectNames[$rowP] = $pid;

        $min = (int)$row['pro_min'];
        $max = (int)$row['pro_max'];

        if ($proportionalOverride)
        {
            $value = $min; //(int)round($min + $max);
            $projectOverride[$rowP] = $value;
            $overrideTotal += $value;
        }
        else
        {
            $projectMinima[$rowP] = $min;
            $projectMaxima[$rowP] = $max;
        }

        $importance = (int)$row['pro_imp'];
        $projectImportance[$rowP] = $importance;

        // Create project skills
        $project = [];
        for ($i = 0; $i < $numSkills; $i += 1)
        {
            if (is_null($skillNames[$i]))
            {
                $imp = 0;
                $bias = 0;
            }
            else
            {
                $imp = (int)$row['pro_skill_'.sprintf('%02d', $i)];
                $bias = (int)$row['pro_bias_'.sprintf('%02d', $i)];
            }
            $demand = new SkillDemand($imp * $importance, $bias);
            array_push($project, $demand);
        }
        array_push($projects, $project);
    }

    // proportionally distribute students based on middles of projects min/max
    $remaining = sizeof($students);
    foreach ($projectOverride as $p => $value)
    {
        if ($overrideTotal == 0)
            $proportion = 0.0;
        else
            $proportion = $value / $overrideTotal;

        $take = (int)round($remaining * $proportion);
        $remaining -= $take;
        $overrideTotal -= $value;
        $projectMinima[$p] = $take;
        $projectMaxima[$p] = $take;
    }
    if ($overrideTotal != 0 || $remaining != 0)
    {
        echo "Proportional group size distribution failed";
        die;
    }

    $idStudents = [];
    foreach ($studentNames as $y => $s)
        $idStudents[$s] = $y;

    $idProjects = [];
    foreach ($projectNames as $x => $p)
        $idProjects[$p] = $x;

    $sql = "SELECT stu_id, pro_num, locked FROM groups";
    $res = mysqli_query($CON, $sql);
    $studentProjects = [];
    $projectStudents = array_fill(0, sizeof($projects), []);
    $studentLocks = array_fill(0, sizeof($students), false);
    while ($row = mysqli_fetch_assoc($res))
    {
        $sid = (int)$row['stu_id'];
        $pid = (int)$row['pro_num'];
        $locked = (int)$row['locked'];

        if (!array_key_exists($pid, $idProjects))
            die("An assignment exists for a missing project.");
        else if (!array_key_exists($sid, $idStudents))
            die("An assignment exists for a missing student.");
        else
        {
            $y = $idStudents[$sid];
            $p = $idProjects[$pid];

            $studentProjects[$y] = $p;
            array_push($projectStudents[$p], $y);

            if ($locked)
                $studentLocks[$idStudents[$sid]] = true;
        }
    }
?>
