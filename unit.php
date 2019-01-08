<?php
 	$PageTitle = "Unit Update";
	require "header_staff.php";
  require "sanitise.php";
  require_once "connectdb.php";
  require_once "getfunctions.php";

  $staff = getStaff($CON, TRUE);
  $staff_IDs = getStaff($CON);
  $units = getUnits($CON);

  // Check for $_POST:
  // If form has been submitted to update details, validate input, insert to DB
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = TRUE;

    if(!isset($_POST['unit_ID']) || !preg_match('/^SIT[0-9]{3}T[1-3][0-9]{2}$/', $_POST['unit_ID'])) {
      echo "<h3>Invalid Unit Selected</h3>";
      $valid = FALSE;
    }
    if(!isset($_POST['unit_Name'])) {
      echo "<h3>Unit Name required</h3>";
      $valid = FALSE;
    }
    if(!isset($_POST['sta_ID']) || !in_array($_POST['sta_ID'], $staff_IDs)) {
      echo "<h3>Invalid Staff Member selected</h3>";
      $valid = FALSE;
    }
    if(!isset($_POST['skill_00'])) {
      echo "<h3>At least one skill name should be defined.</h3>";
      $valid = FALSE;
    }

    $unit_ID = $_POST['unit_ID']; // Needs to be set outside if($valid) so that form display presents correctly
    if ($valid) {
      $skillkeys = [];
      $skills = [];
      $unit_Name = SanitiseGeneric($_POST['unit_Name'], $CON);
  		for($i=0;$i<20;$i++) {
        $skill = "skill_".sprintf('%02d', $i);
        if(isset($_POST[$skill])) {
          array_push($skillkeys, $skill);
          array_push($skills, SanitiseGeneric($_POST[$skill], $CON));
        }
      }

      $sql = "UPDATE unit SET unit_Name='$unit_Name'";
      for($i=0;$i<sizeof($skills);$i++) {
        $sql .= ", ".$skillkeys[$i]."='".$skills[$i]."'";
      }
      $sql .= " WHERE unit_ID='".$unit_ID."'";
      if(!mysqli_query($CON,$sql)) {
        echo "<h3>There was a database error.</h3>";
      } else {
        echo "<h3>Unit Record updated.</h3>";
        echo "<p><a href='unitlist.php'>Back to Unit List</a></p>";
      }
    }
  }

  // Check for $_GET:
  // If we are getting a unit's details, validate the ID and display
  // OR check for $_POST but an invalid submission, to reprint form
  if (($_SERVER["REQUEST_METHOD"] == "GET" && in_array($_GET['u'], $units)) || ($_SERVER["REQUEST_METHOD"] == "POST" && $valid == FALSE)) {
    $unit_ID = $_GET['u'];
    $query = "SELECT * FROM unit WHERE unit_ID = '".$unit_ID."'";
    $result = mysqli_query($CON, $query) or die(mysqli_error($CON));
    if ($row = mysqli_fetch_assoc($result)) {
      echo "<form action=".htmlspecialchars($_SERVER['PHP_SELF'])." method='post'><table align='center'>";
      echo "<input type='hidden' name='unit_ID' value='".$unit_ID."' />
      <tr>
        <td><label for='unit_Name'>Unit Name</label></td>
        <td><input type='text' name='unit_Name' id='unit_Name' value='". $row['unit_Name']."' class='inputBox'></td>
      </tr>
      <tr>
        <td><label for='sta_ID'>Unit Chair</label></td>
        <td><select name ='sta_ID' class='inputList'>";
      foreach($staff as $member) {
        echo "<option value='".$member[0]."'"; if ($row['sta_ID'] == $member[0]) echo "selected";
        echo ">".$member[1]." ".$member[2]."</option>";
      }
      echo "</select></td>
      </tr>";
      for ($i=0;$i<20;$i++) {
        $j = $i + 1;
        echo '
         <tr>
          <td>Skill '.$j.'</td>
          <td><input type="text" name="'.sprintf('skill_%02d', $i).'" value="'.$row[sprintf('skill_%02d',$i)].'" class="inputBox"></td>
         </tr>';
      }
      echo "
        <tr>
          <td><input type='submit' value='Update' class='inputButton'></td>
          <td><input type='reset' value='Reset' class='inputButton'></td>
        </tr>
      </table></form>";
    } else {
      echo "<h3>Invalid Unit Selected</h3>";
    }
  }
  require "footer.php";
?>
