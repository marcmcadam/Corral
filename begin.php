<?php
    $PageTitle = "Sorting Setup";
    require "header_staff.php";

    require "unitdata.php";
    
    $unitData = unitData($unitID);
    $skillNames = $unitData->skillNames;
    $sort = $unitData->sort;
    $students = $unitData->students;
    $projects = $unitData->projects;
    $unassigned = $unitData->unassigned;
?>
<script>
    var helps = [];
    helps["start"] = "";
    helps["iterations"] = "Sorting will automatically stop if this number of iterations are reached.<br><br><br>";
    helps["matrix"] = "The sorting will start at low quality and increase until it reaches this number.<br><br>This is how many students are compared at once. Increasing this:<br>- Allows more complex swaps, and will have a better result.<br>- Risks the server calculations timing-out or using too much memory.<br>Use the maximum available for server limits.<br><br><br>";

    function showHelp(helpName)
    {
        if (document.getElementById(helpName).innerHTML == "")
            document.getElementById(helpName).innerHTML = helps[helpName];
        else
            document.getElementById(helpName).innerHTML = "";
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
            </td><!--<td style="min-width: 64px; text-align: left;">
                <input type="button" id="start?" value="?" onclick="showHelp('start');" class="updateButton"><br>
                <br>
            </td>-->
        </tr><tr>
            <td><div id="start" style='text-align: left; font-size: 0.75em;'></div></td>
        </tr><tr>
            <td colspan="2">
                Maximum Running Time<br><input class="inputBox" type="text" name="iterations" value="<?php echo $sort->iterations; ?>">
                <input type="button" id="iterations?" value="?" onclick="showHelp('iterations');" class="updateButton"><br>
                <br>
            </td>
        </tr><tr>
            <td><div id="iterations" style='text-align: left; font-size: 0.75em;'></div></td>
        </tr><tr> 
            <td colspan="2">
                Maximum Quality<br><input class="inputBox" type="text" name="matrix" value="<?php echo $sort->matrix; ?>">
                <input type="button" id="matrix?" value="?" onclick="showHelp('matrix');" class="updateButton"><br>
                <br>
            </td>
        </tr><tr>
            <td><div id="matrix" style='text-align: left; font-size: 0.75em;'></div></td>
        </tr>
    </table>
</form>
<?php
    require "footer.php";
?>
