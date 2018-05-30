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


	require('../DATABASE/CONNECTDB.PHP');

	$query = "SELECT STUDENT_ID, STUDENT_FIRSTNAME, STUDENT_LASTNAME, STUDENT_LOCATION, STUDENT_EMAIL FROM STUDENT";
	if (!$result = mysqli_query($CON, $query)) {
	    exit(mysqli_error($CON));
	}
	else{

	//Load Student Survey Heading
	$survey = array();
	if (mysqli_num_rows($result) > 0) {
	    while ($row = mysqli_fetch_assoc($result)) {
	        $survey[] = $row;
	    }
		header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=STUDENTLIST.csv');
	$output = fopen('php://output', 'w');
	fputcsv($output, array('STUDENT ID', 'STUDENT FIRSTNAME', 'STUDENT LASTNAME', 'STUDENT LOCATION', 'STUDENT EMAIL'));

	//Load Student Survey Flieds
	if (count($survey) > 0) {
	    foreach ($survey as $row) {
	        fputcsv($output, $row);
	    }
	}
	}
	}

?>
