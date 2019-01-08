<?php
 	$PageTitle = "Staff Update";
	require "header_staff.php";
  require "sanitise.php";
  require_once "connectdb.php";
  require_once "getfunctions.php";

  // Check for $_POST:
  // If form has been submitted to update details, validate input, insert to DB
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = TRUE;

    if(!isset($_POST['sta_ID']) || !preg_match('/[0-9]+/', $_POST['sta_ID'])) {
      echo "<h3>Invalid Staff Member Selected</h3>";
      $valid = FALSE;
    }
    if(!isset($_POST['sta_FirstName'])) {
      echo "<h3>Staff first name required</h3>";
      $valid = FALSE;
    }
    if(!isset($_POST['sta_LastName'])) {
      echo "<h3>Staff last name required</h3>";
      $valid = FALSE;
    }
    if(!isset($_POST['sta_Campus']) || !preg_match('/[1-3]/', $_POST['sta_Campus'])) {
      echo "<h3>Invalid campus selected</h3>";
      $valid = FALSE;
    }
    if(!isset($_POST['sta_Email']) || !preg_match('/[A-Za-z0-9]*@deakin.edu.au/', $_POST['sta_Email'])) {
      echo "<h3>Invalid Deakin email address</h3>";
      $valid = FALSE;
    }

    $staffid = $_POST['sta_ID']; // Needs to be set outside if($valid) so that form display presents correctly
    if ($valid) {
      $firstname = SanitiseGeneric($_POST['sta_FirstName'], $CON);
  		$lastname = SanitiseGeneric($_POST['sta_LastName'], $CON);
  		$campus = $_POST['sta_Campus'];
  		$email = SanitiseEmail($_POST['sta_Email'], $CON);

      $sql = "UPDATE staff SET sta_Campus='$campus',sta_Email='$email',sta_FirstName='$firstname',sta_LastName='$lastname' WHERE sta_ID=$staffid";
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
    $query = "SELECT * FROM staff WHERE sta_ID = '".$staffid."'";
    $result = mysqli_query($CON, $query) or die(mysqli_error($CON));
    if ($row = mysqli_fetch_assoc($result)) {
      echo "<p><form action=".htmlspecialchars($_SERVER['PHP_SELF'])." method='post'></p>";
      echo "<input type='hidden' name='sta_ID' value='".$staffid."' />
      <p>Firstname </p>
      <p><input type ='text' name ='sta_FirstName' value ='". $row['sta_FirstName']."' class='inputBox'></p>
      <p>Lastname </p>
      <p><input type ='text' name ='sta_LastName' value ='". $row['sta_LastName']."' class='inputBox'></p>
      <p>Campus </p>
      <p><select name ='sta_Campus' class='inputList'>
          <option value='1'"; if ($row['sta_Campus'] == 1) echo "selected"; echo ">Burwood</option>
          <option value='2'"; if ($row['sta_Campus'] == 2) echo "selected"; echo ">Geelong</option>
          <option value='3'"; if ($row['sta_Campus'] == 3) echo "selected"; echo ">Cloud</option>
      </select></p>
      <p>Email </p>
      <p><input type='text' name='sta_Email' value='".$row['sta_Email']."' class='inputBox'></p>
      <p><input type='submit' value='Update' class='inputButton'>&nbsp&nbsp<input type='reset' value='Reset' class='inputButton'></p>
      </form></p>";
    } else {
      echo "<h3>Invalid Staff Member Selected</h3>";
    }
  }
  require "footer.php";
?>
