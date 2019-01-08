<?php
    $PageTitle = "Sorting Setup";
    require "header_staff.php";

    require "getdata.php";
    $unitID = "SIT302T218";
    sortingData($unitID, $skillNames, $sort, $students, $projects);
?>
<script>
    var helps = [];
    helps["start"] = "Begins the sorting process.<br>Once a large number of batches are processed without any swaps happening, the process is complete.<br>Only increasing the quality parameter will gain further improvement.<br><br><br>";
    helps["iterations"] = "This is how many times the sorting will be repeated to try to improve the result.<br>Use the minimum that you think would finish sorting.<br>If it does not complete, the sorting can be continued by running this again.<br><br><br>";
    helps["matrix"] = "This is how many students are compared at once. Increasing this:<br>- Allows more complex swaps, and will have a better result.<br>- Risks the server calculations timing-out or using too much memory.<br>Use the maximum available for server limits.<br>To save time, start with a low quality, and increase when the sorting has no more benefit.<br><br><br>";

    function showHelp(helpName)
    {
        document.getElementById(helpName).innerHTML = helps[helpName];
        document.getElementById(helpName + "?").style.display = 'none';
    }
</script>
<style>
    td {
        max-width: 75%;
    }
</style>
<form action="begin2.php" method="post" target="_blank">
    <h2>Sorting Setup</h2>
    <table align='center'>
        <tr>
            <td>
                <input type="submit" value="Start Sorting" class="inputButton"><br>
                <br>
            </td><td style="min-width: 64px;">
                <input type="button" id="start?" value="?" onclick="showHelp('start');" class="updateButton"><br>
                <br>
            </td>
        </tr><tr>
            <td><div id="start" style='text-align: left; font-size: 0.75em;'></div></td>
        </tr><tr>
            <td>
                Running Time<br><input class="inputBox" type="text" name="iterations" value="<?php echo $sort->iterations; ?>"><br>
                <br>
            </td><td>
                <input type="button" id="iterations?" value="?" onclick="showHelp('iterations');" class="updateButton"><br>
            </td>
        </tr><tr>
            <td><div id="iterations" style='text-align: left; font-size: 0.75em;'></div></td>
        </tr><tr> 
            <td>
                Quality<br><input class="inputBox" type="text" name="matrix" value="<?php echo $sort->matrix; ?>"><br>
                <br>
            </td><td>
                <input type="button" id="matrix?" value="?" onclick="showHelp('matrix');" class="updateButton"><br>
            </td>
        </tr><tr>
            <td><div id="matrix" style='text-align: left; font-size: 0.75em;'></div></td>
        </tr>
    </table>
</form>
<?php
    require "footer.php";
?>
