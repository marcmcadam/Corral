<?php
session_start();

if ( !isset($_SESSION['STUDENT_ID'])) {
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: ../ACCESS/LOGIN.PHP");
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
<title><?php echo $PageTitle; ?></title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">
<?php echo isset($script) ? $script : "" ; // Echo header script if one exists (JavaScript Validation etc)?>
</head>

<body>
<div class="Header">

</div>

<div class="navbar">
	<a href="../PAGES/STUDENTHOME">Home</a>
	<a href="../SURVEY/STUDENTSURVEY">Survey</a>
	<a href="../PAGES/STUDENTABOUTUS">About Us</a>
	<a href="../Access/LOGOUT">Logout</a>
</div>
