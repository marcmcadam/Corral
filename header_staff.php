<?php
session_start();

if (!isset($_SESSION['sta_Email'])) {
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: stafflogin.php");
    die;
} else {
    $id = $_SESSION['sta_Email'];
    $sta_FirstName = $_SESSION['sta_FirstName'];
    $sta_LastName = $_SESSION['sta_LastName'];
}
?>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $PageTitle; ?></title>
<link rel="stylesheet" type="text/css" href="stylesstaff.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Icon Library CSS -->
<link rel="icon" type="image/ico" href="favicon.ico">
<?php echo isset($script) ? $script : "" ; // Echo header script if one exists (JavaScript Validation etc)?>
</head>

<body>
<div class="menu navbar">
	<ul class="menu">
		<li class="menu"><a href="staffhome.php"><p>Corral</p></a></li><!--
        --><li class="menu"><a href ="#"><p>Users</p></a>
           <ul class="menu">
             <li class="menu"><a href ="studentlist.php"><p>Students</p></a></li>
             <li class="menu"><a href ="stafflist.php"><p>Staff</p></a></li>
           </ul>
        </li><!--
		--><li class="menu"><a href ="#"><p>Projects</p></a>
			<ul class="menu">
				<li class="menu"><a href ="projectlist.php"><p>View Projects</p></a></li>
				<li class="menu"><a href ="grouplist.php"><p>Project Groups</p></a></li>
			</ul>
		</li><!--
		--><li class="menu"><a href ="#"><p>Admin</p></a>
     <ul class="menu">
        <li class="menu"><a href ="skillnames.php"><p>Edit Skills</p></a></li>
				<li class="menu"><a href ="datamgmt.php"><p>Manage Corral Data</p></a></li>
				<li class="menu"><a href ="begin.php"><p>Begin Sort</p></a></li>
				<li class="menu"><a href ="sortedgroups.php"><p>Sort Results</p></a></li>
				<li class="menu"><a href ="logout.php"><p>Logout</p></a></li>
			</ul>
		</li><!--
		--><li><form action="search.php" method="get">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form></li>
	</ul>
</div>
<div class="main">
