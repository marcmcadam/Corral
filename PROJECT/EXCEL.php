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




if(isset($_POST["export_excel"]))
{
require('../DATABASE/CONNECTDB.PHP');
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=data.csv');
	$output = fopen("php://output", "w");
	fputcsv($output, array('Project Number', 'Project Brief', 'Project Leader', 'Project Status'));
	$query = "SELECT PROJECT_NUM, PROJECT_BRIEF, PROJECT_LEADER, PROJECT_STATUS FROM PROJECT";
	$result = mysqli_query($CON, $query);
	while($row = mysqli_fetch_assoc($result))
	{
		fputcsv($output, $row);
	}
	fclose($output);
}

?>
