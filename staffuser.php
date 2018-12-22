<?php
 	$PageTitle = "Staff Update";
	require "header_staff.php";
  require "sanitise.php";
  require_once "connectdb.php";

  // Check for $_POST:
  // If form has been submitted to update details, validate input, insert to DB
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = TRUE;

    if(!isset($_POST['staffid']) || !preg_match('/[0-9]{9}/', $_POST['staffid'])) {
      echo "<h3>Invalid Staff Member Selected</h3>";
      $valid = FALSE;
    }
    if(!isset($_POST['STAFF_FIRSTNAME'])) {
      echo "<h3>Staff first name required</h3>";
      $valid = FALSE;
    }
    if(!isset($_POST['STAFF_LASTNAME'])) {
      echo "<h3>Staff last name required</h3>";
      $valid = FALSE;
    }
    if(!isset($_POST['STAFF_LOCATION']) || !preg_match('/[1-3]/', $_POST['STAFF_LOCATION'])) {
      echo "<h3>Invalid campus selected</h3>";
      $valid = FALSE;
    }
    if(!isset($_POST['STAFF_EMAIL']) || !preg_match('/[A-Za-z0-9]*@deakin.edu.au/', $_POST['STAFF_EMAIL'])) {
      echo "<h3>Invalid Deakin email address</h3>";
      $valid = FALSE;
    }

    $staffid = SanitiseGeneric($_POST['staffid'], $CON); // Needs to be set outside if($valid) so that form display presents correctly
    if ($valid) {
      $firstname = SanitiseGeneric($_POST['STAFF_FIRSTNAME'], $CON);
  		$lastname = SanitiseGeneric($_POST['STAFF_LASTNAME'], $CON);
  		$location = SanitiseGeneric($_POST['STAFF_LOCATION'], $CON);
  		$email = SanitiseEmail($_POST['STAFF_EMAIL'], $CON);

      $sql = "UPDATE STAFF SET STAFF_LOCATION='$location',STAFF_EMAIL='$email',STAFF_FIRSTNAME='$firstname',STAFF_LASTNAME='$lastname' WHERE STAFF_ID=$staffid";
      if(!mysqli_query($CON,$sql)) {
        echo "<h3>There was a database error.</h3>";
      } else {
        echo "<h3>Staff Record updated.</h3>";
        echo "<p><a href='stafflist.php'>Back to Staff List</a></p>";
      }
    }
  }

  // Check for $_GET:
  // If we are getting a staff user's details, validate the ID and display
  // OR check for $_POST but an invalid submission, to reprint form
  if (($_SERVER["REQUEST_METHOD"] == "GET" && $staffid = filter_input(INPUT_GET, 'staffid', FILTER_VALIDATE_INT)) ||
      ($_SERVER["REQUEST_METHOD"] == "POST" && $valid == FALSE)) {
    $query = "SELECT * FROM STAFF WHERE STAFF_ID = '".$staffid."'";
    $result = mysqli_query($CON, $query) or die(mysqli_error($CON));
    if ($row = mysqli_fetch_assoc($result)) {
      echo "<p><form action=".htmlspecialchars($_SERVER['PHP_SELF'])." method='post'></p>";
      echo "<input type='hidden' name='staffid' value='".$staffid."' />
      <p>Firstname </p>
      <p><input type ='text' name ='STAFF_FIRSTNAME' value ='". $row['STAFF_FIRSTNAME']."' class='inputBox'></p>
      <p>Lastname </p>
      <p><input type ='text' name ='STAFF_LASTNAME' value ='". $row['STAFF_LASTNAME']."' class='inputBox'></p>
      <p>Location </p>
      <p><select name ='STAFF_LOCATION' class='inputList'>
          <option value='1'"; if ($row['STAFF_LOCATION'] == 1) echo "selected"; echo ">Burwood</option>
          <option value='2'"; if ($row['STAFF_LOCATION'] == 2) echo "selected"; echo ">Geelong</option>
          <option value='3'"; if ($row['STAFF_LOCATION'] == 3) echo "selected"; echo ">Cloud</option>
      </select></p>
      <p>Email </p>
      <p><input type='text' name='STAFF_EMAIL' value='".$row['STAFF_EMAIL']."' class='inputBox'></p>
      <p><input type='submit' value='Update' class='inputButton'>&nbsp&nbsp<input type='reset' value='Reset' class='inputButton'></p>
      </form></p>";
    } else {
      echo "<h3>Invalid Staff Member Selected</h3>";
    }
  }
  require "footer.php";
?>
