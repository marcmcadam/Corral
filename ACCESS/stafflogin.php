<?php
session_start();
require('../DATABASE/CONNECTDB.PHP');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login Page</title>
<link rel="stylesheet" type="text/css" href="../STYLES/styleform.css">
</head>

<div class="Header">
	<h1>Corral Project</h1>
</div>

<div class="navbar">
	<a href="../PAGES/HOME.html">Home</a>
	<a href="../PAGES/REGISTER.html">Projects</a>
	<a href="../PAGES/CONTACT.html">Contacts</a>
	<a href="../PAGES/ABOUTUS.html">About Us</a>
	<div class="dropdown">
		<button class="dropbtn">Login
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
			<a href="../Access/login.php">Students</a>
			<a href="../ACCESS/stafflogin.php">Staff</a>
		</div>
	</div>
</div>
      <form method="POST">
        <h2>Please Log In</h2>
    <span class="input-group-addon" id="basic-addon1"></span>
    <input type="text" name="STAFF_ID" placeholder="STAFF ID" id="ip2" required><br><br>
        <input type="password" name="STAFF_PASSWORD" id="ip2" placeholder="Password" required><br><br>
        <button type="submit">LOGIN</button>
        <button type="button" onclick="location.href='../PAGES/STAFFREGISTRATION.HTML';" vaule="Register" />REGISTER</button><br><br>
      </form>

<div class="Footer">
	<h4>This is copyrighted by Deakin and the project group 29</h4>
</div>
<?php  //Start the Session

//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['STAFF_ID']) and isset($_POST['STAFF_PASSWORD'])){
//3.1.1 Assigning posted values to variables.
$id = mysqli_real_escape_string($CON, $_POST['STAFF_ID']);
$password = mysqli_real_escape_string($CON, $_POST['STAFF_PASSWORD']);
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT * FROM STAFF WHERE STAFF_ID='$id' and STAFF_PASSWORD='$password'";
$result = mysqli_query($CON, $query) or die(mysqli_error($CON));
$count = mysqli_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
if ($count == 1){
$user = $result->fetch_assoc();
$_SESSION['STAFF_ID'] = $id;
$_SESSION['STAFF_FIRSTNAME'] = $user['STAFF_FIRSTNAME'];
$_SESSION['STAFF_LASTNAME'] = $user['STAFF_LASTNAME'];
}else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
header("location: ../ACCESS/stafferror.php");
//$fmsg = "Invalid Login Credentials.";
}
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['STAFF_ID'])){
$id = $_SESSION['STAFF_ID'];
$staff_firstname = $_SESSION['STAFF_FIRSTNAME'];
$staff_lastname = $_SESSION['STAFF_LASTNAME'];
$_SESSION['STAFF_ID'] = true;
header("location: ../PAGES/STAFFPROFILE.PHP");
}
//3.2 When the user visits the page first time, simple login form will be displayed.
?>

</body>
</html>
