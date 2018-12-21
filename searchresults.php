<?php
	$PageTitle = "Search Results";
	require "header_staff.php";

$View = $_POST['View'];
$FirstName = $_POST['FirstName'];
$Email = $_POST['Email'];
$Location = $_POST['Location'];
?>
<h2>Search Results</h2>
<?php
require_once "connectdb.php";

$query = "SELECT * FROM ".$View."";
$where = "";

if ($FirstName != ""){
	if ($where == ""){
		if ($View == 'student') {
			$where = " WHERE stu_FirstName like '".$FirstName."'";
		} else {
			$where = " WHERE STAFF_FIRSTNAME like '".$FirstName."'";
		}
	} else {
		if ($View == "student") {
			$where = " AND WHERE stu_FirstName like '".$FirstName."'";
		} else {
			$where = " AND WHERE STAFF_FIRSTNAME like '".$FirstName."'";
		}
	}
}

if ($Email != ""){
	if ($where == ""){
		if ($View == 'student') {
			$where = " WHERE stu_Email like '".$Email."'";
		} else {
			$where = " WHERE STAFF_EMAIL like '".$Email."'";
		}
	} else {
		if ($View == "student") {
			$where = " WHERE stu_FirstName like '".$FirstName."' AND stu_Email like '".$Email."'";
		} else {
			$where = " WHERE STAFF_FIRSTNAME like '".$FirstName."'  AND STAFF_EMAIL like '".$Email."'";
		}
	}
}

if ($Location != ""){
	if ($where == ""){
		if ($View == 'student') {
			$where = " WHERE stu_Campus = '".$Location."'";
		} else {
			$where = " WHERE STAFF_LOCATION = '".$Location."'";
		}
	} else {
		if ($FirstName != ""){
			if ($Email != ""){
				if ($View == 'student'){
					$where = " WHERE stu_FirstName like '".$FirstName."' AND stu_Email like '".$Email."' AND stu_Campus = '".$Location."'";
				} else {
					$where = " WHERE STAFF_FIRSTNAME like '".$FirstName."' AND STAFF_EMAIL like '".$Email."' AND STAFF_LOCATION = '".$Location."'";
				}
			} else {
				if ($View == 'student'){
					$where = " WHERE stu_FirstName like '".$FirstName."' AND stu_Campus = '".$Location."'";
				} else {
					$where = " WHERE STAFF_FIRSTNAME like '".$FirstName."' AND STAFF_LOCATION = '".$Location."'";
				}
			}
		} else {
			if ($Email != ""){
				if ($View == 'student'){
					$where = " WHERE stu_Email like '".$Email."' AND stu_Campus = '".$Location."'";
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
				echo "<tr><td align='center'>{$row['stu_ID']}</td><td align='center'>{$row['stu_FirstName']}</td><td align='center'>{$row['stu_Email']}</td><td align='center'>{$row['stu_Campus']}</td></tr>";
			}
			if ($View == "staff") {
				echo "<tr><td align='center'>{$row['STAFF_ID']}</td><td align='center'>{$row['STAFF_FIRSTNAME']}</td><td align='center'>{$row['STAFF_EMAIL']}</td><td align='center'>{$row['STAFF_LOCATION']}</td></tr>";
			}
		}
	} else {
		echo "<p>Search was unable to find anything. Please try again.</p>";
		echo '<p><a href="membersearch.php">Previous Page</a></p>';
	}
    echo "</table><br>";
    mysqli_free_result($res);
    mysqli_close($CON);
?>
<hr>
<p><a href="membersearch.php">Back to Search</p></a><br>

<?php require "footer.php"; ?>
