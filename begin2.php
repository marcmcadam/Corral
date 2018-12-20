<?php
    $PageTitle = "Sorting";
    require "header_staff.php";

    $isWindows = (substr(php_uname(), 0, 7) == "Windows");
    if ($isWindows)
    {
        // there is no good solution to backgrounding in windows
        //exec("C:\\xampp\\php\\php.exe SORT.PHP > NUL"); // this hangs other php pages
        header("location: sort.php");
        die;
    }
    else
        exec("C:\\xampp\\php\\php.exe sort.php /dev/null");
?>
<div style="text-align: center; width: 100%;">
    <p>The student allocations are being processed in the background.</p>
    <p>You may view the progress from <a href="sortedgroups.php">this page</a>.</p>
</div>
<?php
    require "footer_staff.php";
?>
