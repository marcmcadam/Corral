<?php
    session_start();
    session_regenerate_id();  // prevention of session hijacking
    $PageTitle = "Group List";
    require "staffauth.php";
    require_once "connectdb.php";
    require_once "unitdata.php";
    require_once "getfunctions.php";

    //headers so file is downloaded, not displayed
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=$unitID-groups.csv");
		//create output variable
		$output = fopen('php://output', 'w');
		//column headings
		$header = ['Student ID', 'FirstName', 'LastName', 'Campus', 'Email', 'Project ID', 'Project Name'];
		fputcsv($output, $header);

    $unitData = unitData($unitID);
    $skillNames = $unitData->skillNames;
    $sort = $unitData->sort;
    $students = $unitData->students;
    $projects = $unitData->projects;
    $unassigned = $unitData->unassigned;

    // display projects
    foreach ($projects as $p => $project)
    {
				foreach ($project->studentIndices as $y)
				{
						$student = $students[$y];
						$campus = getCampus($student->campus);
						$row = [$student->id, $student->firstName, $student->lastName, $campus, $student->email, $project->id, $project->title];
						fputcsv($output, $row);
				}
    }
?>
