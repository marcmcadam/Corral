<?php
    $PageTitle = "Terminate";
    require "header_staff.php";
    require_once "connectdb.php";

    /* The process can be immediately stopped using posix. Requires php posix install.
    $sql = "SELECT sta_Email, sort_pid FROM staff WHERE sta_Email = $id";
    $res = mysqli_query($CON, $sql);
    if (!$res)
    {
        echo "Error: " . mysqli_error($CON);
        die;
    }

    if ($row = mysqli_fetch_assoc($res))
    {
        $pid = $row["sort_pid"];
        posix_kill($pid, 15);
    }
    else
        $pid = null;
    */
    $sql = "UPDATE staff SET sort_pid = null WHERE sta_Email = $id";
    $res = mysqli_query($CON, $sql);
    if (!$res)
    {
        echo "Error: " . mysqli_error($CON);
        die;
    }

    echo "<p>Sorting will terminate at the next batch.</p>";
    echo "<p><a href='sortedgroups.php'>Return to the results page.</a></p>";

    require "footer.php";
?>
