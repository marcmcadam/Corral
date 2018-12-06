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
        array_push($student, (int)$row['stu_hc']);
        array_push($student, (int)$row['stu_js']);
        array_push($student, (int)$row['stu_php']);
        array_push($student, (int)$row['stu_java']);
        array_push($student, (int)$row['stu_c']);
        array_push($student, (int)$row['stu_cpp']);
        array_push($student, (int)$row['stu_oc']);
        array_push($student, (int)$row['stu_db']);
        array_push($student, (int)$row['stu_u3']);
        array_push($student, (int)$row['stu_ui']);
        array_push($student, (int)$row['stu_se']);

        array_push($students, $student);
    }

    // Fetch project names and skill requirements from database
    $sql = "SELECT pro_num, pro_title, pro_min, pro_max, pro_imp, pro_hc,pro_js,pro_php,pro_java,pro_c,pro_cpp,pro_oc,pro_db,pro_u3,pro_ui,pro_se FROM project";
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
        
        $pro = [];
        array_push($pro, (int)$row['pro_hc']);
        array_push($pro, (int)$row['pro_js']);
        array_push($pro, (int)$row['pro_php']);
        array_push($pro, (int)$row['pro_java']);
        array_push($pro, (int)$row['pro_c']);
        array_push($pro, (int)$row['pro_cpp']);
        array_push($pro, (int)$row['pro_oc']);
        array_push($pro, (int)$row['pro_db']);
        array_push($pro, (int)$row['pro_u3']);
        array_push($pro, (int)$row['pro_ui']);
        array_push($pro, (int)$row['pro_se']);
        
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
