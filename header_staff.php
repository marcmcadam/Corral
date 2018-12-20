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
<link rel="stylesheet" type="text/css" href="stylesstaff.css">
<link rel="icon" type="image/ico" href="favicon.ico">
<?php echo isset($script) ? $script : "" ; // Echo header script if one exists (JavaScript Validation etc)?>
</head>

<body>
<div class ="navbar">
	<ul>
		<li><a href="staffhome.php"><p>Corral</p></a></li><!--
        --><li><a href ="#"><p>Users</p></a>
           <ul>
             <li><a href ="studentlist.php"><p>Students</p></a></li>
             <li><a href ="stafflist.php"><p>Staff</p></a></li>
             <li><a href ="membersearch.php"><p>Search</p></a></li>
           </ul>
        </li><!--
		--><li><a href ="#"><p>Projects</p></a>
			<ul>
				<li><a href ="projectlist.php"><p>View Projects</p></a></li>
				<li><a href ="grouplist.php"><p>Project Groups</p></a></li>
			</ul>
		</li><!--
		--><li><a href ="#"><p>Admin</p></a>
             <ul>
                <li><a href ="skillnames.php"><p>Edit Skills</p></a></li>
				<li><a href ="classlist.php"><p>Import Students</p></a></li>
				<li><a href ="begin.php"><p>Begin Sort</p></a></li>
				<li><a href ="sortedgroups.php"><p>Sort Results</p></a></li>
			</ul>
		</li><!--
		--><li><a href ="logout.php"><p>Logout</p></a></li>
	</ul>
</div>
<div class="main">
