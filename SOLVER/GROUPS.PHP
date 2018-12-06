<?php
    $PageTitle = "Display Sorting Results";
    require "../PAGES/HEADER_STAFF.PHP";
    require_once "../DATABASE/CONNECTDB.PHP";
    require "SOLVER.PHP";
    require "GETDATA.PHP";
    
    $idStudents = [];
    foreach ($studentNames as $x => $s)
        $idStudents[$s] = $x;
    
    $idProjects = [];
    foreach ($projectNames as $y => $p)
        $idProjects[$p] = $y;
    
    $sql = "SELECT stu_id, pro_num FROM groups";
    $res = mysqli_query($CON, $sql);
    $projectStudents = array_fill(0, sizeof($projects), []);
    while ($row = mysqli_fetch_assoc($res))
    {
        $sid = (int)$row['stu_id'];
        $pid = (int)$row['pro_num'];
        
        if (array_key_exists($pid, $idProjects) && array_key_exists($sid, $idStudents))
            array_push($projectStudents[$idProjects[$pid]], $idStudents[$sid]);
        else
        {
            // TODO: error
        }
    }
?>
<div style='width: 100%; text-align: center; font-family: sans-serif; font-size: 1em'>
<?php
    if (isset($sortPID))
    {
        echo "<br>The sorter is running in the background.<br><br>";
        echo "<a href='TERMINATE.PHP'>Stop</a><br><br>";
    }
