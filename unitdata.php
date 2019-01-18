<?php
    require_once "connectdb.php";
    require_once "solver.php";
    require_once "getfunctions.php";
    require_once "functions.php";

    class UnitData
    {
        public $skillNames;
        public $sort;
        public $students;
        public $projects;
        public $unassigned;
    }

    class SortingState
    {
        public $matrix;
        public $random;
        public $inertia;
        public $iterations;
        public $pid;
        public $stop;
        public $i;
        public $m;
    }

    class Student
    {
        public $id;
        public $firstName;
        public $lastName;
        public $text;
        public $campus;
        public $email;
        public $skills;
        public $projectIndex; // index of project for this unit in local arrays
        public $projectLocked;
    }

    class Project
    {
        public $unitID;
        public $id;
        public $title;
        public $brief;
        public $leader;
        public $email;
        public $minimum;
        public $maximum;
        public $allocation; // from proportional distrubtion
        public $slots;
        public $skills;
        public $studentIndices; // indices of students for this unit in local arrays
    }

    function unitData($unitID)
    {
        global $CON;

        $numSkills = 20;

        $skillNames = getSkillNames($CON, $numSkills, $unitID); // skill names decide whether numbers are relevant or not, using null


        // get the process ID for the sorting
        $sql = "SELECT sort_matrix, sort_random, sort_inertia, sort_iterations, sort_pid, sort_stop, sort_i, sort_m FROM unit WHERE unit_ID='$unitID'";
        $res = mysqli_query($CON, $sql);
        if (!$res)
        {
            echo "Error: " . mysqli_error($CON);
            echo $sql;
            die;
        }

        $sort = new SortingState();
        if ($row = mysqli_fetch_assoc($res))
        {
            $sort->matrix = $row["sort_matrix"];
            $sort->random = $row["sort_random"];
            $sort->inertia = $row["sort_inertia"];
            $sort->iterations = $row["sort_iterations"];
            $sort->pid = $row["sort_pid"];
            $sort->stop = $row["sort_stop"];
            $sort->i = $row["sort_i"];
            $sort->m = $row["sort_m"];
        }
        else
            die("Unit doesn't exist: " . mysqli_error($CON));


        // Fetch student names and skill assessments from database
        $sql = "SELECT a.*, s.* FROM surveyanswer a, student s WHERE a.stu_Id=s.stu_Id AND a.unit_ID='$unitID'";
        $res = mysqli_query($CON, $sql);
        if (!$res)
        {
            echo "Error: " . mysqli_error($CON);
            die;
        }

        $students = [];
        $idStudents = [];
        while ($row = mysqli_fetch_assoc($res))
        {
            $student = new Student();

            $student->id = (int)$row['stu_ID'];
            $student->firstName = $row['stu_FirstName'];
            $student->lastName = $row['stu_LastName'];
            $student->campus = $row['stu_Campus'];
            $student->email = $row['stu_Email'];

            $student->text = "$student->firstName $student->lastName";

            // Populate student skills array with stu_skill_##
            if ($row['submitted'])
            {
                $skills = [];
                for ($i = 0; $i < $numSkills; $i += 1)
                {
                    if (is_null($skillNames[$i]))
                        $skill = null; // make unable to use
                    else
                        $skill = (int)$row['stu_skill_'.sprintf('%02d', $i)];
                    array_push($skills, $skill);
                }
                $student->skills = $skills;
            }
            else
                $student->skills = array_fill(0, $numSkills, 0); // sorting with 0 skill if no survey complete

            $idStudents[$student->id] = sizeof($students);
            array_push($students, $student);
        }

        // Fetch project names and skill requirements from database
        $sql = "SELECT * FROM project WHERE unit_ID='$unitID'";
        $res = mysqli_query($CON, $sql);

        $proportionalOverride = true;
        $projectOverride = [];

        $projects = [];
        $idProjects = [];
        while ($row = mysqli_fetch_assoc($res))
        {
            $project = new Project();

            $project->unitID = $row['unit_ID'];
            $project->id = (int)$row['pro_ID'];
            $project->title = $row['pro_title'];
            $project->brief = $row['pro_brief'];
            $project->leader = $row['pro_leader'];
            $project->email = $row['pro_email'];
            $project->minimum = (int)$row['pro_min'];
            $project->maximum = (int)$row['pro_max'];
            $importance = (int)$row['pro_imp'];

            $projectOverride[sizeof($projects)] = $project->minimum;

            // Create project skills
            $project->skills = [];
            for ($i = 0; $i < $numSkills; $i += 1)
            {
                if (is_null($skillNames[$i]))
                {
                    $imp = 0;
                    $bias = 0;
                }
                else
                {
                    $imp = (int)$row['pro_skill_'.sprintf('%02d', $i)];
                    $bias = (int)$row['pro_bias_'.sprintf('%02d', $i)];
                }
                $demand = new SkillDemand($imp * $importance, $bias);
                array_push($project->skills, $demand);
            }

            $project->studentIndices = [];

            $idProjects[$project->id] = sizeof($projects);
            array_push($projects, $project);
        }
    
        // student sorting properties
        $sql = "SELECT stu_ID, pro_ID, pro_locked FROM surveyanswer WHERE unit_ID='$unitID'";
        $res = mysqli_query($CON, $sql);
        while ($row = mysqli_fetch_assoc($res))
        {
            $sid = $row['stu_ID'];
            $pid = $row['pro_ID'];
            $locked = (bool)$row['pro_locked'];

            $sid = (int)$sid;
            $y = $idStudents[$sid];

            $students[$y]->projectLocked = $locked;

            if (is_null($pid))
                continue;
            $pid = (int)$pid;

            if (!array_key_exists($pid, $idProjects))
                die("An assignment exists for a missing project.");
            if (!array_key_exists($sid, $idStudents))
                die("An assignment exists for a missing student.");
            
            $p = $idProjects[$pid];
            $students[$y]->projectIndex = $p;

            array_push($projects[$p]->studentIndices, $y);
        }
        
        if (array_sum($projectOverride) > 0)
        {
            // proportionally distribute students
            $allocations = distribute($projectOverride, sizeof($students));
            if (!is_null($allocations))
            {
                foreach ($allocations as $p => $size)
                {
                    $projects[$p]->allocation = $size;
                    $projects[$p]->slots = $size;
                }
            }

            // TODO: this risks subtracting from the same projects each time it loops. should eventually find a way to distribute the number correctly first time
            while (true)
            {
                $excess = 0;
                $freeProjects = [];
                foreach ($projects as $p => $project)
                {
                    $lockedCount = 0;
                    foreach ($project->studentIndices as $s)
                    {
                        if ($students[$s]->projectLocked)
                            $lockedCount += 1;
                    }
                    $projectExcess = $lockedCount - $project->slots;
                    if ($projectExcess > 0)
                    {
                        $excess += $projectExcess;
                        $project->slots = $lockedCount;
                    }
                    else if ($projectExcess < 0 && $projectOverride[$p] > 0)
                        array_push($freeProjects, $p);
                }

                if ($excess == 0)
                    break; // nothing to change
                if (sizeof($freeProjects) == 0)
                    break; // no way to change it

                // the total slots must be the same as the total number of students
                // if projects have more students locked-in than than they have been allocated, it throws off the number
                // re-allocate for projects that have more students locked-in than they have been allocated
                // distribute the negative change needed, to projects that have room to move
                $subtractDistribution = [];
                foreach ($freeProjects as $p)
                    $subtractDistribution[$p] = $projectOverride[$p];
                $subtractions = distribute($subtractDistribution, $excess);
                foreach ($freeProjects as $p)
                {
                    if ($subtractions[$p] > 0)
                    {
                        $project = $projects[$p];
                        $reduced = $project->slots - $subtractions[$p];
                        $project->slots = $reduced;
                    }
                }
            }
        }

        $unassigned = [];
        foreach ($students as $y => $student)
        {
            if (is_null($student->projectIndex))
                array_push($unassigned, $y);
        }

        $unitData = new UnitData();
        $unitData->skillNames = $skillNames;
        $unitData->sort = $sort;
        $unitData->students = $students;
        $unitData->projects = $projects;
        $unitData->unassigned = $unassigned;
        return $unitData;
    }

    function groupStudentTable(&$students, $indices)
    {
        echo "<table align='left' class='listTable'>";
        if (sizeof($indices) > 0)
        {
            echo "  <tr>
                        <th class='widthStudentID'>ID</th>
                        <th class='widthWide'>Name</th>
                        <th class='widthTiny'>Survey</th>
                        <th class='widthEmail'>Email</th>
                        <th class='widthCampus'>Campus</th>
                    </tr>";
            foreach ($indices as $y)
            {
                $student = $students[$y];
                $campus = getCampus($student->campus);
                $survey = is_null($student->skills) ? "-" : "Y";
                echo "  <tr>
                            <td>$student->id</td>
                            <td>$student->text</td>
                            <td>$survey</td>
                            <td>$student->email</td>
                            <td>$campus</td>
                        </tr>";
            }
        }
        else
            echo "<tr><th colspan='2'>No Students</th></tr>";
        echo "</table>";
    }

    function groupStudentTablePDF(&$students, $indices)
    {
        echo '<table border="1px" cellspacing="0" cellpadding="4px" style="text-align: center;">';
        if (sizeof($indices) > 0)
        {
            echo '  <tr>
                        <th style="background-color: #404040; color: #ffffff;">ID</th>
                        <th style="background-color: #404040; color: #ffffff;">First Name</th>
                        <th style="background-color: #404040; color: #ffffff;">Last Name</th>
                        <th style="background-color: #404040; color: #ffffff;">Email</th>
                        <th style="background-color: #404040; color: #ffffff;">Campus</th>
                    </tr>';
            foreach ($indices as $y)
            {
                $student = $students[$y];
                $campus = getCampus($student->campus);
                $survey = is_null($student->skills) ? "-" : "Y";
                echo '  <tr>
                            <td style="text-align: right;">'.$student->id.'</td>
                            <td style="text-align: left;">'.$student->firstName.'</td>
                            <td style="text-align: left;">'.$student->lastName.'</td>
                            <td style="text-align: left;">'.$student->email.'</td>
                            <td style="text-align: left;">'.$campus.'</td>
                        </tr>';
            }
        }
        else
            echo '<tr><th colspan="2">No Students</th></tr>';
        echo '</table>';
    }
?>
