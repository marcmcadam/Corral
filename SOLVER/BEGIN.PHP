<?php session_start(); ?>
<!DOCTYPE html>
<html>
<body>
    <?php
        require "SOLVER.PHP";

        require "GETDATA.PHP";

        $solver = new Solver();
        $solver->students = $students;
        $solver->projects = $projects;
        
        $solver->tasks = [];
        for ($i = 0; $i < sizeof($students); $i += 1)
            $solver->tasks[$i] = $i % sizeof($projects);
        
        $solver->projectStudents = array_fill(0, sizeof($projects), []);
        $solver->studentProjects = array_fill(0, sizeof($students), -1);
        
        $solver->numSkills = $numSkills;
        
        $_SESSION['solver'] = $solver;
    ?>
    <form action="ITERATE.php">
        <input type="submit" value="Begin Assign">
    </form>
</body>
</html>