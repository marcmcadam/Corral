<?php
session_start();
require('../DATABASE/CONNECTDB.PHP');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login Page</title>
<style>
body {
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.Header {
	background-color: #333;
	font-family: Arial, Helvetica, sans-serif;
	color: white;
	text-align: center;
	padding: 5px;
}

.Footer {
	padding: 20px;
	background-color: #333;
	color: white;
	text-align: center;
	font-family: Arial, Helvetica, sans-serif;
}

p {
	margin-left: 35%;
	font-family: Arial, Helvetica, sans-serif;
}

h2 {
	margin-left: 40px;
	font-family: Arial, Helvetica, sans-serif;
}

/* The navagation bar for the site, linked to the drop downs */
	.navbar {
    overflow: hidden;
    background-color: #333;
    font-family: Arial, Helvetica, sans-serif;
}

a {
	color: black;
	text-decoration: none;
}

.navbar a {
    float: left;
    font-size: 16px;
    color: white;
    text-align: center;
    padding: 14px 90px;
    text-decoration: none;
}

/* This is for the drop down in the navigation bar */
.dropdown {
    float: left;
    overflow: hidden;
}

.dropdown .dropbtn {
    font-size: 16px;
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
    background-color: red;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}

form {
	margin-left: 35%;
	font-family: Arial, Helvetica, sans-serif;
}
</style>
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
    <input type="text" name="STAFF_ID" placeholder="Staff ID" required><br><br>
        <input type="password" name="STAFF_PASSWORD" id="inputPassword" placeholder="Password" required><br><br>
        <button type="submit">LOGIN</button>
        <a href="REGISTER.PHP">REGISTER</a><br><br>
      </form>
<p>Login error, Credentials do not match. Please try again.</p>
<div class="Footer">
	<h4>This is copy righted by Deakin and the project group 29</h4>
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
header("location: stafferror.php");
//$fmsg = "Invalid Login Credentials.";
}
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['STAFF_ID'])){
$id = $_SESSION['STAFF_ID'];
$staff_firstname = $_SESSION['STAFF_FIRSTNAME'];
$staff_lastname = $_SESSION['STAFF_LASTNAME'];
$_SESSION['STAFF_ID'] = true;
header("location: staffprofile.php");
}
//3.2 When the user visits the page first time, simple login form will be displayed.
?>

</body>
</html>
