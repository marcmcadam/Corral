<?php
    $PageTitle = "Sorting Started";
    require "../PAGES/HEADER_STAFF.PHP";
    
    $isWindows = (substr(php_uname(), 0, 7) == "Windows");
    if ($isWindows)
    {
        // there is no good solution to backgrounding in windows
        //exec("C:\\xampp\\php\\php.exe SORT.PHP > NUL"); // this hangs other php pages
        header("location: SORT.PHP");
        die;
    }
    else
        exec("C:\\xampp\\php\\php.exe SORT.PHP /dev/null");
?>
<div style="text-align: center; width: 100%;">
    <p>The student allocations are being processed in the background.</p>
    <p>You may view the progress and results from the <a href="GROUPS.PHP">List Groups</a> page.</p>
</div>
<?php
    require "../PAGES/FOOTER_STAFF.PHP";
?>
