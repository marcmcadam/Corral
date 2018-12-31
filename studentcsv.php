<?php
session_start();
require "getcampus.php";
require "staffauth.php";


	require_once "connectdb.php";

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
			$row["stu_Campus"] = getcampus($row["stu_Campus"]);
			fputcsv($output, $row);
		}
	}

?>
