<?php
session_start();

if ( $_SESSION['STUDENT_ID'] != 1) {
	$_SESSION['message'] = "You mus log in before viewing this page";
	header("location: error.php");
	}
	else {
	$id = $_SESSION['STUDENT_ID'];
	$student_firstname = $_SESSION['STUDENT_FIRSTNAME'];
	$student_lastname = $_SESSION['STUDENT_LASTNAME'];
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome <?= $student_firstname.' '.$student_lastname ?> </title>
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
	margin-left: 40px;
	margin-right: 50px;
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

</style>
</head>

<body>
<div class="Header">
	<h1>Corral Project</h1>
</div>

<div class="navbar">
	<a href="#Home">Home</a>
	<a href="survey.php">Surveys</a>
	<a href="#Conatacts">Contacts</a>
	<a href="#About Us">About Us</a>
	<a href="logout.php">Logout</a>
</div>


<h2>Welcome <?= $student_firstname. ' '.$student_lastname?></h2>
<p>You are logged in as <?= $student_firstname?> at the moment. From here you can complete the skills survey. The link is below.</p>
<ul style="list-style-type:none">
	<li><a href="../SURVEY/survey.php">Skills Survey</a></li>
</ul><br><br>
<p>If you wish to log out, please click the link below or the logout tab in the navigation bar above.</p>
<p><a href="logout.php">Logout</a></p><br>
<div class="Footer">
	<h4>This is copyrighted by Deakin and the project group 29</h4>
</div>
</body>
</html>
