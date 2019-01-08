<?php
    $PageTitle = "Sorting";
    require "header_staff.php";
    require "connectdb.php";
    require_once "sanitise.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $sortMatrix = min(max((int)SanitiseGeneric($_POST['matrix'], $CON), 2), 10000);
        // $sortRandom = min(max((int)SanitiseGeneric($_POST['random'], $CON), 1), 10000);
        // $sortInertia = min(max((int)SanitiseGeneric($_POST['inertia'], $CON), 0), 10000);
        $sortIterations = min(max((int)SanitiseGeneric($_POST['iterations'], $CON), 2), 10000);

        // $sql = "UPDATE unit SET sort_matrix=$sortMatrix, sort_random=$sortRandom, sort_inertia=$sortInertia, sort_iterations=$sortIterations";
        $sql = "UPDATE unit SET sort_matrix=$sortMatrix, sort_iterations=$sortIterations";
        $sql .= " WHERE unit_ID='$unitID'"; // TODO: set hard coded ID!
        if (!mysqli_query($CON,$sql))
            die(mysqli_error($CON));

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
    }
    else
        die("Sort settings not provided.");
?>
<div style="text-align: center; width: 100%;">
    <p>The student allocations are being processed in the background.</p>
    <p>You may view the progress from <a href="sortedgroups.php">this page</a>.</p>
</div>
<?php
    require "footer.php";
?>
