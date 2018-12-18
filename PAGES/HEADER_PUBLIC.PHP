<!doctype html>
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
	<a href="../PAGES/HOME">Corral</a>
	<div class="dropdown">
		<button class="dropbtn">Login</button>
		<div class="dropdown-content">
			<a href="../Access/login">Students</a>
			<a href="../ACCESS/stafflogin">Staff</a>
		</div>
	</div>
</div>
<div style="padding: 8px 32px;">
<div class="main">
