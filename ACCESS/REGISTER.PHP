<?php
require ('../DATABASE/CONNECTDB.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" type="text/css" href="../STYLES/styleform.css">
<script type="text/javaScript">
	function validate(registration) {
		var digits="0123456789"
		var temp
		var email = document.registration.STUDENT_EMAIL.value
		var password = document.registration.STUDENT_PASSWORD.value
		var upper = /[A-Z]/g;
		var lower = /[a-z]/g;
		var number = /[0-9]/g;
		var deakin = "@deakin.edu.au"

			if (document.registration.STUDENT_ID.value.length < 9) {
				alert("Invalid Student ID. Must be nine characters long")
				return false
			}

			if (document.registration.STUDENT_PASSWORD.value.length < 8) {
				alert("Password is too short. It must be a minimum of eight characters long")
				return false
			}

			for (var i=0;i<document.registration.STUDENT_ID.value.length;i++) {
			temp = document.registration.STUDENT_ID.value.substring(i,i+1)
			if (digits.indexOf(temp)==-1) {
			alert("Invalid Student ID. Must only be numbers")
			return false
				}
			}

			if(document.registration.STUDENT_EMAIL.value.match(deakin)){
				return true
			}else {
				alert("Email must be a Deakin email")
				return false
			}

			if (document.registration.reemail.value != email) {
				alert("Emails don't match. Please make sure they are the same")
				return false
			}

			if (document.registration.cpassword.value != password) {
				alert("Passwords don't match. Please ensure that they are the same")
				return false
			}

			if (document.registration.STUDENT_PASSWORD.value.match(upper) && document.registration.STUDENT_PASSWORD.value.match(number)) {
				return true
			}else {
				alert("Password must contain at least one upper case letter and number")
				return false
			}
		return true
	}
</script>
</head>

<body>
<div class="Header">
	<h1>Corral</h1>
</div>

<div class="navbar">
	<a href="../PAGES/HOME">Home</a>
	<a href="../ACCESS/REGISTER">Register</a>
	<a href="../PAGES/CONTACT">Contacts</a>
	<a href="../PAGES/ABOUTUS">About Us</a>
	<div class="dropdown">
		<button class="dropbtn">Login
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
			<a href="../Access/login">Students</a>
			<a href="../ACCESS/stafflogin">Staff</a>
		</div>
	</div>
</div>

<h2 style="margin-left: 35%;">Registration</h2>
<form name="registration" onSubmit="return validate(registration)" method="post">
	Student ID: <input type="text" name="STUDENT_ID" maxlength="9" id="ip2" required><br><br>
	First Name: <input type="text" name="STUDENT_FIRSTNAME" id="ip2" required><br><br>
	Last Name: <input type="text" name="STUDENT_LASTNAME" id="ip2" required><br><br>
	Location: <select name="STUDENT_LOCATION">
		<option value="--">-----</option>
		<option value="Burwood">Burwood</option>
		<option value="Geelong">Geelong</option>
		<option value="Cloud">Cloud</option>
		</select><br><br>
	Email Address: <input type="text" name="STUDENT_EMAIL" size="40" id="ip2" required><br><br>
	Re-type Email Address: <input type="text" name="reemail" size="40" id="ip2" required><br><br>
	Password: <input type="password" name="STUDENT_PASSWORD" id="ip2" required><br><br>
	Re-type Password: <input type="password" name="cpassword" id="ip2" required><br><br>

		<input type="submit" name="Submit" value="Submit">
		<input type="reset" value="Clear Form"><br><br>

</form>

<?php

if (isset($_POST['STUDENT_PASSWORD'])) {
	$id = mysqli_real_escape_string($CON, $_POST['STUDENT_ID']);
	$firstname = mysqli_real_escape_string($CON, $_POST['STUDENT_FIRSTNAME']);
	$lastname = mysqli_real_escape_string($CON, $_POST['STUDENT_LASTNAME']);
	$location = mysqli_real_escape_string($CON, $_POST['STUDENT_LOCATION']);
	$email = mysqli_real_escape_string($CON, $_POST['STUDENT_EMAIL']);
	$password = mysqli_real_escape_string($CON, $_POST['STUDENT_PASSWORD']);
	$sql_id = "SELECT * FROM student WHERE STUDENT_ID = '$id'";
	$res_id = mysqli_query($CON, $sql_id);

	if (mysqli_num_rows($res_id) > 0) {
		echo "<p style='margin-left: 35%;'>There is an account with that Student ID. Please try again</p>";
	}else{
			$query = "INSERT INTO student (STUDENT_ID, STUDENT_FIRSTNAME, STUDENT_LASTNAME, STUDENT_LOCATION, STUDENT_EMAIL, STUDENT_PASSWORD) VALUES ('$id', '$firstname', '$lastname', '$location', '$email', '$password')";
			$result = mysqli_query($CON, $query);
			header('location: ../PAGES/STUDENTSUCCESSFULREG');
        }
}

?>

<div class="Footer">
	<h4>© Copyright Deakin University & Group 29 2018</h4>
</div>
</body>
