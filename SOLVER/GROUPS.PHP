<?php
    $PageTitle = "Sort Results";
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
<style>
    td, th {
        white-space: nowrap;
    }
</style>
<div style='width: 100%; text-align: center; font-family: sans-serif; font-size: 1em'>
<?php
    if (isset($sortPID))
    {
        echo "<p>The sorter is running in the background.</p>";
        echo "<p><a href='TERMINATE.PHP'>Stop</a></p>";
    }
?>
<table border='0' align='center' cellpadding='0' cellspacing='0' style='text-align: center'>
<?php
    $numTableColumns = 3;
    
    // count used columns
    for ($i = 0; $i < $numSkills; $i += 1)
    {
        if (is_null($skillNames[$i]))
            continue;
        $numTableColumns += 1;
    }
    // empty page-top column headers
    echo "<tr><td colspan='". $numTableColumns ."'>&nbsp;</td></tr>
            <tr>
            <th width='96px'>&nbsp;</th>
            <th width='256px'>&nbsp;</th>
            <th width='16px'>&nbsp;</th>
        ";
    // page-top column name headers
    for ($i = 0; $i < $numSkills; $i += 1)
    {
        $name = $skillNames[$i];
        if (is_null($name))
            continue;
        echo "<th>$name</th>";
    }

    // spacing row
    echo "</tr><tr><td colspan='". $numTableColumns ."'>&nbsp;</td></tr>";

    // find the max importance entry of everything, as the brightest value
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
        //echo "<td colspan='3' style='font-weight:bold; border-bottom: thin solid; border-right: thin solid; text-align: left;'>$projectText[$p] ($projectMinima[$p] - $projectMaxima[$p])</td>";
        echo "<td colspan='3' style='font-weight:bold; border-bottom: thin solid; border-right: thin solid; text-align: left;'>$projectText[$p]</td>";
        for ($s = 0; $s < $numSkills; $s += 1)
        {
            if (is_null($skillNames[$s]))
                continue;
            
            $importance = $projects[$p][$s]->importance;
            if ($importanceMax > 0.0)
                $alpha = $importance / $importanceMax;
            else
                $alpha = 0.0;
            $notAlpha = 1.0 - $alpha;
            $red = $notAlpha * $headerBackgroundColour['r'] + $alpha * $headerColour['r'];
            $green = $notAlpha * $headerBackgroundColour['g'] + $alpha * $headerColour['g'];
            $blue = $notAlpha * $headerBackgroundColour['b'] + $alpha * $headerColour['b'];
            $hexColour = sprintf("#%02X%02X%02X", (int)floor($red * 255.9), (int)floor($green * 255.9), (int)floor($blue * 255.9));
            echo "<td bgcolor='$hexColour' style='font-size: 0.75em; border-bottom: thin solid; border-right: thin solid #c0c0c0'>";

            if ($importance > 0)
            {
                $bias = $projects[$p][$s]->bias;
                if ($bias > 0.25)
                    echo "H";
                else if ($bias > -0.25)
                    echo "";
                else
                    echo "L";
            }
            
            echo "</td>";
        }
        echo "</tr>";
        echo "<tr>";
        // Print student names and skills
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
            echo "<td style='text-align: left; border-bottom: thin solid #c0c0c0'>$text</td>";
            
            $satisfaction = 0.0;
            $skillTotal = 0.0;
            $impTotal = 0.0;
            for ($s = 0; $s < $numSkills; $s += 1)
            {
                if (is_null($skillNames[$s]))
                    continue;
                $value = $students[$i][$s];
                $demand = $projects[$p][$s];
                
                $satisfaction += $demand->importance * $value;
                $skillTotal += $value * $value;
                $impTotal += $demand->importance * $demand->importance;
            }
            $divisor = sqrt($skillTotal * $impTotal);
            if ($divisor > 0.0)
                $satisfaction /= $divisor;
            $satisfactionText = str_repeat("!", (int)floor(4.0 * (1.0 - $satisfaction)));
            
            echo "<td style='text-align: center; border-right: thin solid; border-bottom: thin solid #c0c0c0'>$satisfactionText</td>";
            
            $skillMax = 4.0;
            
            for ($s = 0; $s < $numSkills; $s += 1)
            {
                if (is_null($skillNames[$s]))
                    continue;
                $value = $students[$i][$s];
                $demand = $projects[$p][$s];

                $alpha = ($importanceMax <= 0.0) ? 0.0 : ($demand->importance / $importanceMax);
                $strength = $value / $skillMax;
                $weakness = 1.0 - $strength;
                $notAlpha = 1.0 - $alpha;
                $red = $notAlpha * $backgroundColour['r'] + $alpha * ($strength * $strongColour['r'] + $weakness * $weakColour['r']);
                $green = $notAlpha * $backgroundColour['g'] + $alpha * ($strength * $strongColour['g'] + $weakness * $weakColour['g']);
                $blue = $notAlpha * $backgroundColour['b'] + $alpha * ($strength * $strongColour['b'] + $weakness * $weakColour['b']);
                $hexColour = sprintf("#%02X%02X%02X", (int)floor($red * 255.9), (int)floor($green * 255.9), (int)floor($blue * 255.9));
                $style = ($projects[$p][$s]->importance == 0) ? "" : "font-weight: bold;";
                echo "<td bgcolor='$hexColour' style='$style; color: white; border-bottom: thin solid #606060; border-right: thin solid #606060;'>";
                for ($v = 0; $v < $value; $v += 1)
                    echo "<img src='whiteStar.png' width='10px' height='10px'>";
                echo "</td>";
            }
          echo "</tr>";
        }
        echo "<tr><td colspan='". $numTableColumns ."'>&nbsp;</td></tr>";
    }
    echo "</table></div>";
    require "../PAGES/FOOTER_STAFF.PHP";
?>
