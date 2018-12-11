<?php
    $PageTitle = "Terminate";
    require "../PAGES/HEADER_STAFF.PHP";
    require_once "../DATABASE/CONNECTDB.PHP";
    
    /* The process can be immediately stopped using posix. Requires php posix install.
    $sql = "SELECT staff_id, sort_pid FROM staff WHERE staff_id = $id";
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
    $sql = "UPDATE staff SET sort_pid = null WHERE staff_id = $id";
    $res = mysqli_query($CON, $sql);
    if (!$res)
    {
        echo "Error: " . mysqli_error($CON);
        die;
    }
    
    echo "<p>Sorting will terminate at the next batch.</p>";
    echo "<p><a href='GROUPS'>Return to the results page.</a></p>";
    
    require "../PAGES/FOOTER_STAFF.PHP";
?>
