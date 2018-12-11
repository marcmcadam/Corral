<?php
session_start();

if (!isset($_SESSION['STUDENT_ID']))
{
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: ../ACCESS/LOGIN.PHP");
    die;
}
else
{
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
<link rel="icon" type="image/ico" href="../favicon.ico">
<?php echo isset($script) ? $script : "" ; // Echo header script if one exists (JavaScript Validation etc)?>
</head>

<body>
<div class="navbar">
	<a href="../SURVEY/STUDENTSURVEY">Survey</a>
	<a href="../Access/LOGOUT">Logout</a>
</div>
<div style="padding: 8px 32px">
