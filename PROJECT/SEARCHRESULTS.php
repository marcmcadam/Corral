<?php
session_start();

if ( $_SESSION['STAFF_ID'] != 1) {
	$_SESSION['message'] = "You mus log in before viewing this page";
	header("location: ../ACCESS/error");
	}
	else {
	$id = $_SESSION['STAFF_ID'];
	$staff_firstname = $_SESSION['STAFF_FIRSTNAME'];
	$staff_lastname = $_SESSION['STAFF_LASTNAME'];
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Search Results</title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesstaff.css">
</head>

<body>
<?php
$View = $_POST['View'];
$FirstName = $_POST['FirstName'];
$Email = $_POST['Email'];
$Location = $_POST['Location'];
?>

<div class="Header">
</div>

<div class ="navbar">
	<ul>
		<li><a href="../PAGES/STAFFHOME">Home</a></li>
		<li><a href ="#">Survey</a>
			<ul>
				<li><a href ="#">Projects</a>
					<ul>
						<li><a href ="../PROJECT/ADDPROJECT">Create Project</a></li>
						<li><a href ="../PROJECT/PROJECTLIST">Project List</a></li>
						<li><a href ="../PROJECT/PROJECTSEARCH">Project Search</a></li>
					</ul>
				</li>
				<li><a href ="#">Groups</a>
					<ul>
						<li><a href ="../PROJECT/NEWGROUP">Create Group</a></li>
						<li><a href ="../PROJECT/GROUPUPDATE">Update Group</a></li>
						<li><a href ="../PROJECT/GROUPLIST">List Groups</a>
						</li>
					</ul>
				</li>
				<li><a href ="#">Users</a>
					<ul>
						<li><a href ="../PROJECT/STUDENTLIST">Student List</a></li>
						<li><a href ="../PROJECT/STAFFLIST">Staff List</a></li>
						<li><a href ="../PROJECT/MEMBERSEARCH">Search For</a></li>
						</li>
					</ul>
				</li>
			</ul>
		</li>
		<li><a href ="../PAGES/STAFFCONTACT">Contacts</a></li>
		<li><a href ="../PAGES/STAFFABOUTUS">About Us</a></li>
		<li><a href ="../ACCESS/stafflogout">Logout</a></li>
	</ul>
</div>

<h2>Search Results</h2>
<?php
require('../DATABASE/CONNECTDB.PHP');

$query = "SELECT * FROM ".$View."";
$where = "";

if ($FirstName != ""){
	if ($where == ""){
		if ($View == 'student') {
			$where = " WHERE STUDENT_FIRSTNAME like '".$FirstName."'";
		} else {
			$where = " WHERE STAFF_FIRSTNAME like '".$FirstName."'";
		}
	} else {
		if ($View == "student") {
			$where = " AND WHERE STUDENT_FIRSTNAME like '".$FirstName."'";
		} else {
			$where = " AND WHERE STAFF_FIRSTNAME like '".$FirstName."'";
		}
	}
}

if ($Email != ""){
	if ($where == ""){
		if ($View == 'student') {
			$where = " WHERE STUDENT_EMAIL like '".$Email."'";
		} else {
			$where = " WHERE STAFF_EMAIL like '".$Email."'";
		}
	} else {
		if ($View == "student") {
			$where = " WHERE STUDENT_FIRSTNAME like '".$FirstName."' AND STUDENT_EMAIL like '".$Email."'";
		} else {
			$where = " WHERE STAFF_FIRSTNAME like '".$FirstName."'  AND STAFF_EMAIL like '".$Email."'";
		}
	}
}

if ($Location != ""){
	if ($where == ""){
		if ($View == 'student') {
			$where = " WHERE STUDENT_LOCATION = '".$Location."'";
		} else {
			$where = " WHERE STAFF_LOCATION = '".$Location."'";
		}
	} else {
		if ($FirstName != ""){
			if ($Email != ""){
				if ($View == 'student'){
					$where = " WHERE STUDENT_FIRSTNAME like '".$FirstName."' AND STUDENT_EMAIL like '".$Email."' AND STUDENT_LOCATION = '".$Location."'";
				} else {
					$where = " WHERE STAFF_FIRSTNAME like '".$FirstName."' AND STAFF_EMAIL like '".$Email."' AND STAFF_LOCATION = '".$Location."'";
				}
			} else {
				if ($View == 'student'){
					$where = " WHERE STUDENT_FIRSTNAME like '".$FirstName."' AND STUDENT_LOCATION = '".$Location."'";
				} else {
					$where = " WHERE STAFF_FIRSTNAME like '".$FirstName."' AND STAFF_LOCATION = '".$Location."'";
				}
			}
		} else {
			if ($Email != ""){
				if ($View == 'student'){
					$where = " WHERE STUDENT_EMAIL like '".$Email."' AND STUDENT_LOCATION = '".$Location."'";
				} else {
					$where = " WHERE STAFF_EMAIL like '".$Email."' AND STAFF_LOCATION = '".$Location."'";
				}
			}
		}
	}
}

$query = $query.$where;
$res=mysqli_query($CON, $query);
echo "<p><table width='900px'  border='1px' cellpadding='10px'></p>";
    if (mysqli_num_rows ($res) > 0) {
		echo "<tr><th>ID</th><th>First Name</th><th>Email</th><th>Location</th></tr>";
		while ($row=mysqli_fetch_assoc($res)){
			if ($View == "student") {
				echo "<tr><td align='center'>{$row['STUDENT_ID']}</td><td align='center'>{$row['STUDENT_FIRSTNAME']}</td><td align='center'>{$row['STUDENT_EMAIL']}</td><td align='center'>{$row['STUDENT_LOCATION']}</td></tr>";
			}
			if ($View == "staff") {
				echo "<tr><td align='center'>{$row['STAFF_ID']}</td><td align='center'>{$row['STAFF_FIRSTNAME']}</td><td align='center'>{$row['STAFF_EMAIL']}</td><td align='center'>{$row['STAFF_LOCATION']}</td></tr>";
			}
		}
	} else {
		echo "<p>Search was unable to find anything. Please try again.</p>";
		echo '<p><a href="../PROJECT/MEMBERSEARCH">Previous Page</a></p>';
	}
    echo "</table><br>";
    mysqli_free_result($res);
    mysqli_close($CON);
?>
<hr>
<p><a href="../PROJECT/MEMBERSEARCH">Back to Search</p></a><br>

<div class="Footer">
	© Copyright Deakin University & Group 29 2018
</div>
</body>
</html>
