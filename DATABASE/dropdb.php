<?php
    require_once "../condb.php";

    $drop = "DROP DATABASE CORRAL_PROJECT";
    if (mysqli_query($CON, $drop))
        echo "<p>Database dropped</p>";
    else
        echo "Unable to drop database: " . mysqli_error($CON);
    unset($drop);
?>
