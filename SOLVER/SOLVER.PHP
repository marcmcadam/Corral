<?php
    require "Hungarian.php";
    
    class SkillDemand
    {
        public $MaxDifficulty;
        public $Importance;
        
        public function __construct($difficulty)
        {
            $this->MaxDifficulty = $difficulty;
            $this->Importance = $difficulty;
        }
    }
    
    class Solver
    {
        public $displayOutput = false; // mostly unused at the moment
        public $randomisation = 1; // tiny randomisation bypasses an endless loop, caused by excessive identical values, in our acquired Hungarian algorithm code
        
        public $students = [];
        public $projects = [];
        
        public $studentProjects;
        public $projectStudents;
        
        public function solve()
        {
            $displayOutput = $this->displayOutput;
            $randomisation = $this->randomisation;
            
            $students = $this->students;
            $projects = $this->projects;
            
            $numSkills = sizeof($this->students[0]);
            
            $projectStudents = array_fill(0, sizeof($projects), []);
            $studentProjects = [];
        
            $tasks = [];
            $tasksProject = [];
        
            $numTasks = sizeof($students);
            for ($i = 0; $i < $numTasks; $i += 1)
            {
                $p = $i % sizeof($projects);
                $task = $projects[$p];
                
                array_push($tasks, $task);
                $tasksProject[$i] = $p;
            }
            
            //$iterations = (int)sqrt(sizeof($students));
            $iterations = (int)(log(sizeof($students)) / log(2.0));
            for ($iteration = 0; $iteration < $iterations; $iteration += 1)
            {
                $matrix = array();
                for ($y = 0; $y < sizeof($students); $y += 1)
                {
                    $row = array();
                    for ($x = 0; $x < sizeof($tasks); $x += 1)
                    {
                        $c = 0.0;
                        
                        $p = $tasksProject[$x];
                        if ($iteration > 0)
                            $pB = $studentProjects[$y];
                        
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
                
                $assignments = $h->solve($displayOutput, $numTasks * $numTasks);
                if ($assignments == null)
                    return false;
                
                $projectStudents = array_fill(0, sizeof($projects), []);
                $studentProjects = [];
                foreach ($assignments as $x => $y)
                {
                    $p = $tasksProject[$y];
                    array_push($projectStudents[$p], $x);
                    $studentProjects[$x] = $p;
                }
            }
            $this->projectStudents = $projectStudents;
            $this->studentProjects = $studentProjects;
            return true;
        }
    }
?>
