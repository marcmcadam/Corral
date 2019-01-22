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
    Maximum Running Time<br><input class="inputBox" type="text" name="iterations" value="<?php echo $sort->iterations; ?>">&nbsp;
    <span class='tooltip'>?<span class='tooltiptext'>Sorting will automatically stop if this number of iterations are reached.</span></span>
    <br><br>
    Quality<br><input class="inputBox" type="text" name="matrix" value="<?php echo $sort->matrix; ?>">&nbsp;
    <span class='tooltip'>?<span class='tooltiptext'>This limits how many students can be swapped each time. Higher numbers will produce better results, but may cause the server to crash by consuming more resources.</span></span>
</form>
<?php
    require "footer.php";
?>
