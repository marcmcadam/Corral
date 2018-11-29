<?php
    require "Hungarian.php";
    
    class SkillDemand
    {
        public $maxDifficulty;
        public $importance;
        
        public function __construct($difficulty, $importance = null)
        {
            $this->maxDifficulty = $difficulty;
            $this->importance = $importance ?? $difficulty;
        }
    }
    
    class Solver
    {
        public $displayOutput = false; // mostly unused at the moment
        public $numSkills;
        public $discretisation = 100;
        public $randomisation = 1; // tiny randomisation bypasses an endless loop, caused by excessive identical values, in our acquired Hungarian algorithm code
        
        public $students;
        public $projects;
        public $tasks;
        
        public $studentProjects;
        public $projectStudents;
        
        public function iterate()
        {
            $displayOutput = $this->displayOutput;
            $numSkills = $this->numSkills;
            $discretisation = $this->discretisation;
            $randomisation = $this->randomisation;
            
            $students = $this->students;
            $projects = $this->projects;
            $tasks = $this->tasks;
            $studentProjects = $this->studentProjects;
            $projectStudents = $this->projectStudents;
            
            if (sizeof($tasks) != sizeof($students))
            {
                echo "Task and student arrays must be equal in length.";
                return false;
            }
            
            $displayOutput = $this->displayOutput;
            $randomisation = $this->randomisation;
            
            $matrix = array();
            for ($y = 0; $y < sizeof($students); $y += 1)
            {
                $row = array();
                for ($x = 0; $x < sizeof($tasks); $x += 1)
                {
                    $c = 0.0;
                    
                    $p = $tasks[$x];
                    $pB = $studentProjects[$y];
                    
                    for ($s = 0; $s < $numSkills; $s += 1)
                    {
                        $demand = $projects[$tasks[$x]][$s];
                        $max = $demand->maxDifficulty;
                        $importance = $demand->importance;
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
                                $memberImportance = $discretisation * $importance * $satisfaction / ($saturation + $satisfaction);
                                
                                $c -= $memberImportance;
                            }
                        }
                        
                        if ($pB >= 0)
                        {
                            $demandB = $projects[$pB][$s];
                            $maxB = $demandB->maxDifficulty;
                            $importanceB = $demandB->importance;
                            
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
                                    $memberImportanceB = $discretisation * $importanceB * $satisfactionB / ($saturationB + $satisfactionB);
                                    
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
            
            $assignments = $h->solve($displayOutput, sizeof($tasks) * sizeof($tasks));
            if ($assignments == null)
                return false;
            
            $projectStudents = array_fill(0, sizeof($projects), []);
            $studentProjects = [];
            foreach ($assignments as $x => $y)
            {
                $p = $tasks[$y];
                array_push($projectStudents[$p], $x);
                $studentProjects[$x] = $p;
            }
            
            $this->projectStudents = $projectStudents;
            $this->studentProjects = $studentProjects;
            
            return true;
        }
    }
?>
