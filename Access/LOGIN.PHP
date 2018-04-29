<?php
session_start();
REQUIRE('../DATABASE/CONNECTDB.PHP');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login Page</title>
<link rel="stylesheet" type="text/css" href="STYLES/styleform.css">
</head>

<div class="Header">
	<h1>Corral Project</h1>
</div>

<div class="navbar">
	<a href="#Home">Home</a>
	<a href="#Projects">Projects</a>
	<a href="#Conatacts">Contacts</a>
	<a href="#About Us">About Us</a>
	<div class="dropdown">
		<button class="dropbtn">Login
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
			<a href="login.php">Students</a>
			<a href="stafflogin.php">Teachers</a>
		</div>
	</div>
</div>
      <form method="POST">
        <h2>Please Log In</h2>
    <span class="input-group-addon" id="basic-addon1"></span>
    <input type="text" name="STUDENT_ID" placeholder="Student ID" required><br><br>
        <input type="password" name="STUDENT_PASSWORD" id="inputPassword" placeholder="Password" required><br><br>
        <button type="submit">LOGIN</button>
        <a href="REGISTER.PHP">REGISTER</a><br><br>
      </form>

<div class="Footer">
	<h4>This is copyrighted by Deakin and the project group 29</h4>
</div>
<?php  //Start the Session

//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['STUDENT_ID']) and isset($_POST['STUDENT_PASSWORD'])){
//3.1.1 Assigning posted values to variables.
$id = mysqli_real_escape_string($CON, $_POST['STUDENT_ID']);
$password = mysqli_real_escape_string($CON, $_POST['STUDENT_PASSWORD']);
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT * FROM STUDENT WHERE STUDENT_ID='$id' and STUDENT_PASSWORD='$password'";
$result = mysqli_query($CON, $query) or die(mysqli_error($CON));
$count = mysqli_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
if ($count == 1){
$user = $result->fetch_assoc();
$_SESSION['STUDENT_ID'] = $id;
$_SESSION['STUDENT_FIRSTNAME'] = $user['STUDENT_FIRSTNAME'];
$_SESSION['STUDENT_LASTNAME'] = $user['STUDENT_LASTNAME'];
}else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
header("location: loginerror.php");
//$fmsg = "Invalid Login Credentials.";
}
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['STUDENT_ID'])){
$id = $_SESSION['STUDENT_ID'];
$student_firstname = $_SESSION['STUDENT_FIRSTNAME'];
$student_lastname = $_SESSION['STUDENT_LASTNAME'];
$_SESSION['STUDENT_ID'] = true;
header("location: Profile.php");
}
//3.2 When the user visits the page first time, simple login form will be displayed.
?>

</body>
</html>
