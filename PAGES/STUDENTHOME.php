<?php
session_start();

if ( $_SESSION['STUDENT_ID'] != 1) {
	$_SESSION['message'] = "You mus log in before viewing this page";
	header("location: ../ACCESS/error");
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
<title>Home</title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">
<style>
/*Picture wont float right?*/
#stockpic
{
    float:right;
}
</style>
</head>

<body>
<div class="Header">
	<h1>Corral</h1>
</div>
<div class="navbar">
	<a href="../PAGES/STUDENTHOME">Home</a>
	<a href="../SURVEY/STUDENTSURVEY">Survey</a>
	<a href="../PAGES/STUDENTCONTACT">Contacts</a>
	<a href="../PAGES/STUDENTABOUTUS">About Us</a>
	<a href="../Access/LOGOUT">Logout</a>
</div>
<div id="stockpic">

<div id="contents">
	<h2>Welcome to Corral</h2>
<p>This site aims to provide staff and students with a platform to view and request access to upcoming projects. Through this platform, staff and teachers may upload projects for students, including details of the skills sets and numbers required for the job. Students who register can then complete a quick survey to determine their levels or proficency in certain areas such as IT and communication. Corral takes this information, and provides Teachers with a list of suitable candidates for the positions available.


  <br><br>For more information, please click <a href="../PAGES/STUDENTABOUTUS">here</a></p>
  </div>
</div>

<hr>
<p>&nbsp;</p>

<div class="Footer">
	<h4>© Copyright Deakin University & Group 29 2018</h4>
</div>
</body>
</html>
