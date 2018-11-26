<!DOCTYPE html>
<html>
<body>

<?php
    require "../DATABASE/CONNECTDB.PHP";
    require "SOLVER.PHP";

    $numSkills = 11;
    $discretisation = 100; // multiply everything so some decimals are preserved

    echo "<div style='width: 100%; text-align: center; font-family: consolas; font-size: 0.75em;'>";

    // Fetch student names and skill assessments from database
    $sql="SELECT student_firstname,stu_hc,stu_js,stu_php,stu_java,stu_c,stu_cpp,stu_oc,stu_db,stu_u3,stu_ui,stu_se FROM surveyanswer LIMIT 50";
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

    // Fetch project names and skill requirements from database
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

    // Begin placement
    $solver = new Solver();
    $solver->students = $students;
    $solver->projects = $projects;

    $solver->solve();
    // Set up display table
    echo "<table cellpadding='0' cellspacing='0'>
       <th width='50px'>&nbsp;</th>
       <th width='50px'>HTML/CSS</th>
       <th width='50px'>JavaScript</th>
       <th width='50px'>PHP</th>
       <th width='50px'>Java</th>
       <th width='50px'>C</th>
       <th width='50px'>C++</th>
       <th width='50px'>Obj C</th>
       <th width='50px'>Database</th>
       <th width='50px'>Unity</th>
       <th width='50px'>UI</th>
       <th width='50px'>Security</th>
       ";
    $projectStudents = $solver->projectStudents;
    for ($p = 0; $p < sizeof($projects); $p += 1)
    {
        asort($projectStudents[$p]);

        // Print project name and skill requirements
        echo "<tr><td colspan='12'>&nbsp;</td></tr><tr><td colspan='12' style='font-weight:bold;'>Project: " . $projectNames[$p] . "</td></tr>";
        echo "<tr><td style='font-weight:bold; border-bottom: thin solid; border-right: thin solid'>&nbsp;</td>";
        for ($s = 0; $s < $numSkills; $s += 1)
            echo "<td style='font-weight:bold; border-bottom: thin solid'>" . $projects[$p][$s]->MaxDifficulty . "</td>";
        echo "</tr>";
        // Print student names and skills
        echo "<tr>";
        $num_students = 0; // Reset number of students to 0 for this project
        $skill_total = [0,0,0,0,0,0,0,0,0,0,0]; // Reset skill totals (used in average calculation) to 0 for this project
        foreach ($projectStudents[$p] as $i)
        {

            echo "<td style='border-right: thin solid;'>" . $studentNames[$i] . "</td>";
            for ($s = 0; $s < $numSkills; $s += 1) {
                echo "<td";
                if ($projects[$p][$s]->MaxDifficulty == 0) {
                  echo " style='color:#cfcfcf;'"; // If the project does not require the skill, set the color to grey.
                } elseif ($projects[$p][$s]->MaxDifficulty > $students[$i][$s]) {
                  echo " style='color:red';"; // If the student has a LOWER skill than the project requirement, set the color to red.
                }
                echo ">" . $students[$i][$s] . "</td>";
                $skill_total[$s] += $students[$i][$s];

            }
            $num_students += 1;
          echo "</tr>";
          }
          echo "<tr>
            <td style='font-weight:bold; border-right: thin solid; border-top: thin solid;'>Team Avg</td>
            <td style='font-weight:bold; border-top: thin solid;'>".round($skill_total[0] / $num_students, 1)."</td>
            <td style='font-weight:bold; border-top: thin solid;'>".round($skill_total[1] / $num_students, 1)."</td>
            <td style='font-weight:bold; border-top: thin solid;'>".round($skill_total[2] / $num_students, 1)."</td>
            <td style='font-weight:bold; border-top: thin solid;'>".round($skill_total[3] / $num_students, 1)."</td>
            <td style='font-weight:bold; border-top: thin solid;'>".round($skill_total[4] / $num_students, 1)."</td>
            <td style='font-weight:bold; border-top: thin solid;'>".round($skill_total[5] / $num_students, 1)."</td>
            <td style='font-weight:bold; border-top: thin solid;'>".round($skill_total[6] / $num_students, 1)."</td>
            <td style='font-weight:bold; border-top: thin solid;'>".round($skill_total[7] / $num_students, 1)."</td>
            <td style='font-weight:bold; border-top: thin solid;'>".round($skill_total[8] / $num_students, 1)."</td>
            <td style='font-weight:bold; border-top: thin solid;'>".round($skill_total[9] / $num_students, 1)."</td>
            <td style='font-weight:bold; border-top: thin solid;'>".round($skill_total[10] / $num_students, 1)."</td>
            </tr>";}
    echo "</table>";
    echo "</div>";
?>

</body>
</html>
