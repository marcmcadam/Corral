<?php
 	$PageTitle = "Home";
    require "header_staff.php";

    if (isset($_GET["unit"]))
    {
        $unitID = (string)$_GET["unit"];
         // TODO: needs validation?
        $_SESSION["unit"] = $unitID;
    }
?>
<div>
  <h2>Welcome <?= $sta_FirstName. ' '.$sta_LastName?></h2>
  <p>Corral is an application that provides staff with the ability to match students to projects with <br>
    no manual assigning required. Once a project and desired skills have been set, a student list <br>
    is imported before Corral automatically assigns the best candidates for the project.<br>
    <br>
    Please select the unit that you want to make changes to below:<br>
    <?php
        $units = getStaffUnits($CON, $id);
        echo "<form>
                <select class='inputList' name='unit' onchange='this.form.submit()'>";
                $i=0;
                while (isset($units[$i])) {
                    echo "<option value='".$units[$i]."'";
                    if ($units[$i] === $unitID)
                        echo " selected";
                    echo ">".$units[$i]."</option>";
                    $i++;
                }
                echo "</select>
            </form>";
        ?>
</div>
<?php require "footer.php"; ?>
