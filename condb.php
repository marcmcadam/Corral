<?php
    $CON = mysqli_connect('LOCALHOST', 'ADMIN', 'PASSWORD1');
    if (!$CON)
        die("Database connection failed: " . mysqli_error($CON));
    $CON->set_charset("utf8");
?>
