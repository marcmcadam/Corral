<?php
    require "Hungarian.php";
    
    class SkillDemand
    {
        public $importance;
        public $bias;
        
        public function __construct($importance, $bias)
        {
            $this->importance = $importance;
            $this->bias = $bias;
        }
    }
    
    class Solver
    {
        public $displayOutput = false; // mostly unused at the moment
        public $numSkills;
        
        // the level of skill that is average. because all member cost is divided by total, this number may have no effect
        public $skillMiddle = 2.0;
        
        // multiplies floating point by this before converting to integer
        public $discretisation = 100;
        
        // tiny randomisation bypasses an endless loop, caused by excessive identical values, in our acquired Hungarian algorithm code
        // the more randomisation there is, the faster it goes. could be because the values are more ordered instead of the same, and that reduces the number of possibilities
        public $randomisation = 3;
        
        // the cost of changing from the current situation. forces it to settle
        public $inertia = 2;
        
        public $students;
        public $projects;
        public $tasks;
        public $projectTasks;
        
        public $studentProjects;
        public $projectStudents;
        
        public function memberScore($demand, $value)
        {
            return pow($value / $this->skillMiddle, pow(2.0, $demand->bias));
        }
        
        public function iterate()
        {
            $displayOutput = $this->displayOutput;
            $numSkills = $this->numSkills;
            $discretisation = $this->discretisation;
            $randomisation = $this->randomisation;
            $inertia = $this->inertia;
            
            $students = $this->students;
            $projects = $this->projects;
            $tasks = $this->tasks;
            $projectTasks = $this->projectTasks;
            $studentProjects = $this->studentProjects;
            $projectStudents = $this->projectStudents;
            
            if (sizeof($tasks) != sizeof($students))
            {
                echo "Task and student arrays must be equal in length.";
                return false;
            }
            
            $displayOutput = $this->displayOutput;
            $randomisation = $this->randomisation;
            
            $totals = array_fill(0, sizeof($projects), array_fill(0, $numSkills, 0.0));
            for ($p = 0; $p < sizeof($projects); $p += 1)
            {
                for ($s = 0; $s < $numSkills; $s += 1)
                {
                    $demand = $projects[$p][$s];
                    $total = 0.0;
                    foreach ($projectStudents[$p] as $y)
                        $total += $this->memberScore($demand, $students[$y][$s]);
                    $totals[$p][$s] = $total;
                }
            }
            
            $matrix = array();
            for ($y = 0; $y < sizeof($students); $y += 1)
            {
                $currentProject = $studentProjects[$y];
                $row = array();
                for ($x = 0; $x < sizeof($tasks); $x += 1)
                {
                    $nextProject = $tasks[$x];
                    $c = 0.0;
                    for ($s = 0; $s < $numSkills; $s += 1)
                    {
                        $d = 0.0;
                        if ($currentProject >= 0)
                        {
                            // current project satisfaction
                            $demand = $projects[$currentProject][$s];
                            $satisfaction = $this->memberScore($demand, $students[$y][$s]);
                            if ($satisfaction > 0.0)
                            {
                                $total = $totals[$currentProject][$s];
                                $size = sizeof($projectTasks[$currentProject]);
                                // divide by total contribution by all members, so that if one member makes almost
                                // no difference, they are free to change groups
                                // the problem with this idea, is that if a skill has no contributors, it will attract many members
                                // if the skill has many contributors, it will lose many members
                                // causing the result to repeatedly reverse itself
                                // so reduce the power of this factor by how many members that it can gain or lose to try to reduce the effect (seems to work)
                                $satisfaction /= pow($total, 1.0 / $size);
                                $d += $demand->importance * $satisfaction;
                            }
                        }
                        {
                            // changed project satisfaction
                            $demand = $projects[$nextProject][$s];
                            $satisfaction = $this->memberScore($demand, $students[$y][$s]);
                            if ($satisfaction > 0.0)
                            {
                                $total = $totals[$nextProject][$s];
                                if ($currentProject != $nextProject)
                                    $total += $satisfaction;
                                $size = sizeof($projectTasks[$nextProject]);
                                $satisfaction /= pow($total, 1.0 / $size);
                                $d -= $demand->importance * $satisfaction;
                            }
                        }
                        $c += $d;
                    }
                    
                    $rowValue = $discretisation * $c;
                    $rowValue += rand(0, $randomisation);
                    if ($nextProject != $currentProject)
                        $rowValue += $inertia;
                    
                    $row[$x] = (int)$rowValue;
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
