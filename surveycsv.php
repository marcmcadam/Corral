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
    header("Content-Disposition: attachment; filename=$unitID-surveys.csv");
    //create output variable
    $output = fopen('php://output', 'w');
    //column headings
    $headers = ["ID", "First Name", "Last Name", "Submitted"];
    for ($s = 0; $s < sizeof($skillNames); $s += 1)
    {
        if (is_null($skillNames[$s]))
          $headers[] = "";
        else
          $headers[] = $skillNames[$s];
    }
    fputcsv($output, $headers);
    foreach ($students as $student)
    {
        $row = [$student->id, $student->firstName, $student->lastName, (is_null($student->skills) ? 0 : 1)];
        for ($s = 0; $s < sizeof($skillNames); $s += 1)
        {
            if (is_null($skillNames[$s]))
                $row[] = "";
            else
                $row[] = $student->skills[$s];
        }
        fputcsv($output, $row);
    }
?>
