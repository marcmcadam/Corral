<?php
    $PageTitle = "Sort Results";
    require "header_staff.php";
    require_once "connectdb.php";
    require_once "sanitise.php";
    require_once "solver.php";
    require_once "getdata.php";

    sortingData($unitID, $skillNames, $sort, $students, $projects);

    $numSkills = 20;

    $headerBackgroundColour = ['r' => 0.25, 'g' => 0.25, 'b' => 0.25];
    $headerColour = ['r' => 0.5, 'g' => 0.5, 'b' => 0.5];
    $backgroundColour = ['r' => 0.25, 'g' => 0.25, 'b' => 0.25];
    $strongColour = ['r' => 0.25, 'g' => 0.75, 'b' => 0.25];
    $weakColour = ['r' => 0.75, 'g' => 0.25, 'b' => 0.25];

    $innerBorderColour = "#606060";

    echo "<style>
            td, th {
                white-space: nowrap;
            }
            .sortInputTop {
                border-bottom: thin solid black;
            }
            .sortProjectTop {
                font-weight:bold; border-bottom: thin solid black; border-right: thin solid $innerBorderColour; text-align: left;
            }
            .sortSkillTop {
                color: #f0f0f0; font-size: 0.75em; border-bottom: thin solid black; border-top: thin solid $innerBorderColour; border-right: thin solid $innerBorderColour;
            }
            .sortSkillCell {
                color: white; border-bottom: thin solid $innerBorderColour; border-right: thin solid $innerBorderColour;
            }
            .sortID {
                text-align: right; border-bottom: thin solid $innerBorderColour;
            }
            .sortName {
                text-align: left; border-bottom: thin solid $innerBorderColour;
            }
            .sortExclamation {
                text-align: center; color: #e04000; border-right: thin solid $innerBorderColour; border-bottom: thin solid $innerBorderColour;
            }
        </style>";

    echo "<h2>Sort Results</h2>";

    $posted = ($_SERVER["REQUEST_METHOD"] == "POST");
    $isSorting = !is_null($sort->pid);
    if ($isSorting)
    {
        if ($posted)
            echo "<p><strong>Unable to set locks while the sorter is running.</strong></p>";
        echo "<p>The sorter is running in the background. <a href='terminatesort.php?method=stop'>Stop</a></p>";

        function progressBar($progress)
        {
            $parts = 100;
            $partsDone = (int)floor($progress * $parts);
            echo "  <table align='center' cellpadding='0px' style='width: 50%; border: 1px solid #808080;'>
                        <tr>";
            for ($i = 0; $i < $parts; $i += 1)
            {
                $styles = ($i < $partsDone) ? "background: #80ff80; " : "";
                $text = "&nbsp;";
                echo "      <td style='border-right: #808080; $styles'>$text</td>";
            }
            echo "      </tr>
                    </table>";
        }
        
        $progressI = $sort->i / $sort->iterations;

        $rangeM = $sort->matrix / 10;
        $progressM = log($sort->m / 10) / log($rangeM);

        echo "Iterations: " . (int)($progressI * 100) . "%<br>";
        progressBar($progressI);
        echo "<br>Matrix size: " . (int)($progressM * 100) . "%<br>";
        progressBar($progressM);
        echo "<br><br>";
    }
    else
    {
        if ($posted)
        {
            // change the assignment locks using the posted submission
            $postedLocks = [];
            $unrecognised = 0;
            foreach ($_POST as $key => $value)
            {
                $keyType = substr($key, 0, 5);
                if ($keyType == "sLock")
                {
                    $sid = (int)SanitiseGeneric(substr($key, 5), $CON);
                    $postedLocks[$sid] = null;
                }
            }

            foreach ($students as $y => $student)
            {
                if (array_key_exists($student->id, $postedLocks))
                    $locked = true;
                else
                    $locked = false;

                if ($student->projectLocked != $locked)
                {
                    $student->projectLocked = $locked;

                    $lockSQL = ($locked ? "1" : "0");
                    $sql = "UPDATE surveyanswer SET pro_locked=$lockSQL WHERE unit_ID='$unitID' AND stu_id=$student->id";
                    $query = mysqli_query($CON, $sql);
                    if (!$query)
                        $unrecognised += 1;
                    if (mysqli_affected_rows($CON) != 1)
                        die("Project lock: not exactly 1 row affected.");
                }
            }

            if ($unrecognised == 0)
                echo "<p><strong>Student locks updated.</strong></p>";
            else
                echo "<p><strong>$unrecognised unrecognised commands!</strong></p>";
        }
    }

    echo "<form method='post'>";
    echo "<table class='listTable' align='center' style='text-align: left;'>";

    $skillLetters = [];
    $usedSkills = [];
    for ($i = 0; $i < $numSkills; $i += 1)
    {
        $name = $skillNames[$i];
        if (is_null($name))
            continue;
        $skillLetters[$i] = chr(65 + sizeof($usedSkills));
        array_push($usedSkills, $i);
    }

    for ($j = 0; $j < 10; $j += 1)
    {
        echo "<tr>";
        for ($k = 0; $k < 4; $k += 1)
        {
            $z = $k * 10 + $j;
            if ($z < sizeof($usedSkills))
            {
                $i = $usedSkills[$z];
                $name = $skillNames[$i];
                $letter = $skillLetters[$i];
                echo "<th>$letter</td>
                      <td style='width: 192px'>$name</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";

    echo "<table align='center' style='text-align: center;'>";

    // count used columns
    $numTableColumns = 3;
    for ($i = 0; $i < $numSkills; $i += 1)
    {
        if (is_null($skillNames[$i]))
            continue;
        $numTableColumns += 1;
    }
    // empty page-top column headers
    echo "<tr><td colspan='". $numTableColumns ."'>&nbsp;</td></tr>
            <tr>
            <th width='32px'><input type='checkbox' disabled></th>
            <th colspan='2' style='text-align: left;'><input type='submit' class='updateButton' value='Save All Locks'></th>
            <th width='16px'>&nbsp;</th>
        ";
    // page-top column name headers
    for ($i = 0; $i < $numSkills; $i += 1)
    {
        $name = $skillNames[$i];
        if (is_null($name))
            continue;
        $letter = $skillLetters[$i];
        echo "<th style='width: 48px'>$letter</th>";
    }

    // spacing row
    echo "</tr><tr><td colspan='". $numTableColumns ."'>&nbsp;</td></tr>";

    // find the max importance entry of everything, as the brightest value
    $importanceMax = 0.0;
    foreach ($projects as $p => $project)
    {
        for ($s = 0; $s < $numSkills; $s += 1)
            $importanceMax = max($importanceMax, $project->skills[$s]->importance);
    }
    for ($p = 0; $p < sizeof($projects); $p += 1) // ensure iterate in consistent order for display
    {
        $project = $projects[$p];

        sort($project->studentIndices); // not reliables. index orders of students might not be consistent

        // Print project name and skill requirements
        echo "<tr>";
        echo "<td class='sortInputTop'>
                <input type='checkbox' disabled>
            </td>";
        //echo "<td colspan='3' class='sortProjectTop'>$projectText[$p] ($projectMinima[$p] - $projectMaxima[$p])</td>";
        echo "<td colspan='3' class='sortProjectTop'>$project->title <span style='font-size: 0.75em; font-weight: normal;'>($project->minimum)</span></td>";
        for ($s = 0; $s < $numSkills; $s += 1)
        {
            if (is_null($skillNames[$s]))
                continue;

            $importance = $project->skills[$s]->importance;
            if ($importanceMax > 0.0)
                $alpha = $importance / $importanceMax;
            else
                $alpha = 0.0;
            $notAlpha = 1.0 - $alpha;
            $red = $notAlpha * $headerBackgroundColour['r'] + $alpha * $headerColour['r'];
            $green = $notAlpha * $headerBackgroundColour['g'] + $alpha * $headerColour['g'];
            $blue = $notAlpha * $headerBackgroundColour['b'] + $alpha * $headerColour['b'];
            $hexColour = sprintf("#%02X%02X%02X", (int)floor($red * 255.9), (int)floor($green * 255.9), (int)floor($blue * 255.9));
            echo "<td bgcolor='$hexColour' class='sortSkillTop'>";

            if ($importance > 0)
            {
                $bias = $project->skills[$s]->bias;
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
        foreach ($project->studentIndices as $i)
        {
            $student = $students[$i];

            $sid = $student->id;
            $text = $student->text;
            
            $lockName = ($isSorting ? "" : "name='sLock$sid'"); // TODO: need to include survey info in name if splitting the surveys
            $lockDisable = ($isSorting ? "disabled" : "");
            $lockValue = ($student->projectLocked ? "checked" : "");
            echo "<td style='border-bottom: thin solid $innerBorderColour;'>
                    <input type='checkbox' $lockName $lockDisable $lockValue>
                </td>";

            echo "<td class='sortID'>$sid&nbsp;</td>";
            echo "<td class='sortName'>$text&nbsp;</td>";

            $satisfaction = 0.0;
            $skillTotal = 0.0;
            $impTotal = 0.0;
            for ($s = 0; $s < $numSkills; $s += 1)
            {
                if (is_null($skillNames[$s]))
                    continue;
                $value = $student->skills[$s];
                $demand = $project->skills[$s];

                $satisfaction += $demand->importance * $value;
                $skillTotal += $value * $value;
                $impTotal += $demand->importance * $demand->importance;
            }
            $divisor = sqrt($skillTotal * $impTotal);
            if ($divisor > 0.0)
                $satisfaction /= $divisor;
            $satisfactionText = str_repeat("!", (int)floor(4.0 * (1.0 - $satisfaction)));

            echo "<td class='sortExclamation'>$satisfactionText</td>";

            $skillMax = 4.0;

            for ($s = 0; $s < $numSkills; $s += 1)
            {
                if (is_null($skillNames[$s]))
                    continue;
                $value = $student->skills[$s];
                $demand = $project->skills[$s];

                $alpha = ($importanceMax <= 0.0) ? 0.0 : ($demand->importance / $importanceMax);
                $strength = $value / $skillMax;
                $weakness = 1.0 - $strength;
                $notAlpha = 1.0 - $alpha;
                $red = $notAlpha * $backgroundColour['r'] + $alpha * ($strength * $strongColour['r'] + $weakness * $weakColour['r']);
                $green = $notAlpha * $backgroundColour['g'] + $alpha * ($strength * $strongColour['g'] + $weakness * $weakColour['g']);
                $blue = $notAlpha * $backgroundColour['b'] + $alpha * ($strength * $strongColour['b'] + $weakness * $weakColour['b']);
                $hexColour = sprintf("#%02X%02X%02X", (int)floor($red * 255.9), (int)floor($green * 255.9), (int)floor($blue * 255.9));
                echo "<td bgcolor='$hexColour' class='sortSkillCell'>";
                for ($v = 0; $v < $value; $v += 1)
                    echo "<img src='images/whitestar.png' width='10px' height='10px'>";
                echo "</td>";
            }
          echo "</tr>";
        }
        echo "<tr><td colspan='". $numTableColumns ."'>&nbsp;</td></tr>";
    }
    echo "</table>";
    echo "</form>";
    require "footer.php";
?>
