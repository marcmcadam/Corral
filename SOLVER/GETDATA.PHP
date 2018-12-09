<?php
    require_once "../DATABASE/CONNECTDB.PHP";
    require_once "HASH.PHP";
    
    $numSkills = 11;

    $sql = "SELECT staff_id, sort_pid FROM staff WHERE staff_id = $id";
    $res = mysqli_query($CON, $sql);
    if (!$res)
    {
        echo "Error: " . mysqli_error($CON);
        die;
    }
    
    if ($row = mysqli_fetch_assoc($res))
        $sortPID = $row["sort_pid"];
    else
        $sortPID = null;
    
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

        // Populate student skills array with stu_skill_## (01-20) if that skill has a value
        for ($i=1; $i<21; $i++) {
          if (isset($row['stu_skill_'.sprintf('%02d',$i)])) {
            array_push($student, (int)$row['stu_skill_'.sprintf('%02d',$i)]);
          }
        }

        array_push($students, $student);
    }

    // Fetch project names and skill requirements from database
    $sql = "SELECT pro_num, pro_title, pro_min, pro_max, pro_imp, pro_skill_01, pro_skill_02, pro_skill_03, pro_skill_04, pro_skill_05, pro_skill_06, pro_skill_07, pro_skill_08, pro_skill_09, pro_skill_10, pro_skill_11, pro_skill_12, pro_skill_13, pro_skill_14, pro_skill_15, pro_skill_16, pro_skill_17, pro_skill_18, pro_skill_19, pro_skill_20 FROM project";
    $res = mysqli_query($CON, $sql);

    $projectNames = [];
    $projectText = [];
    $projectMinima = [];
    $projectMaxima = [];
    $projectImportance = [];
    $projects = [];
    $p = 0;
    while ($row = mysqli_fetch_assoc($res))
    {
        $pid = (int)$row['pro_num'];

        $rowP = $p++;

        $projectText[$rowP] = $row['pro_title'] ;

        $projectNames[$rowP] = $pid;

        $projectMinima[$rowP] = (int)$row['pro_min'];
        $projectMaxima[$rowP] = (int)$row['pro_max'];
        $imp = (int)$row['pro_imp'];
        $projectImportance[$rowP] = $imp;

        // Create project skills array
        $pro = [];
        // Populate project skills array with pro_skill_## (01-20) if that skill has a value
        for ($i=1; $i<21; $i++) {
          if (isset($row['pro_skill_'.sprintf('%02d',$i)])) {
            array_push($pro, (int)$row['pro_skill_'.sprintf('%02d',$i)]);
          }
        }

        $project = [];
        $total = 0;
        for ($s = 0; $s < $numSkills; $s += 1)
        {
            $importance = $pro[$s];

            // use hash to consistently decide the bias where there's no room for it in the database
            $r = hash16(($pid << 8) | $s);

            $demand = new SkillDemand($imp * $importance, ($r % 3) - 1);
            array_push($project, $demand);
            $total += $demand->importance;
        }
        array_push($projects, $project);
    }
?>
