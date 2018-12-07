<?php
session_start();

if ( $_SESSION['STAFF_ID'] != 1) {
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: ../ACCESS/error");
	}
	else {
	$id = $_SESSION['STAFF_ID'];
	$staff_firstname = $_SESSION['STAFF_FIRSTNAME'];
	$staff_lastname = $_SESSION['STAFF_LASTNAME'];
	}
?>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $PageTitle; ?></title>
<?php echo isset($script) ? $script : "" ; // Echo header script if one exists (JavaScript Validation etc)?>
</head>
<style>

ul {
	display:inline;
	margin:0;
	padding:0px;
	list-style:none;
}

ul li {
	display:inline-block;
	position:relative;
    margin: 0px;
	width:20%;
	/*padding:25px 40px;*/
	background:#007399;	
}

ul li a{
	text-decoration:none;
	color:white;
	text-align:center;
}

ul li:hover {
	background:#0086b3;
	color:white;
}

ul li ul {
	position:absolute;
	left:0;
	width: 500%;
	display:none;
	visibility:hidden;
}

ul li ul li {
	background:#007399;
	display:block;
}

ul li ul li:hover {
	background:#0086b3;
}
ul li:hover ul {
	display:block;
	opacity:1;
	visibility:visible;
}

ul ul ul li {
	display:none;
}

ul ul li:hover li{
	display:block;
}

ul ul ul {
	left:100%;
	top:0;
}

li p {
    padding: 5% 10% 5% 10%;
    margin: 0;
}
</style>
<body>
<div class ="navbar">
	<ul>
		<li><a href="../PAGES/STAFFHOME"><p>Home</p></a></li><!--
		--><li><a href ="#"><p>Survey</p></a>
			<ul>
				<li><a href ="#"><p>Projects</p></a>
					<ul>
						<li><a href ="../PROJECT/ADDPROJECT"><p>Create Project</p></a></li>
						<li><a href ="../PROJECT/PROJECTLIST"><p>Project List</p></a></li>
						<li><a href ="../PROJECT/PROJECTSEARCH"><p>Project Search</p></a></li>
					</ul>
				</li>
				<li><a href ="#"><p>Groups</p></a>
					<ul>
						<li><a href ="../PROJECT/NEWGROUP"><p>Create Group</p></a></li>
						<li><a href ="../PROJECT/GROUPUPDATE"><p>Update Group</p></a></li>
						<li><a href ="../PROJECT/GROUPLIST"><p>List Groups</p></a>
						</li>
					</ul>
				</li>
				<li><a href ="#"><p>Users</p></a>
					<ul>
						<li><a href ="../PROJECT/STUDENTLIST"><p>Student List</p></a></li>
						<li><a href ="../PROJECT/STAFFLIST"><p>Staff List</p></a></li>
						<li><a href ="../PROJECT/MEMBERSEARCH"><p>Search For</p></a></li>
						</li>
					</ul>
				</li>
			</ul>
		</li><!--
		--><li><a href ="../PAGES/STAFFCONTACT"><p>Contacts</p></a></li><!--
		--><li><a href ="../PAGES/STAFFABOUTUS"><p>About Us</p></a></li><!--
		--><li><a href ="../ACCESS/stafflogout"><p>Logout</p></a></li>
	</ul>
</div>
</body>
</html>