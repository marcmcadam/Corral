<!DOCTYPE html>
<html>
<body>

<?php
    require "../DATABASE/CONNECTDB.PHP";
    require "SOLVER.PHP";
    
    $numSkills = 11;
    $discretisation = 100; // multiply everything so some decimals are preserved
        
    echo "<div style='width: 100%; text-align: center; font-family: consolas; font-size: 0.75em;'><br>";

    $sql="SELECT student_firstname,stu_hc,stu_js,stu_php,stu_java,stu_c,stu_cpp,stu_oc,stu_db,stu_u3,stu_ui,stu_se FROM surveyanswer";
    $res=mysqli_query($CON, $sql);

    $studentNames = [];
    $students = [];
    $y = 0;
    while ($row = mysqli_fetch_assoc($res))
    {
        $studentNames[$y++] = $row['student_firstname'];
        
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
    
    
    $sql="SELECT pro_title,pro_hc,pro_js,pro_php,pro_java,pro_c,pro_cpp,pro_oc,pro_db,pro_u3,pro_ui,pro_se FROM project";
    $res=mysqli_query($CON, $sql);

    $projectNames = [];
    $projects = [];
    $p = 0;
    while ($row = mysqli_fetch_assoc($res))
    {
        $projectNames[$p++] = $row['pro_title'];
        
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
            $demand = new SkillDemand($pro[$s]);
            array_push($project, $demand);
            $total += $demand->Importance;
        }
        if ($total > 0)
        {
            for ($s = 0; $s < $numSkills; $s += 1)
                $project[$s]->Importance = (int)($project[$s]->Importance * $discretisation / $total);
        }
        array_push($projects, $project);
    }
    
    
    echo "Student Skills<br>";
    for ($i = 0; $i < sizeof($students); $i += 1)
    {
        echo $i . ": ";
        for ($s = 0; $s < $numSkills; $s += 1)
            echo $students[$i][$s] . ", ";
        echo "<br>";
    }
    echo "<br>";
    echo "Project Skills<br>";
    for ($p = 0; $p < sizeof($projects); $p += 1)
    {
        echo "Difficulty: ";
        for ($s = 0; $s < $numSkills; $s += 1)
            echo $projects[$p][$s]->MaxDifficulty . ", ";
        echo "<br>";
        echo "Importance: ";
        for ($s = 0; $s < $numSkills; $s += 1)
            echo $projects[$p][$s]->Importance . ", ";
        echo "<br><br>";
    }
    echo "<br>";
    
    
    $solver = new Solver();
    $solver->students = $students;
    $solver->projects = $projects;
    
    $solver->solve();
    
    $projectStudents = $solver->projectStudents;
    for ($p = 0; $p < sizeof($projects); $p += 1)
    {
        asort($projectStudents[$p]);
        
        echo "Project:<br>";
        for ($s = 0; $s < $numSkills; $s += 1)
            echo $projects[$p][$s]->MaxDifficulty . ", ";
        echo "<br><br>";
        echo "Students:<br>";
        foreach ($projectStudents[$p] as $i)
        {
            echo "$studentNames[$i]<br>";
            for ($s = 0; $s < $numSkills; $s += 1)
                echo $students[$i][$s] . ", ";
            echo "<br>";
        }
        echo "<br><br>";
    }
    
    echo "</div>";
?>

</body>
</html>
