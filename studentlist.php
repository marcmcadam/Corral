<?php
 	$PageTitle = "Student List";
	require "header_staff.php";
    require_once "getfunctions.php";
    require_once "connectdb.php";
    require_once "unitdata.php";

    $unitData = unitData($unitID);
    $skillNames = $unitData->skillNames;
    $sort = $unitData->sort;
    $students = $unitData->students;
    $projects = $unitData->projects;
    $unassigned = $unitData->unassigned;

    echo "<h2>Student Information</h2>
    <form name ='studentListForm' action='studentuser'  method='get'>
    <table class='listTable' align='center'>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Campus</th>
            <th>Email</th>
            <th>Survey</th>
            <th>Project</th>
            <th>Update</th>
        </tr>";

foreach ($students as $y => $student)
{
    $surveyDone = ($student->skills == null) ? "-" : "Y";
    $projectTitle = ($student->projectIndex != null) ? $projects[$student->projectIndex]->title : "-";
    $campus = getCampus($student->campus);

    echo "<tr>
        <td align='center'>$student->id</td>
        <td align='center'>$student->firstName</td>
        <td align='center'>$student->lastName</td>
        <td align='center'>$campus</td>
        <td align='center'>$student->email</td>
        <td align='center'>$surveyDone</td>
        <td align='center'>$projectTitle</td>
        <td align='center'><button value ='$student->id' name='studentid' class='updateButton'>Update</button></td>
    </tr>";
}

echo "</table>";

require "footer.php"; ?>
