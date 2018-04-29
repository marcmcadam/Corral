<?php
session_start();

if ( $_SESSION['STAFF_ID'] != 1) {
	$_SESSION['message'] = "You mus log in before viewing this page";
	header("location: error.php");
	}
	else {
	$id = $_SESSION['STAFF_ID'];
	$staff_firstname = $_SESSION['STAFF_FIRSTNAME'];
	$staff_lastname = $_SESSION['STAFF_LASTNAME'];
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome <?= $staff_firstname.' '.$staff_lastname ?> </title>
<link rel="stylesheet" type="text/css" href="STYLES/stylesheet.css">
</head>

<body>
<div class="Header">
	<h1>Corral Project</h1>
</div>

<div class="navbar">
	<a href="#Home">Home</a>
	<div class="dropdown">
		<button class="dropbtn">Projects
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
			<a href="#CreateProject">Create a Project</a>
			<a href="#Search">Make Groups</a>
			<a href="#Previous">Previous Projects</a>
		</div>
	</div>
	<a href="#Conatacts">Contacts</a>
	<a href="#About Us">About Us</a>
	<a href="stafflogout.php">Logout</a>
</div>


<h2>Welcome <?= $staff_firstname. ' '.$staff_lastname?></h2>
<p>You are logged in as <?= $staff_firstname?> at the moment.  From here you can look at the project form, past projects and resaults for project group parings. The following links below will give you to those pages.</p>
<ul style="list-style-type:none">
	<li><a href="#Projects">Projects form</a></li>
	<li><a href="#Results">Project results</a></li>
	<li><a href="#Past">Past Projects</a></li>
</ul><br><br>
<p>If you wish to log out, please click the link below or the logout tab in the navigation bar above.</p>
<p><a href="stafflogout.php">Logout</a></p><br>
<div class="Footer">
	<h4>This is copyrighted by Deakin and the project group 29</h4>
</div>
</body>
</html>
