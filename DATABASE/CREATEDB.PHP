<?php
    require_once "../condb.php";

    $corral = "CREATE DATABASE CORRAL_PROJECT";
    if (mysqli_query($CON, $corral))
        echo "<p>Database created</p>";
    else
        echo "Unable to create database: " . mysqli_error($CON);
    unset($corral);
?>
