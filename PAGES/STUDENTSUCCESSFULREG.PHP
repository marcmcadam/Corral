<?php
session_start();
require ('../DATABASE/CONNECTDB.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registration Sucessful</title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">
</head>
<body>
<?php
$id = mysqli_real_escape_string($CON, $_POST['STUDENT_ID']);
$firstname = mysqli_real_escape_string($CON, $_POST['STUDENT_FIRSTNAME']);
$lastname = mysqli_real_escape_string($CON, $_POST['STUDENT_LASTNAME']);
$location = mysqli_real_escape_string($CON, $_POST['STUDENT_LOCATION']);
$email = mysqli_real_escape_string($CON, $_POST['STUDENT_EMAIL']);
$password = mysqli_real_escape_string($CON, $_POST['STUDENT_PASSWORD']);
?>
<div class="Header">
	<h1>Corral Project</h1>
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
<?php

$query = "INSERT INTO STUDENT (STUDENT_ID, STUDENT_FIRSTNAME, STUDENT_LASTNAME, STUDENT_LOCATION, STUDENT_EMAIL, STUDENT_PASSWORD) VALUES ('$id', '$firstname', '$lastname', '$location', '$email', '$password')";
$result = mysqli_query($CON, $query);

if($result){
            $smsg = "User Created Successfully.";
        }else{
            $fmsg ="User Registration Failed";
        }
?>
<h2 align="center">You have successfully registered an ID.</h2>

<a href="../Access/LOGIN"><h2 align="center">Back to Log In</h2></a>


<div class="Footer">

	<h4>This is copy righted by Deakin and the project group 29</h4>

</div>

</body>