?>
<table border='0' align='center' cellpadding='0' cellspacing='0' style='text-align: center'>
<?php
    echo "<tr><td colspan='13'>&nbsp;</td></tr>
            <tr>
            <th width='96px' style='font-size: 1em'>&nbsp;</th>
            <th width='256px' style='font-size: 1em'>&nbsp;</th>
            <th width='64px' style='font-size: 1em'>HTML</th>
            <th width='64px' style='font-size: 1em'>JS</th>
            <th width='64px' style='font-size: 1em'>PHP</th>
            <th width='64px' style='font-size: 1em'>Java</th>
            <th width='64px' style='font-size: 1em'>C</th>
            <th width='64px' style='font-size: 1em'>C++</th>
            <th width='64px' style='font-size: 1em'>Obj C</th>
            <th width='64px' style='font-size: 1em'>Database</th>
            <th width='64px' style='font-size: 1em'>Unity</th>
            <th width='64px' style='font-size: 1em'>UI</th>
            <th width='64px' style='font-size: 1em'>Security</th>
        </tr><tr><td colspan='13'>&nbsp;</td></tr>";
    $importanceMax = 0.0;
    for ($p = 0; $p < sizeof($projects); $p += 1)
    {
        for ($s = 0; $s < $numSkills; $s += 1)
            $importanceMax = max($importanceMax, $projects[$p][$s]->importance);
    }
    for ($p = 0; $p < sizeof($projects); $p += 1)
    {
        sort($projectStudents[$p]);

        $headerBackgroundColour = ['r' => 0.9275, 'g' => 0.9275, 'b' => 0.9275];
        $headerColour = ['r' => 1.0, 'g' => 1.0, 'b' => 0.5];

        $backgroundColour = ['r' => 0.5, 'g' => 0.5, 'b' => 0.5];
        $strongColour = ['r' => 0.0, 'g' => 0.75, 'b' => 0.0];
        $weakColour = ['r' => 0.75, 'g' => 0.0, 'b' => 0.0];

        // Print project name and skill requirements
        echo "<tr>";
        echo "<td colspan='2' style='font-weight:bold; border-bottom: thin solid; border-right: thin solid; text-align: left;'>$projectText[$p] ($projectMinima[$p] - $projectMaxima[$p])</td>";
        for ($s = 0; $s < $numSkills; $s += 1)
        {
            $importance = $projects[$p][$s]->importance;
            if ($importanceMax > 0.0)
                $alpha = $importance / $importanceMax;
            else
                $alpha = 0.0;
            $notAlpha = 1.0 - $alpha;
            $red = $notAlpha * $headerBackgroundColour['r'] + $alpha * $headerColour['r'];
            $green = $notAlpha * $headerBackgroundColour['g'] + $alpha * $headerColour['g'];
            $blue = $notAlpha * $headerBackgroundColour['b'] + $alpha * $headerColour['b'];
            $hexColour = sprintf("#%20x%20x%20x", (int)floor($red * 255.9), (int)floor($green * 255.9), (int)floor($blue * 255.9));
            echo "<td bgcolor='$hexColour' style='border-bottom: thin solid; border-right: thin solid #c0c0c0'>";

            if ($importance > 0)
            {
                $bias = $projects[$p][$s]->bias;
                if ($bias > 0.25)
                    echo "High";
                else if ($bias > -0.25)
                    echo "Medium";
                else
                    echo "Low";
            }
            
            echo "</td>";
        }
        echo "</tr>";
        // Print student names and skills
        echo "<tr>";
        /*
        $size = sizeof($projectStudents[$p]);
        $means = array_fill(0, $numSkills, 1.0);
        for ($s = 0; $s < $numSkills; $s += 1)
        {
            $demand = $projects[$p][$s];
            $total = 0.0;
            foreach ($projectStudents[$p] as $y)
                $total += Solver::memberScore($demand, $students[$y][$s]);
            $means[$s] = ($size == 0.0 || $total == 0.0) ? 1.0 : ($total / $size);
        }
        */
        $num_students = 0; // Reset number of students to 0 for this project
        $skill_total = [0,0,0,0,0,0,0,0,0,0,0]; // Reset skill totals (used in average calculation) to 0 for this project
        foreach ($projectStudents[$p] as $i)
        {
            if (array_key_exists($i, $studentNames))
            {
                $text = $studentText[$i];
                $name = $studentNames[$i];
            }
            else
            {
                $text = "&nbsp;";
                $name = "&nbsp;";
            }
            echo "<td style='text-align: right; border-bottom: thin solid #c0c0c0'>$name&nbsp;</td>";
            echo "<td style='text-align: left; border-right: thin solid; border-bottom: thin solid #c0c0c0'>$text</td>";

            $skillMax = 4.0;
            
            for ($s = 0; $s < $numSkills; $s += 1) {
                $value = $students[$i][$s];
                $demand = $projects[$p][$s];

                $alpha = ($importanceMax <= 0.0) ? 0.0 : ($demand->importance / $importanceMax);
                $strength = $value / $skillMax;
                //$strength = 0.5 * (1.0 + $strength);
                $weakness = 1.0 - $strength;
                $notAlpha = 1.0 - $alpha;
                $red = $notAlpha * $backgroundColour['r'] + $alpha * ($strength * $strongColour['r'] + $weakness * $weakColour['r']);
                $green = $notAlpha * $backgroundColour['g'] + $alpha * ($strength * $strongColour['g'] + $weakness * $weakColour['g']);
                $blue = $notAlpha * $backgroundColour['b'] + $alpha * ($strength * $strongColour['b'] + $weakness * $weakColour['b']);
                $hexColour = sprintf("#%20x%20x%20x", (int)floor($red * 255.9), (int)floor($green * 255.9), (int)floor($blue * 255.9));
                $style = ($projects[$p][$s]->importance == 0) ? "" : "font-weight: bold;";
                echo "<td bgcolor='$hexColour' style='$style; border-bottom: thin solid #606060; border-right: thin solid #606060;'>";
                for ($v = 0; $v < $value; $v += 1)
                    echo "<img src='whiteStar.png' width='12px' height='12x'>";

                echo "</td>";
                $skill_total[$s] += $students[$i][$s];
            }
            $num_students += 1;
          echo "</tr>";
          }
          if ($num_students > 0)
          {
              echo "<tr>
                <td style='text-align: left; font-weight: bold; border-top: thin solid;'>&nbsp;</td>
                <td style='text-align: right; font-weight: bold; border-top: thin solid; border-right: thin solid;'>Team Average&nbsp;</td>
                <td style='border-top: thin solid;'>".round($skill_total[0] / $num_students, 1)."</td>
                <td style='border-top: thin solid;'>".round($skill_total[1] / $num_students, 1)."</td>
                <td style='border-top: thin solid;'>".round($skill_total[2] / $num_students, 1)."</td>
                <td style='border-top: thin solid;'>".round($skill_total[3] / $num_students, 1)."</td>
                <td style='border-top: thin solid;'>".round($skill_total[4] / $num_students, 1)."</td>
                <td style='border-top: thin solid;'>".round($skill_total[5] / $num_students, 1)."</td>
                <td style='border-top: thin solid;'>".round($skill_total[6] / $num_students, 1)."</td>
                <td style='border-top: thin solid;'>".round($skill_total[7] / $num_students, 1)."</td>
                <td style='border-top: thin solid;'>".round($skill_total[8] / $num_students, 1)."</td>
                <td style='border-top: thin solid;'>".round($skill_total[9] / $num_students, 1)."</td>
                <td style='border-top: thin solid;'>".round($skill_total[10] / $num_students, 1)."</td>
                </tr>";
          }
        echo "<tr><td colspan='13'>&nbsp;</td></tr>";
    }
    echo "</table></div>";
    require "../PAGES/FOOTER_STAFF.PHP";
?>