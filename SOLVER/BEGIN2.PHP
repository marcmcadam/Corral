<?php
    $PageTitle = "Begin Solving";
    require "../PAGES/HEADER_STAFF.PHP";
    
    function execInBackground($cmd)
    {
        if (substr(php_uname(), 0, 7) == "Windows"){
            pclose(popen("start /B ". $cmd, "r"));
        }else{
            exec($cmd . " > /dev/null &");
        }
    }
    execInBackground("C:\\xampp\\php\\php.exe PROCESSING2.PHP");
?>
<div style="text-align: center; width: 100%;">
    <p>The student allocations are being processed in the background.</p>
    <p>You may view the progress and results from the Survey > Groups > List Groups page</p>
</div>
<?php
    require "../PAGES/FOOTER_STAFF.PHP";
?>
