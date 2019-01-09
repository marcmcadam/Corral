<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $PageTitle." - Corral"; ?></title>
<link rel="stylesheet" type="text/css" href="styles.css">
<link rel="icon" type="image/ico" href="favicon.ico">
<?php echo isset($script) ? $script : "" ; // Echo header script if one exists (JavaScript Validation etc)?>
</head>

<body>
<div class="navbar">
	<div class="menu" style="width: 20%;"><a href="home"><p>Corral</p></a>
	</div><div class="menu" style="width: 20%;"><a href="#"><p>Login</p></a>
		<ul>
			<li><a href="login"><p>Students</p></a></li>
			<li><a href="stafflogin"><p>Staff</p></a></li>
		</ul>
	</div>
</div>
<div class="main">
