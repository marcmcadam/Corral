<?php
session_start();

if ( !isset($_SESSION['sta_Email'])) {
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: stafflogin.php");
}	else {
    $id = $_SESSION['sta_Email'];
    $sta_FirstName = $_SESSION['sta_FirstName'];
    $sta_LastName = $_SESSION['sta_LastName'];
}


$view = ["All", "Active","Inactive","Planning","Cancelled"];

if(isset($_POST['View']) && in_array($_POST['View'], $view)) {
	$status = $_POST['View'];
	require_once "connectdb.php";
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=projectlist.csv');
	$output = fopen("php://output", "w");
	fputcsv($output, array('Project Title', 'Project Brief', 'Project Leader', 'Project Email', 'Project Status'));
	if ($status == "All"){
		$query = "SELECT pro_title, pro_brief, pro_leader, pro_email, pro_status FROM project ORDER BY FIELD(pro_status, 'Active', 'Planning', 'Inactive', 'Cancelled'), pro_title ASC";
	} else {
		$query = "SELECT pro_title, pro_brief, pro_leader, pro_email, pro_status FROM project WHERE pro_status = '".$status."' ORDER BY FIELD(pro_status, 'Active', 'Planning', 'Inactive', 'Cancelled'), pro_title ASC";
	}
	$result = mysqli_query($CON, $query);
	while($row = mysqli_fetch_assoc($result))
	{
		fputcsv($output, $row);
	}
	fclose($output);
}

?>
