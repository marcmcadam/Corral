<?php
 	$PageTitle = "Project List";
    require "header_staff.php";
    require_once "connectdb.php";
    require_once "getfunctions.php";
    require_once "unitdata.php";

    $unitData = unitData($unitID);
    $skillNames = $unitData->skillNames;
    $sort = $unitData->sort;
    $students = $unitData->students;
    $projects = $unitData->projects;
    $unassigned = $unitData->unassigned;

    echo "<h2>Project List</h2>
    <form action='project' method='get'>
    <table class='listTable' align='center'>
        <tr>
            <th>Unit</th>
            <th>Title</th>
            <th>Leader</th>
            <th>Leader Email</th>
            <th>Brief</th>
            <th>Members</th>
            <th>Update</th>
        </tr>";

    foreach ($projects as $project)
    {
        $members = sizeof($project->studentIndices);
        echo "<tr>
                <td align='center'>$project->unitID</td>
                <td align='center'>$project->title</td>
                <td align='center'>$project->leader</td>
                <td align='center'>$project->email</td>
                <td align='center'>$project->brief</td>
                <td align='center'>$members of $project->allocation</td>
                <td align='center'><button value='".$project->id."' name='number' class='updateButton'>Update</button></td>
            </tr>";
    }

    echo "</table></form>";

    require "footer.php";
?>
