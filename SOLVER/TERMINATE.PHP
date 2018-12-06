<?php
    $PageTitle = "Terminate";
    require "../PAGES/HEADER_STAFF.PHP";
    require_once "../DATABASE/CONNECTDB.PHP";
    
    $sql = "UPDATE staff SET sort_pid = null WHERE staff_id = $id";
    $res = mysqli_query($CON, $sql);
    if (!$res)
    {
        echo "Error: " . mysqli_error($CON);
        die;
    }
    
    echo "<br><br>Sorting will terminate at the next batch.<br><br>";
    
    require "../PAGES/FOOTER_STAFF.PHP";
?>
