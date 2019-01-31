<?php
 	$PageTitle = "Unit Update";
	require "header_staff.php";
  require "sanitise.php";
  require_once "connectdb.php";
  require_once "getfunctions.php";

  $staff = getStaff($CON, TRUE);
  $staff_IDs = getStaff($CON);
  $units = getUnits($CON);
  $unit_new = "";

  echo "<h2>Unit Details</h2>";

  // Check for $_POST, to see if form has been submitted to update details.
  // Validate input, insert to DB
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $v_unit_ID = $v_unit_Name = $v_sta_ID = $v_skill_00 = FALSE;

      if(isset($_POST['unit_ID'])) {
        if(in_array($_POST['unit_ID'], $units)) {
          // POST an existing unit ID. Updating an existing unit.
          $unit_ID = $_POST['unit_ID'];
          $v_unit_ID = TRUE;
          $unit_new = FALSE;
        } else echo "Error: Invalid Unit selected";
      }

      if(isset($_POST['unit_Code'])) {
        $unitCode = strtoupper($_POST['unit_Code']);
        if(preg_match('/^[[:alpha:]]{3}[0-9]{3}$/', $unitCode)) {
          if(isset($_POST['unit_Trim'])) {
            if(preg_match('/^T[1-3]$/', $_POST['unit_Trim'])) {
              if(isset($_POST['unit_Year'])) {
                if(preg_match('/^[0-9]{2}$/', $_POST['unit_Year'])) {
                  // POST a unit code + trim + year. Creating a new unit.
                  $unit_ID = $unitCode.$_POST['unit_Trim'].$_POST['unit_Year'];
                  if(in_array($unit_ID, $units)) {
                    echo "Error: Duplicate Unit / Study Period";
                    $unit_ID = NULL;
                  } else {
                    $v_unit_ID = TRUE;
                    $unit_new = TRUE;
                  }
                } else echo "Error: Invalid Year selected";
              } else echo "Error: No Year selected";
            } else echo "Error: Invalid Trimester selected";
          } else echo "Error: No Trimester selected";
        } else echo "Error: Invalid Unit Code selected";
      }

      if(isset($_POST['unit_Name']) && $_POST['unit_Name'] != "") {
        $unit_Name = SanitiseGeneric($_POST['unit_Name'], $CON);
        $v_unit_Name = TRUE;
      } else echo "Error: Unit Name is Required";
      if(isset($_POST['sta_ID'])) {
        if(in_array($_POST['sta_ID'], $staff_IDs)) {
          $sta_ID = $_POST['sta_ID'];
          $v_sta_ID = TRUE;
        } else echo "Error: Invalid Staff Member selected";
      } else echo "Error: No Staff Member selected";
      if(!isset($_POST['locked'])) {
        if(isset($_POST['skill_00']) && $_POST['skill_00'] != "") {
          $v_skill_00 = TRUE;
        } else echo "Error: At least one skill is required";
      } else {
        $locked = TRUE;
        $v_skill_00 = TRUE; // No skills are required when skillnames are locked.
      }

      // If all fields have been POST correctly, process skills data and build
      // appropriate query for update or insert
      if ($v_unit_ID && $v_unit_Name && $v_sta_ID && $v_skill_00) {
        $valid = TRUE;
        $skillkeys = [];
        $skills = [];
        $skillnum = 0;
    		for($i=0;$i<20;$i++) {
          $skill = "skill_".sprintf('%02d', $i);
          if(isset($_POST[$skill]) && $_POST[$skill] != "") {
            $key = "skill_".sprintf('%02d', $skillnum);
            array_push($skillkeys, $key);
            array_push($skills, SanitiseGeneric($_POST[$skill], $CON));
            $skillnum++;
          }
        }
        if($unit_new == FALSE) {
          // Updating an existing unit, build query
          $sql = "UPDATE unit SET unit_Name='$unit_Name', sta_ID='$sta_ID'";
          if(!isset($locked)) {
            for($i=0;$i<sizeof($skills);$i++) {
              $sql .= ", ".$skillkeys[$i]."='".$skills[$i]."'";
            }
            for($i=sizeof($skills);$i<20; $i++) {
              $sql .= ", skill_".sprintf('%02d', $i)."= NULL";
            }
          }
          $sql .= " WHERE unit_ID='".$unit_ID."'";
        }
        if($unit_new == TRUE) {
          // Creating a new unit, build query
          $sql = "INSERT INTO unit (unit_ID, unit_Name, sta_ID, ";
          for($i=0; $i<sizeof($skills);$i++) {
            $sql .= $skillkeys[$i].", ";
          }
          for($i=sizeof($skills);$i<20; $i++) {
            $sql .= "skill_".sprintf('%02d', $i).", ";
          }
          $sql .= "survey_open)";
          $sql .= " VALUES ('".$unit_ID."', '".$unit_Name."', '".$_POST['sta_ID']."',";
          for($i=0; $i<sizeof($skills);$i++) {
            $sql .= "'".$skills[$i]."', ";
          }
          for($i=sizeof($skills);$i<20; $i++) {
            $sql .= "NULL, ";
          }
          $sql .= "0)";
        }
        if(!mysqli_query($CON,$sql)) {
          echo "<h3>There was a database error</h3>";
        } else {
          echo ($unit_new ? "<h3>New Unit Created.</h3>" : "<h3>Unit Record Updated.</h3>");
          echo "<p><a href='unitlist.php'>Back to Unit List</a></p>";
        }
      } else // Some field was invalid. Reprint form.
        $valid = FALSE;
  }

  // Check to see if we've submitted the form but there's been an error.
  // OR check if form has not been submitted, and we have a
  if (($_SERVER["REQUEST_METHOD"] == "POST" && $valid == FALSE) || $_SERVER["REQUEST_METHOD"] != "POST") {
    if(isset($_GET['u']) || ($unit_new == FALSE && isset($unit_ID))) {
      $collect = FALSE;
      if(isset($_GET['u'])) {
        if(in_array($_GET['u'], $units))
          $collect = TRUE;
      }
      if(isset($unit_ID)) {
        if(in_array($unit_ID, $units))
          $collect = TRUE;
      }

      if ($collect == TRUE) {
        // Valid unit specified by get, fill form with this information for update
        $update = TRUE;
        if($_SERVER["REQUEST_METHOD"] != "POST") {
          if(isset($_GET['u']))
            $unit_ID = $_GET['u'];
        }
        $query = "SELECT * FROM unit WHERE unit_ID = '".$unit_ID."'";
        $result = mysqli_query($CON, $query) or die(mysqli_error($CON));
        $row = mysqli_fetch_assoc($result);
        $unit_Name = $row['unit_Name'];
        $valid = TRUE;
        $query = "SELECT * FROM project WHERE unit_ID = '".$unit_ID."'";
        $result = mysqli_query($CON, $query) or die(mysqli_error($CON));
        $project_Count = mysqli_num_rows($result);
        $query = "SELECT * FROM surveyanswer WHERE unit_ID = '".$unit_ID."' AND submitted = 1";
        $survey_Count = mysqli_num_rows($result);
        if ($project_Count > 0 || $survey_Count > 0) {
          $locked = TRUE;
        } else {
          $locked = FALSE;
        }
      } else {
        // Invalid unit specified by get, print error messsage and continue with create unit form
        echo "<h3>Invalid Unit Selected</h3>";
      }
    } else {
      // New unit
      $update = FALSE;
      $locked = FALSE;
    }
    echo "<form action=".htmlspecialchars($_SERVER['PHP_SELF'])." method='post'><table align='center'>";
    echo "
    <tr>
      <td colspan='2' align='right'><label for='unit_Name'>Unit Name</label></td>
      <td colspan='2' align='left'><input type='text' name='unit_Name' id='unit_Name'";
      echo (isset($unit_Name) ? " value='".$unit_Name."'" : "");
    echo "
      class='inputBox' required></td>
    </tr>";
    if(isset($unit_ID) && $unit_new==FALSE) {
      echo "
      <tr>
        <td colspan='2' align='right'><label for='unit_ID'>Unit ID</label></td>
        <td colspan='2' align='left'><input type='text' name='unit_IDd' id='unit_IDd' value='".$unit_ID."' class='inputBox' disabled><input type='hidden' name='unit_ID' id='unit_ID' value='".$unit_ID."'</td>
      </tr>";
    } else {
      echo "
      <tr>
        <td colspan='2' align='right'><label for='unit_Code'>Unit Code</label></td>
        <td colspan='2' align='left'><input type='text' name='unit_Code' id='unit_Code' class='inputBox' required></td>
      </tr>
      <tr>
        <td colspan='2' align='right'><label for='unit_Trim'>Study Period</label></td>
        <td colspan='2' align='left'><select name='unit_Trim' class='inputList'>
          <option value='T1'>T1</option>
          <option value='T2'>T2</option>
          <option value='T3'>T3</option>
        </select>
        <select name='unit_Year' class='inputList'>
          <option value='19'>2019</option>
          <option value='20'>2020</option>
          <option value='21'>2021</option>
        </select></td>
      </tr>";
    }

    echo "<tr>";
    //echo "  <td colspan='2' align='right'><label for='sta_ID'>Unit Chair</label></td>";
    echo "  <td></td>";
    echo "  <td colspan='2' align='left'><select name='sta_ID' class='inputList' hidden>";
    foreach($staff as $member) {
      echo "
      <option value='".$member[0]."'";
      if (isset($row['sta_ID'])) {
        if ($row['sta_ID'] === $member[0]) echo " selected";
      }
      else if ($member[3] === $id)
        echo " selected";
      echo ">".$member[1]." ".$member[2]."</option>";
    }
    echo "</select></td>
    </tr>";
    if ($locked == TRUE) {
      echo "<tr><td colspan='4'><span style='color:red'>Skill Names cannot be edited once projects added or surveys completed.</span>
      <input type='hidden' name='locked' value='1' /></td></tr>";
    }
	$j=1;
    for ($i=0;$i<20;$i++) {
      echo "<tr><td>Skill ".$j++."</td><td><input type='text' name='".sprintf('skill_%02d', $i)."'";
        echo (isset($row[sprintf('skill_%02d',$i)]) ? " value='".$row[sprintf('skill_%02d',$i)]."'" : "" );
        echo "class='inputBox' ";
        if ($locked == FALSE) {
          echo ($i==0 ? 'required' : '')."></td>";
        } elseif ($locked == TRUE) {
          echo "disabled></td>";
        }
		$i += 1;
		echo "<td>Skill ".$j++."</td><td><input type='text' name='".sprintf('skill_%02d', $i)."'";
        echo (isset($row[sprintf('skill_%02d',$i)]) ? " value='".$row[sprintf('skill_%02d',$i)]."'" : "" );
        echo "class='inputBox' ";
        if ($locked == FALSE) {
          echo ($i==0 ? 'required' : '')."></td>";
        } elseif ($locked == TRUE) {
          echo "disabled></td></tr>";
        }
    }
    echo "
      <tr>
        <td colspan='2'><input type='submit' value='".($update == FALSE ? 'Submit' : 'Update')."' class='inputButton'></td>
        <td colspan='2'><input type='reset' value='Reset' class='inputButton'></td>
      </tr>
    </table></form>";

  }
  require "footer.php";
?>
