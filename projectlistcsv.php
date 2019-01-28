<?php
	session_start();
	session_regenerate_id();  // prevention of session hijacking
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
	header("Content-Disposition: attachment; filename=$unitID-projects.csv");
	//create output variable
	$output = fopen('php://output', 'w');
	//column headings
	fputcsv($output, ["ID", "Title", "Brief", "Supervisor", "Supervisor Email", "Relative Members"]);
	foreach ($projects as $project)
	{
		$row = [$project->id, $project->title, $project->brief, $project->leader, $project->email, $project->minimum];
		fputcsv($output, $row);
	}
?>
