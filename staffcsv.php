<?php
session_start();
require_once "connectdb.php";
require_once "getcampus.php";

if ( !isset($_SESSION['sta_Email'])) {
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: stafflogin.php");
}	else {
  $id = $_SESSION['sta_Email'];
  $sta_FirstName = $_SESSION['sta_FirstName'];
  $sta_LastName = $_SESSION['sta_LastName'];
}

$query = "SELECT sta_FirstName, sta_LastName, sta_Campus, sta_Email FROM staff";
if (!$result = mysqli_query($CON, $query)) {
  exit(mysqli_error($CON));
} else {
	$survey = array();
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
	    $survey[] = $row;
    }
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=stafflist.csv');
		$output = fopen('php://output', 'w');
		fputcsv($output, array('FirstName', 'LastName', 'Campus', 'Email'));

		if (count($survey) > 0) {
	    foreach ($survey as $row) {
				$row['sta_Campus'] = getcampus($row['sta_Campus']);
		    fputcsv($output, $row);
		  }
		}
	}
}
?>
