<?php
    $CON = mysqli_connect('LOCALHOST', 'ADMIN', 'PASSWORD1');
    if (!$CON)
        die("Database connection failed: " . mysqli_error($CON));
    $CON->set_charset("utf8");

    $corral = "CREATE DATABASE corral_project";
    if (mysqli_query($CON, $corral))
        echo "<p>Database created</p>";
    else
        echo "Unable to create database: " . mysqli_error($CON);
    unset($corral);
?>
