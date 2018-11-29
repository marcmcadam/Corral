<?php
    require "SOLVER.PHP";
    session_start();
    $solver = $_SESSION['solver'];
    
    /*
    $cmd = "ITERATE_PROCESS.PHP";
    if (substr(php_uname(), 0, 7) == "Windows"){ 
        pclose(popen("start /B ". $cmd, "r"));  
    }else{ 
        exec($cmd . " > /dev/null &");   
    }
    */
    require "ITERATE_PROCESS.PHP";
?>
