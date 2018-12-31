<?php
session_start();

if (!isset($_SESSION['STUDENT_ID']))
{
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: login.php");
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
<link rel="stylesheet" type="text/css" href="styles.css">
<link rel="icon" type="image/ico" href="favicon.ico">
<?php echo isset($script) ? $script : "" ; // Echo header script if one exists (JavaScript Validation etc)?>
</head>

<body>
<div class="navbar">
	<ul>
		<li><a href="studentsurvey"><p>Survey</p></a>
        </li><li><a href="logout"><p>Logout</p></a>
		</li>
	</ul>
</div>
<div class="main">
