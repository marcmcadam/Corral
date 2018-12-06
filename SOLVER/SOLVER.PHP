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
        
        // multiplies floating point by this before converting to integer
        public $discretisation = 100.0;
        
        // tiny randomisation bypasses an endless loop, caused by excessive identical values, in our acquired Hungarian algorithm code
        // the more randomisation there is, the faster it goes. could be because the values are more ordered instead of the same, and that reduces the number of possibilities
        public $randomisation = 10;
        
        // the cost of changing from the current situation. forces it to settle
        public $inertia = 0;
                
        public $processing = false;
        public $iteration = 0;
        
        public $students;
        public $projects;
        
        public $tasks;
        
        public $projectMinima;
        
        public $studentProjects;
        public $projectStudents;
        
        public $dummies;
        
        public $cost;
        
        public static function memberScore($demand, $value)
        {
            return pow($value, pow(2.0, $demand->bias));
        }
        
        public function iterate()
        {
            $this->processing = true;
            $this->iteration += 1;
            
            // the cost to do something that should not be done
            $lastResort = 100.0;
            
            $displayOutput = $this->displayOutput;
            $numSkills = $this->numSkills;
            $discretisation = $this->discretisation;
            $randomisation = $this->randomisation;
            $inertia = $this->inertia;
            
            $students = $this->students;
            $projects = $this->projects;
            $tasks = $this->tasks;
            $projectMinima = $this->projectMinima;
            $projectTasks = $this->projectTasks;
            $studentProjects = $this->studentProjects;
            $projectStudents = $this->projectStudents;
            $dummies = $this->dummies;
            
            if (sizeof($tasks) != sizeof($students))
            {
                echo "Task and student arrays must be equal in length.";
                $this->iteration = -1;
                return false;
            }
            
            $displayOutput = $this->displayOutput;
            $randomisation = $this->randomisation;
            
            $totals = array_fill(0, sizeof($projects), array_fill(0, $numSkills, 0.0));
            $projectFills = [];
            for ($p = 0; $p < sizeof($projects); $p += 1)
            {
                for ($s = 0; $s < $numSkills; $s += 1)
                {
                    $demand = $projects[$p][$s];
                    $total = 0.0;
                    foreach ($projectStudents[$p] as $y)
                        $total += Solver::memberScore($demand, $students[$y][$s]);
                    $totals[$p][$s] = $total;
                }
                
                // collect how full are projects, with valid members
                $clevers = 0;
                foreach ($projectStudents[$p] as $y)
                {
                    if (!in_array($y, $dummies))
                        $clevers += 1;
                }
                $projectFills[$p] = $clevers;
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
                    if ($nextProject != $currentProject)
                    {
                        for ($s = 0; $s < $numSkills; $s += 1)
                        {
                            $d = 0.0;
                            if ($currentProject >= 0)
                            {
                                // current project satisfaction
                                $demand = $projects[$currentProject][$s];
                                $satisfaction = Solver::memberScore($demand, $students[$y][$s]);
                                $total = $totals[$currentProject][$s];
                                if ($total > 0.0)
                                    $satisfaction /= $total;
                                $d += $demand->importance * $satisfaction;
                            }
                            {
                                // changed project satisfaction
                                $demand = $projects[$nextProject][$s];
                                $satisfaction = Solver::memberScore($demand, $students[$y][$s]);
                                $total = $totals[$nextProject][$s];
                                if ($currentProject != $nextProject)
                                    $total += $satisfaction;
                                if ($total > 0.0)
                                    $satisfaction /= $total;
                                $d -= $demand->importance * $satisfaction;
                            }
                            /*
                            if (in_array($y, $dummies))
                            {
                                $difference = $projectFills[$currentProject] - $projectMinima[$currentProject];
                                $difference -= 1;
                                if ($difference < 0) // dummy member leaving a minimal project
                                    $d -= $lastResort;
                                    
                                $difference = $projectFills[$nextProject] - $projectMinima[$nextProject];
                                $difference -= 1;
                                if ($difference < 0) // dummy member joining a minimal project
                                    $d += $lastResort;
                            }
                            else
                            {
                                $difference = $projectFills[$currentProject] - $projectMinima[$currentProject];
                                $difference -= 1;
                                if ($difference < 0) // valid member leaving a minimal project
                                    $d += $lastResort;
                                    
                                $difference = $projectFills[$nextProject] - $projectMinima[$nextProject];
                                $difference -= 1;
                                if ($difference < 0) // valid member joining a minimal project
                                    $d -= $lastResort;  
                            }
                            */
                            $c += $d;
                        }
                    }
                    $element = $discretisation * $c;
                    $element += rand(-$randomisation, $randomisation);
                    if ($nextProject != $currentProject)
                        $element += $inertia;
                    
                    $row[$x] = (int)$element;
                }
                $matrix[$y] = $row;
            }
            
            $h = new RPFK\Hungarian\Hungarian($matrix);
            
            $assignments = $h->solve($displayOutput, sizeof($tasks) * sizeof($tasks));
            
            $this->cost = $h->cost($assignments) / sizeof($matrix);
            
            if ($assignments == null)
            {
                $this->iteration = -1;
                return false;
            }
            
            $projectStudents = array_fill(0, sizeof($projects), []);
            $studentProjects = [];
            foreach ($assignments as $y => $x)
            {
                $p = $tasks[$x];
                array_push($projectStudents[$p], $y);
                $studentProjects[$y] = $p;
            }
            
            $this->projectStudents = $projectStudents;
            $this->studentProjects = $studentProjects;
            
            $this->processing = false;
            return true;
        }
    }
?>
