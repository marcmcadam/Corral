<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $PageTitle; ?></title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<link rel="icon" type="image/ico" href="favicon.ico">
<?php echo isset($script) ? $script : "" ; // Echo header script if one exists (JavaScript Validation etc)?>
</head>

<body>
<div class="navbar">
	<a href="home.php">Corral</a>
	<div class="dropdown">
		<button class="dropbtn">Login</button>
		<div class="dropdown-content">
			<a href="login.php">Students</a>
			<a href="stafflogin.php">Staff</a>
		</div>
	</div>
</div>
<div class="main">
