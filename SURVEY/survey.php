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
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">
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

<form action="../SURVEY/surveyprocess" method="post">

STUDENT_FIRSTNAME:<input type="text" name="STUDENT_FIRSTNAME">

<p>Project skills</p>
html/css<select name="hc">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

Java Script<select name="js">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

PHP<select name="php">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

JAVA<select name="java">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

C<select name="c">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

C Plus Plus<select name="cpp">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

Objective-C<select name="oc">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

Databse<select name="db">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

Unity<select name="u3">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

UI<select name="ui">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

Security<select name="se">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

<p><input type="submit">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="reset" value="reset"></p>
</form>

<div class="Footer">
	<h4>© Copyright Deakin University & Group 29 2018</h4>
</div>
</body>
</html>
