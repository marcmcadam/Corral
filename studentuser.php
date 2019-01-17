<?php
 	$PageTitle = "Student Update";
	require "header_staff.php";
  require "sanitise.php";
  require_once "connectdb.php";

  // Check for $_POST:
  // If form has been submitted to update details, validate input, insert to DB
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = TRUE;

    if(!isset($_POST['stu_ID']) || !preg_match('/[0-9]{9}/', $_POST['stu_ID'])) {
      echo "<h3>Invalid Student ID Selected</h3>";
      $valid = FALSE;
    }
    if(!isset($_POST['stu_FirstName'])) {
      echo "<h3>Student first name required</h3>";
      $valid = FALSE;
    }
    if(!isset($_POST['stu_LastName'])) {
      echo "<h3>Student last name required</h3>";
      $valid = FALSE;
    }
    if(!isset($_POST['stu_Campus']) || !preg_match('/[1-3]/', $_POST['stu_Campus'])) {
      echo "<h3>Invalid campus selected</h3>";
      $valid = FALSE;
    }
    if(!isset($_POST['stu_Email']) || !preg_match('/[A-Za-z0-9]*@deakin.edu.au/', $_POST['stu_Email'])) {
      echo "<h3>Invalid Deakin email address</h3>";
      $valid = FALSE;
    }

    $studentid = SanitiseGeneric($_POST['stu_ID'], $CON); // Needs to be set outside if($valid) so that form display presents correctly

    // Confirm that student ID is already present in database
    $sql = "SELECT stu_ID FROM student WHERE stu_ID = '".$studentid."'";
    if (!($res = mysqli_query($CON,$sql)) || mysqli_num_rows($res) != 1){
      echo "<h3>Invalid Student ID Selected2</h3>";
      $valid = FALSE;
    }
    
    if ($valid) {
      $firstname = SanitiseGeneric($_POST['stu_FirstName'], $CON);
  		$lastname = SanitiseGeneric($_POST['stu_LastName'], $CON);
  		$location = SanitiseGeneric($_POST['stu_Campus'], $CON);
  		$email = SanitiseEmail($_POST['stu_Email'], $CON);

      $sql = "UPDATE student SET stu_Campus='$location',stu_Email='$email',stu_FirstName='$firstname',stu_LastName='$lastname' WHERE stu_ID=$studentid";
      if(!mysqli_query($CON,$sql)) {
        echo "<h3>There was a database error.</h3>";
      } else {
        echo "<h3>Student Record updated.</h3>";
        echo "<p><a href='studentlist.php'>Back to Student List</a></p>";
      }
    }
  }

  // Check for $_GET:
  // If we are getting a student user's details, validate the ID and display
  // OR check for $_POST but an invalid submission, to reprint form
  if (($_SERVER["REQUEST_METHOD"] == "GET" && $studentid = filter_input(INPUT_GET, 'studentid', FILTER_VALIDATE_INT)) ||
      ($_SERVER["REQUEST_METHOD"] == "POST" && $valid == FALSE)) {
    $query = "SELECT * FROM student WHERE stu_ID = '".$studentid."'";
    $result = mysqli_query($CON, $query) or die(mysqli_error($CON));
    if ($row = mysqli_fetch_assoc($result)) {
      echo "<p><form action=".htmlspecialchars($_SERVER['PHP_SELF'])." method='post'></p>
      <p>Student ID</p>
      <p><input type='text' name='stu_IDd' value='".$studentid."' class='inputBox' disabled/><input type='hidden' name='stu_ID' value='".$studentid."' class='inputBox'/>&nbsp;<span class='tooltip'>?<span class='tooltiptext'>You cannot edit a Student ID.<br>To change a Student ID, delete and recreate the student.</span></span></p>
      <p>Firstname </p>
      <p><input type='text' name='stu_FirstName' value='".$row['stu_FirstName']."' class='inputBox'/></p>
      <p>Lastname </p>
      <p><input type='text' name='stu_LastName' value='".$row['stu_LastName']."' class='inputBox'/></p>
      <p>Campus </p>
      <p><select name ='stu_Campus' class='inputList'>
          <option value='1'"; if ($row['stu_Campus'] == 1) echo "selected"; echo ">Burwood</option>
          <option value='2'"; if ($row['stu_Campus'] == 2) echo "selected"; echo ">Geelong</option>
          <option value='3'"; if ($row['stu_Campus'] == 3) echo "selected"; echo ">Cloud</option>
      </select></p>
      <p>Email </p>
      <p><input type='text' name='stu_Email' value='".$row['stu_Email']."' class='inputBox'></p>
      <p><input type='submit' value='Update' class='inputButton'>&nbsp&nbsp<input type='reset' value='Reset' class='inputButton'></p>
      </form></p>";
    } else {
      echo "<h3>Invalid Student Selected</h3>";
    }
  }
  require "footer.php";
?>
