<?php
  $PageTitle = "Begin Solving";
  require "../PAGES/HEADER_STAFF.PHP";
          require "SOLVER.PHP";

        require "GETDATA.PHP";

        $solver = new Solver();
        $solver->students = $students;
        $solver->projects = $projects;

        $solver->tasks = [];

        $minTasksEach = 3;

        $dummySlots = (int)(0.25 * sizeof($solver->students));

        for ($i = 0; $i < $dummySlots; $i += 1)
            array_push($solver->students, array_fill(0, $numSkills, 0));

        $solver->projectTasks = array_fill(0, sizeof($solver->projects), []);

        $tasksRemaining = sizeof($solver->students);
        $taskIndex = 0;
        for ($p = 0; $p < sizeof($solver->projects); $p += 1)
        {
            $n = $minTasksEach;
            for ($t = 0; $t < $n; $t += 1)
            {
                $taskNumber = $taskIndex++;
                $solver->tasks[$taskNumber] = $p;
                array_push($solver->projectTasks[$p], $taskNumber);
            }
            $tasksRemaining -= $n;
        }
        for ($t = 0; $t < $tasksRemaining; $t += 1)
        {
            $p = rand(0, sizeof($solver->projects) - 1);

            $taskNumber = $taskIndex++;
            $solver->tasks[$taskNumber] = $p;
            array_push($solver->projectTasks[$p], $taskNumber);
        }

        $solver->projectStudents = array_fill(0, sizeof($solver->projects), []);
        $solver->studentProjects = array_fill(0, sizeof($solver->students), -1);

        $solver->numSkills = $numSkills;

        $_SESSION['solver'] = $solver;
    ?>
    <form action="iterate.php">
        <input type="submit" value="Begin Assign">
    </form>
<?php require "../PAGES/FOOTER_STAFF.PHP"; ?>
