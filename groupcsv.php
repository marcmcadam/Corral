<?php
session_start();
require "getcampus.php";

if ( !isset($_SESSION['STAFF_ID'])) {
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: stafflogin.php");
	}
	else {
	$id = $_SESSION['STAFF_ID'];
	$staff_firstname = $_SESSION['STAFF_FIRSTNAME'];
	$staff_lastname = $_SESSION['STAFF_LASTNAME'];
	}


	require_once "connectdb.php";

  $query = "SELECT groups.stu_ID, student.stu_FirstName, student.stu_LastName, student.stu_Campus, student.stu_Email, groups.pro_num, project.pro_title FROM ((groups INNER JOIN student ON groups.stu_ID=student.stu_ID) INNER JOIN project ON groups.pro_num=project.pro_num) ORDER BY pro_num ASC";
	if (!$result = mysqli_query($CON, $query)) {
	    exit(mysqli_error($CON));
	}
	else{
		//headers so file is downloaded, not displayed
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=grouplist.csv');
		//create output variable
		$output = fopen('php://output', 'w');
		//column headings
		fputcsv($output, array('Student ID','FirstName','LastName','Campus','Email','Project ID', 'Project Name'));

    //data rows, converting campus from int to campus name
		while ($row = mysqli_fetch_assoc($result)) {
			$row["stu_Campus"] = getcampus($row["stu_Campus"]);
      fputcsv($output, $row);
    }
  }
