<?php
session_start();
require_once "getfunctions.php";
require "staffauth.php";
require_once "connectdb.php";

$query = "SELECT groups.stu_ID, student.stu_FirstName, student.stu_LastName, student.stu_Campus, student.stu_Email, groups.pro_ID, project.pro_title FROM ((groups INNER JOIN student ON groups.stu_ID=student.stu_ID) INNER JOIN project ON groups.pro_ID=project.pro_ID) ORDER BY pro_ID ASC";
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
?>
