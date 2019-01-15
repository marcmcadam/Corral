<?php
    $PageTitle = "Group List";
    require "header_staff.php";
    require_once "connectdb.php";
    require_once "unitdata.php";
    require_once "getfunctions.php";

    $unitData = unitData($unitID);
    $skillNames = $unitData->skillNames;
    $sort = $unitData->sort;
    $students = $unitData->students;
    $projects = $unitData->projects;
    $unassigned = $unitData->unassigned;

    echo "<h2>$PageTitle</h2>
        <table align='center' cellpadding='8px' style='width: 100%;'>";
    // display unassigned students
    {
        $totalCount = sizeof($students);
        $unassignedCount = sizeof($unassigned);
        echo "  <tr>
                    <td valign='top'><table align='right' class='listTable'>
                        <tr>
                            <th>Total Students</th>
                            <td>$totalCount</td>
                        </tr>
                    </table></td>
                    <td></td>
                </tr><tr>
                    <td valign='top'><table align='right' class='listTable'>
                        <tr>
                            <th style='text-align: left;'>Unassigned Students</th>
                            <td style='text-align: left;'>$unassignedCount</td>
                        </tr>
                    </table></td><td valign='top'>";
        groupStudentTable($students, $unassigned);
        echo "      </td>
                </tr>";
    }
    // display projects
    foreach ($projects as $p => $project)
    {
        $members = sizeof($project->studentIndices);
        echo "  <tr>
                    <td valign='top'><table align='right' class='listTable'>
                        <tr>
                            <th>Title</th>
                            <td style='text-align: left;'>$project->title</td>
                        </tr><tr>
                            <th>Brief</th>
                            <td style='text-align: left;'>$project->brief</td>
                        </tr><tr>
                            <th>Supervisor</th>
                            <td style='text-align: left;'>$project->leader</td>
                        </tr><tr>
                            <th>Supervisor Email</th>
                            <td style='text-align: left;'>$project->email</td>
                        </tr><tr>
                            <th>Members</th>
                            <td style='text-align: left;'>$members of $project->allocation</td>
                        </tr>
                    </table></td>
                    <td valign='top'>";
        groupStudentTable($students, $project->studentIndices);
        echo "      </td>
                </tr>";
    }
    echo "  </table>";

    require "footer.php";
?>
