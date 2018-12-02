<?php
require ('../DATABASE/CONNECTDB.php');
$PageTitle = "Registration";
require "../PAGES/HEADER_PUBLIC.PHP";
$script = '<script type="text/javaScript">
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
				alert("Emails don\'t match. Please make sure they are the same")
				return false
			}

			if (document.registration.cpassword.value != password) {
				alert("Passwords don\'t match. Please ensure that they are the same")
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
</script>';
?>
<div class="title">
<h2 style="text-align: center">Student Registration</h2>
</div>
<div class="container">
<form name="registration" onSubmit="return validate(registration)" method="post">
	<div class="title">Student ID:</div> <br> <input type="text" name="STUDENT_ID" maxlength="9" id="ip2" required placeholder="Create Your Student ID"><br><br>
	<div class="title">Your name:</div> <br> <input type="text" name="STUDENT_FIRSTNAME" id="ip2" required placeholder="Your First Name">
	<span class="otherinput">
	<input type="text" name="STUDENT_LASTNAME" id="ip2" required placeholder="Your Last Name">
</span><br><br><br>
	<div class="title">Location:</div> <br> <select name="STUDENT_LOCATION" class="input" >
		<option value="--">-----</option>
		<option value="Burwood">Burwood</option>
		<option value="Geelong">Geelong</option>
		<option value="Cloud">Cloud</option>
		</select><br><br><br>
	<span class="title">Email Address:</span>
	<span class="othertitle">Re-type Email Address: </span> <br><br>
	<input type="text" name="STUDENT_EMAIL" size="40" id="ip2" required placeholder="Your Email Address">
	<span class="otherinput"><input type="text"name="reemail" size="40" id="ip2" required placeholder="Confirm Your Email Address"><br><br><br></span>
	<span class="title">Password:</span>
	<span class="othertitleone">Re-type Password: </span> <br><br>
	<input type="password" name="STUDENT_PASSWORD" id="ip2" required placeholder="Your Password">
	<span class="otherinput"><input type="password" name="cpassword" id="ip2" required placeholder="Confirm Your Password"><br><br><br></span>

		<input type="submit" class="button" name="Submit" value="Submit"> &nbsp; &nbsp; &nbsp;
		<input type="reset" class="button" "value="Clear Form"><br><br>

</form>
</div>
<?php

if (isset($_POST['STUDENT_PASSWORD'])) {
	$id = mysqli_real_escape_string($CON, $_POST['STUDENT_ID']);
	$firstname = mysqli_real_escape_string($CON, $_POST['STUDENT_FIRSTNAME']);
	$lastname = mysqli_real_escape_string($CON, $_POST['STUDENT_LASTNAME']);
	$location = mysqli_real_escape_string($CON, $_POST['STUDENT_LOCATION']);
	$email = mysqli_real_escape_string($CON, $_POST['STUDENT_EMAIL']);
	$password = mysqli_real_escape_string($CON, $_POST['STUDENT_PASSWORD']);
	$salt = 'juhladhfl465adfgadf564a3d5f4g6664645dfgvadf';
	$md5 = md5($salt . $password . $salt);
	$sql_id = "SELECT * FROM student WHERE STUDENT_ID = '$id'";
	$res_id = mysqli_query($CON, $sql_id);

	if (mysqli_num_rows($res_id) > 0) {
		echo "<p style='margin-left: 35%;'>There is an account with that Student ID. Please try again</p>";
	}else{
			$query = "INSERT INTO student (STUDENT_ID, STUDENT_FIRSTNAME, STUDENT_LASTNAME, STUDENT_LOCATION, STUDENT_EMAIL, STUDENT_PASSWORD) VALUES ('$id', '$firstname', '$lastname', '$location', '$email', '$md5')";
			$result = mysqli_query($CON, $query);
			header('location: ../PAGES/STUDENTSUCCESSFULREG');
        }
}

?>
<?php require "../PAGES/FOOTER_PUBLIC.PHP"; ?>
