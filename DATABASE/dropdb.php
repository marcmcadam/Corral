<?php
    $CON = mysqli_connect('LOCALHOST', 'ADMIN', 'PASSWORD1');
    if (!$CON)
        die("Database connection failed: " . mysqli_error($CON));
    $CON->set_charset("utf8");

    $drop = "DROP DATABASE CORRAL_PROJECT";
    if (mysqli_query($CON, $drop))
        echo "<p>Database dropped</p>";
    else
        echo "Unable to drop database: " . mysqli_error($CON);
    unset($drop);
?>
