<!DOCTYPE html>
<html>
<body>

<?php
    require "Hungarian.php";
    
    class SkillDemand
    {
        public $MaxDifficulty;
        public $Importance;
    }
    
    echo "<div style='width: 100%; text-align: center; font-family: consolas; font-size: 0.75em;'><br>";
    echo "<table border='1'><tr>";
    
    $numSkills = 10;
    $numStudents = 100;
    $numProjects = 20;
    $numTasks = $numStudents;
    $displayOutput = max($numStudents, $numTasks) < 16;
    $randomisation = 1; // tiny randomisation bypasses an endless loop, caused by excessive identical values, in our acquired Hungarian algorithm code
    $discretisation = 100; // multiply everything so some decimals are preserved
    
    $numDummyStudents = max($numTasks - $numStudents, 0);
    $numDummyTasks = max($numStudents - $numTasks, 0); // avoid having these. the costs for dummy tasks make no sense
    
    $students = [];
    $projects = [];
    $tasks = [];
    $tasksProject = [];
    $studentProjects = [];
    $projectStudents = array_fill(0, $numProjects, []);
    
    for ($i = 0; $i < $numStudents; $i += 1)
    {
        $student = [];
        for ($s = 0; $s < $numSkills; $s += 1)
        {
            //$rarity = 10 + (int)($s * 20 / $numSkills); // low $s are more common
            $rarity = 5;
            $skill = max(rand(0, $rarity + 10) - $rarity, 0);
            array_push($student, $skill);
        }
        array_push($students, $student);
    }
    for ($i = 0; $i < $numDummyStudents; $i += 1)
        array_push($students, array_fill(0, $numSkills, 0)); // fill dummy students with minimum ability - they cannot satisfy any demands
    
    for ($i = 0; $i < $numProjects; $i += 1)
    {
        $project = [];
        $total = 0.0;
        for ($s = 0; $s < $numSkills; $s += 1)
        {
            //$rarity = 10 + (int)(($numSkills - 1 - $s) * 20 / $numSkills); // high $s are more common
            $rarity = 15;
            $skill = new SkillDemand();
            $skill->MaxDifficulty = max(rand(0, $rarity + 10) - $rarity, 0);
            $skill->Importance = $skill->MaxDifficulty; // for this test importance is the same as difficulty. sorta makes sense, but importance will be divided by the total, so that this task isn't biased
            array_push($project, $skill);
            $total += $skill->Importance;
        }
        // it makes sense for more restrictive skills to require more attention from the solver
        // however as these skills are fulfilled the demand cost should be reduced to avoid demanding all members will that skill
        if ($total > 0)
        {
            for ($s = 0; $s < $numSkills; $s += 1)
                $project[$s]->Importance = (int)($project[$s]->Importance * $discretisation / $total);
        }
        array_push($projects, $project);
    }
    
    for ($i = 0; $i < $numTasks; $i += 1)
    {
        $p = $i % $numProjects;
        $task = $projects[$p];
        array_push($tasks, $task);
        $tasksProject[$i] = $p;
    }
    for ($i = 0; $i < $numDummyTasks; $i += 1)
        array_push($tasks, array_fill(0, $numSkills, new SkillDemand())); // dummy tasks should not be used
    
    echo "Student Skills<br>";
    for ($i = 0; $i < sizeof($students); $i += 1)
    {
        echo "R-" . $i . ": ";
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
    
    for ($iteration = 0; $iteration < (int)sqrt(sizeof($students)); $iteration += 1)
    {
        echo "<td style='min-width: 320px' valign='top'>";
        
        $matrix = array();
        for ($y = 0; $y < sizeof($students); $y += 1)
        {
            $row = array();
            for ($x = 0; $x < sizeof($tasks); $x += 1)
            {
                $c = 0.0;
                
                $p = $tasksProject[$x];
                if ($iteration > 0)
                {
                    $pB = $studentProjects[$y];
                    // commented - no inertia. one small change might lead to larger optimisations
                    //if ($pB != $p)
                    //  $c += 2; // a bit of inertia - don't randomly change with little reason
                }
                
                for ($s = 0; $s < $numSkills; $s += 1)
                {
                    $demand = $tasks[$x][$s];
                    $max = $demand->MaxDifficulty;
                    $importance = $demand->Importance;
                    if ($max > 0)
                    {
                        $satisfaction = min($students[$y][$s] / $max, 1.0);
                        
                        $saturation = 0;
                        foreach ($projectStudents[$p] as $z)
                        {
                            if ($z != $y)
                            {
                                $sat = min($students[$z][$s] / $max, 1.0);
                                $saturation += $sat;
                            }
                        }
                        if ($satisfaction > 0.0)
                        {
                            $memberImportance = $importance * $satisfaction / ($saturation + $satisfaction);
                            
                            $c -= $memberImportance;
                        }
                    }
                    
                    if ($iteration > 0)
                    {
                        $demandB = $projects[$pB][$s];
                        $maxB = $demandB->MaxDifficulty;
                        $importanceB = $demandB->Importance;
                        
                        if ($maxB > 0)
                        {
                            $satisfactionB = min($students[$y][$s] / $maxB, 1.0);
                            
                            $saturationB = 0;
                            foreach ($projectStudents[$pB] as $z)
                            {
                                if ($z != $y)
                                {
                                    $sat = min($students[$z][$s] / $maxB, 1.0);
                                    $saturationB += $sat;
                                }
                            }
                            
                            if ($satisfactionB > 0.0)
                            {
                                $memberImportanceB = $importanceB * $satisfactionB / ($saturationB + $satisfactionB);
                                
                                $c += $memberImportanceB;
                            }
                        }
                    }
                }
                $row[$x] = (int)$c + rand(0, $randomisation);
            }
            $matrix[$y] = $row;
        }
        $copy = $matrix;
        
        $h = new RPFK\Hungarian\Hungarian($matrix);
        $assignments = $h->solve($displayOutput, 1000);
        
        $relevantAssignments = [];
        foreach ($h->rowAssignments() as $row => $column)
        {
            if ($row < $numStudents) // not a dummy student
                $relevantAssignments[$row] = $column;
        }
        $cost = $h->cost($relevantAssignments);
        $mean = $cost / $numStudents;
        
        echo "Cost: " . $cost . "<br>";
        printf("Mean: %.2f<br>", $mean);
        echo "<br>";
        
        $projectStudents = array_fill(0, $numProjects, []);
        $studentProjects = [];
        foreach ($assignments as $x => $y)
        {
            $p = $tasksProject[$y];
            array_push($projectStudents[$p], $x);
            $studentProjects[$x] = $p;
        }
        
        for ($p = 0; $p < $numProjects; $p += 1)
        {
            asort($projectStudents[$p]);
            
            echo "Project:<br>";
            for ($s = 0; $s < $numSkills; $s += 1)
                echo $projects[$p][$s]->MaxDifficulty . ", ";
            echo "<br><br>";
            echo "Students:<br>";
            foreach ($projectStudents[$p] as $i)
            {
                echo "R-" . $i . ": ";
                for ($s = 0; $s < $numSkills; $s += 1)
                    echo $students[$i][$s] . ", ";
                echo "<br>";
            }
            echo "<br><br>";
        }
        
        if ($displayOutput)
        {
            echo "<hr><br>";
            
            foreach ($h->takeOutput() as $text)
                echo $text;
                
            echo "<hr><br>";
            
            $h->outputMatrix($copy);
            foreach ($h->takeOutput() as $text)
                echo $text;
        }
        
        echo "</td>";
    }
    echo "</div><br><br>";
    echo "</tr></table>";
?>

</body>
</html>
