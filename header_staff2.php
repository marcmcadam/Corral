<?php
session_start();

if (!isset($_SESSION['STAFF_ID']))
{
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: stafflogin.php");
    die;
}
else
{
    $id = $_SESSION['STAFF_ID'];
    $staff_firstname = $_SESSION['STAFF_FIRSTNAME'];
    $staff_lastname = $_SESSION['STAFF_LASTNAME'];
}
?>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $PageTitle; ?></title>
<link rel="stylesheet" type="text/css" href="stylesstaff2.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  <!-- Icon Library CSS -->
<link rel="icon" type="image/ico" href="favicon.ico">
<?php echo isset($script) ? $script : "" ; // Echo header script if one exists (JavaScript Validation etc)?>
<script>/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function responsivemenu() {
  var x = document.getElementById("navbar");
  if (x.className === "navbar") {
    x.className += " responsive";
  } else {
    x.className = "navbar";
  }
}</script>
</head>

<body>
<div class="navbar" id="navbar">
	<a href="staffhome.php">Corral</a>
		<div class="dropdown">
			<button class="dropbtn">Users <i class="fa fa-caret-down"></i></button>
			<div class="dropdown-content">
				<a href ="studentlist.php">Students</a>
				<a href ="stafflist.php">Staff</a>
				<a href ="membersearch.php">Search</a>
			</div>
		</div>
		<div class="dropdown">
			<button class="dropbtn">Projects <i class="fa fa-caret-down"></i></button>
			<div class="dropdown-content">
				<a href ="projectlist.php">View Projects</a>
				<a href ="grouplist.php">Project Groups</a>
			</div>
		</div>
		<div class="dropdown">
			<button class="dropbtn">Admin <i class="fa fa-caret-down"></i></button>
			<div class="dropdown-content">
		    <a href ="skillnames.php">Edit Skills</a>
				<a href ="datamgmt.php">Manage Corral Data</a>
				<a href ="begin.php">Begin Sort</a>
				<a href ="sortedgroups.php">Sort Results</a>
				<a href ="logout.php">Logout</a>
			</div>
		</div>
		<!-- <form action="search.php" method="get">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form> -->
		<a href="search.php">Search <i class="fa fa-search"></i></a>
		<a href="javascript:void(0);" class="icon" onclick="responsivemenu()">&#9776;</a>
</div>
<div class="main">
