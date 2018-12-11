<?php
session_start();

if ( !isset($_SESSION['STAFF_ID'])) {
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: ../ACCESS/error");
	}
	else {
	$id = $_SESSION['STAFF_ID'];
	$staff_firstname = $_SESSION['STAFF_FIRSTNAME'];
	$staff_lastname = $_SESSION['STAFF_LASTNAME'];
	}


	require_once "../DATABASE/CONNECTDB.PHP";

	$query = "SELECT stu_ID, stu_FirstName, stu_LastName, stu_Campus, stu_Email FROM student";
	if (!$result = mysqli_query($CON, $query)) {
	    exit(mysqli_error($CON));
	}
	else{
		//headers so file is downloaded, not displayed
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=studentlist.csv');
		//create output variable
		$output = fopen('php://output', 'w');
		//column headings
		fputcsv($output, array('Student ID','FirstName','LastName','Campus','Email'));

		//data rows, converting campus from int to campus name
		while ($row = mysqli_fetch_assoc($result)) {
			switch ($row["stu_Campus"]) {
				case 1:
					$row["stu_Campus"] = "Burwood";
					break;
				case 2:
					$row["stu_Campus"] = "Geelong";
					break;
				case 3:
					$row["stu_Campus"] = "Cloud";
					break;
			}
			fputcsv($output, $row);
		}
	}

?>
