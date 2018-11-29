<!DOCTYPE html>
<html>
<body>
    <form action="ITERATE.php">
        <input type="submit" value="Continue Assign">
    </form>
    <?php
        $solver = $_SESSION['solver'];
        
        $students = $solver->students;
        $projects = $solver->projects;
        $tasks = $solver->tasks;
        $studentProjects = $solver->studentProjects;
        $projectStudents = $solver->projectStudents;
        
        require("GETDATA.PHP");
        
        // Set up display table
        echo "<div style='width: 100%; text-align: center; font-family: monospace;'>";
        echo "<table align='center' cellpadding='0' cellspacing='0'>
           <th width='50px'>&nbsp;</th>
           <th width='50px'>A</th>
           <th width='50px'>B</th>
           <th width='50px'>C</th>
           <th width='50px'>D</th>
           <th width='50px'>E</th>
           <th width='50px'>F</th>
           <th width='50px'>G</th>
           <th width='50px'>H</th>
           <th width='50px'>I</th>
           <th width='50px'>J</th>
           <th width='50px'>K</th>
           ";
        for ($p = 0; $p < sizeof($projects); $p += 1)
        {
            asort($projectStudents[$p]);

            // Print project name and skill requirements
            echo "<tr><td colspan='12'>&nbsp;</td></tr><tr><td colspan='12' style='font-weight:bold;'>" . $projectNames[$p] . "</td></tr>";
            echo "<tr><td style='font-weight:bold; border-bottom: thin solid; border-right: thin solid'>&nbsp;</td>";
            for ($s = 0; $s < $numSkills; $s += 1)
                echo "<td style='font-weight:bold; border-bottom: thin solid'>" . $projects[$p][$s]->maxDifficulty . "</td>";
            echo "</tr>";
            // Print student names and skills
            echo "<tr>";
            $num_students = 0; // Reset number of students to 0 for this project
            $skill_total = [0,0,0,0,0,0,0,0,0,0,0]; // Reset skill totals (used in average calculation) to 0 for this project
            $backgroundColour = ['r' => 1.0, 'g' => 1.0, 'b' => 1.0];
            $strongColour = ['r' => 0.0, 'g' => 1.0, 'b' => 0.0];
            $weakColour = ['r' => 1.0, 'g' => 0.0, 'b' => 0.0];
            foreach ($projectStudents[$p] as $i)
            {
                echo "<td style='border-right: thin solid;'>" . $studentNames[$i] . "</td>";
                
                $importanceTotal = 0.0;
                for ($s = 0; $s < $numSkills; $s += 1)
                    $importanceTotal += $projects[$p][$s]->importance;
                
                for ($s = 0; $s < $numSkills; $s += 1) {
                    $value = $students[$i][$s];
                    
                    $alpha = ($importanceTotal <= 0.0) ? 0.0 : ($projects[$p][$s]->importance / $importanceTotal);
                    $strength = ($projects[$p][$s]->maxDifficulty <= 0.0) ? 0.5 : min($value / $projects[$p][$s]->maxDifficulty, 1.0);
                    $weakness = 1.0 - $strength;
                    $notAlpha = 1.0 - $alpha;
                    $red = $notAlpha * $backgroundColour['r'] + $alpha * ($strength * $strongColour['r'] + $weakness * $weakColour['r']);
                    $green = $notAlpha * $backgroundColour['g'] + $alpha * ($strength * $strongColour['g'] + $weakness * $weakColour['g']);
                    $blue = $notAlpha * $backgroundColour['b'] + $alpha * ($strength * $strongColour['b'] + $weakness * $weakColour['b']);
                    $hexColour = sprintf("#%20x%20x%20x", (int)floor($red * 255.9), (int)floor($green * 255.9), (int)floor($blue * 255.9));
                    $style = ($projects[$p][$s]->maxDifficulty == 0) ? "font-weight: bold" : "";
                    echo "<td bgcolor='$hexColour' style='$style'>";
                    /*if ($projects[$p][$s]->maxDifficulty == 0) {
                      echo " style='color:#cfcfcf;'"; // If the project does not require the skill, set the color to grey.
                    } elseif ($projects[$p][$s]->maxDifficulty > $students[$i][$s]) {
                      echo " style='color:red';"; // If the student has a LOWER skill than the project requirement, set the color to red.
                    }
                    echo ">";*/
                    echo $value;
                    echo "</td>";
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
                </tr>";
        }
        echo "</table>";
        echo "</div>";
    ?>
</body>
</html>
