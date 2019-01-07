<?php
    $PageTitle = "Terminate";
    require "header_staff.php";
    require_once "connectdb.php";

    $unit_ID = 'SIT302T218';
    
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

    $type = $_GET["method"];
    if ($type === "stop")
    {
        $sql = "UPDATE unit SET sort_stop=1 WHERE unit_ID='$unit_ID'";
        $res = mysqli_query($CON, $sql);
        if (!$res)
        {
            echo "Error: " . mysqli_error($CON);
            die;
        }
        echo "<p>Sorting will stop at the next batch. Wait for it to clear.</p>";
        echo "<p>If sorting has crashed, it can be <a href='terminatesort?method=clear'>force cleared</a>.</p>";
    }
    else if ($type === "clear")
    {
        $sql = "UPDATE unit SET sort_stop=1, sort_pid=null WHERE unit_ID='$unit_ID'";
        $res = mysqli_query($CON, $sql);
        if (!$res)
        {
            echo "Error: " . mysqli_error($CON);
            die;
        }
        echo "<p>Sorting flags have been cleared.</p>";
    }
    echo "<p><a href='sortedgroups.php'>Return to the results page.</a></p>";

    require "footer.php";
?>
