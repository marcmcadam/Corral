<?php

    $CON = mysqli_connect('LOCALHOST', 'ADMIN', 'PASSWORD1');
    if (!$CON)
        die("Database connection failed: " . mysqli_error($CON));
    $CON->set_charset("utf8");

    $select = mysqli_select_db($CON, 'CORRAL_PROJECT');
    if (!$select)
        die("Database selection failed: " . mysqli_error($CON));
    unset($select);
?>
