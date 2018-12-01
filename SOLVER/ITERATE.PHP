<?php
    require "SOLVER.PHP";
    session_start();
    set_time_limit(120);
    $solver = $_SESSION['solver'];
    $solver->iterate();
    require "ITERATE_DISPLAY.PHP";
?>
