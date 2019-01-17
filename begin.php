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
<form action="begin2.php" method="post" target="_blank">
    <h2>Sorting Setup</h2>
    <input type="submit" value="Start Sorting" class="inputButton"><br>
    <br><br>
    Maximum Running Time<br><input class="inputBox" type="text" name="iterations" value="<?php echo $sort->iterations; ?>">
    <span class='tooltip'> ?<span class='tooltiptext'>Sorting will automatically stop if this number of iterations are reached.</span></span>
    <br><br>
    Quality<br><input class="inputBox" type="text" name="matrix" value="<?php echo $sort->matrix; ?>">
    <span class='tooltip'> ?<span class='tooltiptext'>This is how many students are compared at once. Increasing this:<br>- Allows more complex swaps, and will have a better result.<br>- Risks the server calculations timing-out or using too much memory.<br><br>Use the maximum available for server limits.</span></span>
</form>
<?php
    require "footer.php";
?>
