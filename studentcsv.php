<?php
	session_start();
	session_regenerate_id();  // prevention of session hijacking
	require_once "getfunctions.php";
	require "staffauth.php";
	require_once "unitdata.php";

    $unitData = unitData($unitID);
    $skillNames = $unitData->skillNames;
    $sort = $unitData->sort;
    $students = $unitData->students;
    $projects = $unitData->projects;
    $unassigned = $unitData->unassigned;

	//headers so file is downloaded, not displayed
	header("Content-Type: text/csv; charset=utf-8");
	header("Content-Disposition: attachment; filename=$unitID-students.csv");
	//create output variable
	$output = fopen('php://output', 'w');
	//column headings
	fputcsv($output, ['Student ID','FirstName','LastName','Campus','Email']);
	foreach ($students as $student)
	{
		$row = [$student->id, $student->firstName, $student->lastName, $student->campus, $student->email];
		fputcsv($output, $row);
	}
?>
