<?php
  $PageTitle = "Staff Registration";
	$Script = '<script type="text/javaScript">
		function validate(registration) {
			var digits="0123456789"
			var temp
			var email = document.registration.STAFF_EMAIL.value
			var password = document.registration.STAFF_PASSWORD.value
      var strongpassword = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
			var upper = /[A-Z]/g;
			var lower = /[a-z]/g;
			var number = /[0-9]/g;
			var deakin = "@deakin.edu.au"

				if (document.registration.STAFF_ID.value.length < 9) {
					alert("Invalid STAFF ID. Must be nine characters long")
					return false
				}

				if (document.registration.STAFF_PASSWORD.value != strongpassword) {
					alert("Password must be at least 8 characters long including at least 1 alphabetical, numerical and special character)
					return false
				}

				for (var i=0;i<document.registration.STAFF_ID.value.length;i++) {
				temp = document.registration.STAFF_ID.value.substring(i,i+1)
				if (digits.indexOf(temp)==-1) {
				alert("Invalid Studnet ID. Must only be numbers")
				return false
					}
				}

				if(document.registration.STAFF_EMAIL.value.match(deakin)){
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

				if (document.registration.STAFF_PASSWORD.value.match(upper) && document.registration.STAFF_PASSWORD.value.match(number)) {
					return true
				}else {
					alert("Password must contain at least one upper case letter and number")
					return false
				}
			return true
		}
	</script>';
	require "HEADER_PUBLIC.PHP";
require ('../DATABASE/CONNECTDB.php');
?>

<h2 style="margin-left: 35%;">Registration</h2>
<form name="registration" onSubmit="return validate(registration)" method="post">
	Staff ID: <input type="text" name="STAFF_ID" maxlength="9" id="ip2" required><br><br>
	First Name: <input type="text" name="STAFF_FIRSTNAME" id="ip2" required><br><br>
	Last Name: <input type="text" name="STAFF_LASTNAME" id="ip2" required><br><br>
	Location: <select name="STAFF_LOCATION">
		<option value="--">-----</option>
		<option value="Burwood">Burwood</option>
		<option value="Geelong">Geelong</option>
		<option value="Cloud">Cloud</option>
		</select><br><br>
	Email Address: <input type="text" name="STAFF_EMAIL" size="40" id="ip2" required><br><br>
	Re-type Email Address: <input type="text" name="reemail" size="40" id="ip2" required><br><br>
	Password: <input type="password" name="STAFF_PASSWORD" id="ip2" required><br><br>
	Re-type Password: <input type="password" name="cpassword" id="ip2" required><br><br>

		<input type="submit" name="Submit" value="Submit">
		<input type="reset" value="Clear Form"><br><br>

</form>

<?php
if (isset($_POST['STAFF_PASSWORD'])) {
	$id = mysqli_real_escape_string($CON, $_POST['STAFF_ID']);
	$firstname = mysqli_real_escape_string($CON, $_POST['STAFF_FIRSTNAME']);
	$lastname = mysqli_real_escape_string($CON, $_POST['STAFF_LASTNAME']);
	$location = mysqli_real_escape_string($CON, $_POST['STAFF_LOCATION']);
	$email = mysqli_real_escape_string($CON, $_POST['STAFF_EMAIL']);
	$password = mysqli_real_escape_string($CON, $_POST['STAFF_PASSWORD']);
	$salt = 'juhladhfl465adfgadf564a3d5f4g6664645dfgvadf';
	$md5 = md5($salt . $password . $salt);
	$sql_id = "SELECT * FROM STAFF WHERE STAFF_ID = '$id'";
	$res_id = mysqli_query($CON, $sql_id);

	if (mysqli_num_rows($res_id) > 0) {
		echo "<p style='margin-left: 35%;'>There is an account with that STAFF ID. Please try again</p>";
	}else{
			$query = "INSERT INTO STAFF (STAFF_ID, STAFF_FIRSTNAME, STAFF_LASTNAME, STAFF_LOCATION, STAFF_EMAIL, STAFF_PASSWORD) VALUES ('$id', '$firstname', '$lastname', '$location', '$email', '$md5')";
			$result = mysqli_query($CON, $query);
			header('location: ../PAGES/STAFFSUCCESSFULREG');
        }
}
?>

<?php require "FOOTER_PUBLIC.PHP"; ?>
