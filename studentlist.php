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

    echo "<script src='sorttable/sorttable.js'></script>";

    echo "<h2>Student Information</h2>
    <form name ='studentListForm' action='studentuser'  method='get'>
    <table class='listTable sortable' align='center'>
        <tr>
            <th class='widthStudentID'>ID</th>
            <th class='widthFirstName'>First Name</th>
            <th class='widthLastName'>Last Name</th>
            <th class='widthCampus'>Campus</th>
            <th class='widthEmail'>Email</th>
            <th class='widthTiny'>Survey</th>
            <th class='widthProjectTitle'>Project</th>
            <th class='widthUpdate'>Update</th>
        </tr>";

foreach ($students as $y => $student)
{
    $surveyDone = is_null($student->skills) ? "N" : "Y";
    $projectTitle = is_null($student->projectIndex) ? "-" : $projects[$student->projectIndex]->title;
    $campus = getCampus($student->campus);

    echo "<tr>
        <td>$student->id</td>
        <td>$student->firstName</td>
        <td>$student->lastName</td>
        <td>$campus</td>
        <td>$student->email</td>
        <td>$surveyDone</td>
        <td>$projectTitle</td>
        <td><button value='$student->id' name='studentid' class='updateButton'>Update</button></td>
    </tr>";
}

echo "</table>";

require "footer.php"; ?>
