<?php
session_start();

if ( !isset($_SESSION['STAFF_ID'])) {
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: ../ACCESS/STAFFLOGIN.PHP");
} else {
	$id = $_SESSION['STAFF_ID'];
	$staff_firstname = $_SESSION['STAFF_FIRSTNAME'];
	$staff_lastname = $_SESSION['STAFF_LASTNAME'];
}


$view = ["All", "Active","Inactive","Planning","Cancelled"];

if(isset($_POST['View']) && in_array($_POST['View'], $view)) {
	$status = $_POST['View'];
	require_once "../DATABASE/CONNECTDB.PHP";
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=projectlist.csv');
	$output = fopen("php://output", "w");
	fputcsv($output, array('Project Title', 'Project Brief', 'Project Leader', 'Project Email', 'Project Status'));
	if ($status == "All"){
		$query = "SELECT pro_title, pro_brief, pro_leader, pro_email, pro_status FROM project";
	} else {
		$query = "SELECT pro_title, pro_brief, pro_leader, pro_email, pro_status FROM project WHERE pro_status = '".$status."'";
	}
	$result = mysqli_query($CON, $query);
	while($row = mysqli_fetch_assoc($result))
	{
		fputcsv($output, $row);
	}
	fclose($output);
}

?>
