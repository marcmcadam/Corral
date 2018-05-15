<?php
session_start();

if ( $_SESSION['STUDENT_ID'] != 1) {
	$_SESSION['message'] = "You mus log in before viewing this page";
	header("location: ../ACCESS/error.php");
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
<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">
</head>

<body>
<div class="Header">

</div>

<div class="navbar">
	<a href="../PAGES/STUDENTHOME.php">Home</a>
	<a href="../SURVEY/STUDENTSURVEY.PHP">Survey</a>
	<a href="../PAGES/STUDENTCONTACT.php">Contacts</a>
	<a href="../PAGES/STUDENTABOUTUS.php">About Us</a>
	<a href="../Access/LOGOUT.php">Logout</a>
</div>


<h2>Welcome, <?= $student_firstname. ' '?></h2>
<p>The purpose of the skills survey is to gauge the potential talent of each student and match
	accordingly under the criteria for specific projects. As it currently stands, placing members into well-rounded
	teams is a slow and tedious process. With Corral, the procedure is automated which enables supervisors to quickly organise
	 people into groups.
	<br><br>

	When you are ready to undertake the survey, simple select the survey tab above and fill in the details. Once complete,
	you can log out of the site and your supervisor will handle the rest.</p>

<div class="Footer">
	<h4>© Copyright Deakin University & Group 29 2018</h4>
</div>
</body>
</html>
