<?php
    require "../DATABASE/CONNECTDB.PHP";

    $numSkills = 11;

    // TODO: fetch only students and projects for the current survey

    // Fetch student names and skill assessments from database
    $sql = "SELECT a.*, s.stu_FirstName, s.stu_LastName FROM surveyanswer a, student s WHERE a.stu_Id = s.stu_Id";
    $res = mysqli_query($CON, $sql);
    if (!$res)
        echo "Error: " . mysqli_error($CON);

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
    $sql="SELECT pro_num, pro_title, pro_hc,pro_js,pro_php,pro_java,pro_c,pro_cpp,pro_oc,pro_db,pro_u3,pro_ui,pro_se FROM project";
    $res=mysqli_query($CON, $sql);
 
    $projectNames = [];
    $projectText = [];
    $projects = [];
    $p = 0;
    while ($row = mysqli_fetch_assoc($res))
    {
        $pid = (int)$row['pro_num'];
        
        $rowP = $p++;
        
        $projectText[$rowP] = $row['pro_title'] ;
        
        $projectNames[$rowP] = $pid;

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
            
            // a hash function to consistently decide the bias where there's no room for it in the database
            $r = ($pid << 8) | $s;
            $r *= 12721;
            $u = $r & 0xAAAA; $v = $r & 0x5555;
            $r = ($u >> 11) | ($v >> 5) | ($u << 5) | ($v << 11);
            $r *= 12721;
            $u = $r & 0xAAAA; $v = $r & 0x5555;
            $r = ($u >> 11) | ($v >> 5) | ($u << 5) | ($v << 11);
            $r *= 12721;
            $u = $r & 0xAAAA; $v = $r & 0x5555;
            $r = ($u >> 11) | ($v >> 5) | ($u << 5) | ($v << 11);
            
            $demand = new SkillDemand($importance, ($r % 3) - 1);
            array_push($project, $demand);
            $total += $demand->importance;
        }
        /*
        if ($total > 0) // only for lazy setting of importance. if given as input then use the raw number
        {
            for ($s = 0; $s < $numSkills; $s += 1)
                $project[$s]->importance /= $total;
        }
        */
        array_push($projects, $project);
    }
?>
