<?php
    $PageTitle = "Display Sorting Results";
    require "SOLVER.PHP";
    require "../PAGES/HEADER_STAFF.PHP";
    set_time_limit(120);
    $solver = $_SESSION['solver'];
    $solver->iterate();
    require "ITERATE_DISPLAY.PHP";
?>
