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
    execInBackground("C:\\xampp\\php\\php.exe processing.php");
?>
<div style="text-align: center; width: 100%;">
<p>The student allocations are being processed in the background. This will continue for the next 60 seconds.</p>
<p>You may view the progress and results from the Survey > Groups > List Groups page</p>
</div>
<script>
    function refresh()
    {
        sleep(1);
        document.getElementById("updater").src = "progress.php";
    }
</script>
<div style="text-align: center;">
    <iframe id="updater" onload="refresh()" style="border: 0; width: 50%;"></iframe>
</div>
<?php
    require "../PAGES/FOOTER_STAFF.PHP";
?>