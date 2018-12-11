<?php
session_start();

if (!isset($_SESSION['STAFF_ID']))
{
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: ../ACCESS/stafflogin.php");
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
<link rel="stylesheet" type="text/css" href="../STYLES/stylesstaff.css">
<link rel="icon" type="image/ico" href="../favicon.ico">
<?php echo isset($script) ? $script : "" ; // Echo header script if one exists (JavaScript Validation etc)?>
</head>

<body>
<div class ="navbar">
	<ul>
		<li><a href="../PAGES/STAFFHOME"><p>Corral</p></a></li><!--
        --><li><a href ="#"><p>Users</p></a>
            <ul>
                <li><a href ="../PROJECT/STUDENTLIST"><p>Students</p></a></li>
                <li><a href ="../PROJECT/STAFFLIST"><p>Staff</p></a></li>
                <li><a href ="../PROJECT/MEMBERSEARCH"><p>Search</p></a></li>
            </ul>
        </li><!--
		--><li><a href ="#"><p>Groups</p></a>
			<ul>
				<li><a href ="../PROJECT/PROJECTLIST"><p>Projects</p></a></li>
				<li><a href ="#"><p>Groups</p></a></li>
			</ul>
		</li><!--
        --><li><a href ="#"><p>Sorting</p></a>
            <ul>
                <li><a href ="../SOLVER/BEGIN"><p>Begin</p></a></li>
				<li><a href ="../SOLVER/GROUPS"><p>Results</p></a></li>
            </ul>
        </li><!--
		--><li><a href ="../ACCESS/stafflogout"><p>Logout</p></a></li>
	</ul>
</div>
<div style="padding: 8px 32px">
