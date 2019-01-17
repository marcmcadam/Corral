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
        <table align='center' style='width: 100%;'>";
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
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr><tr>
                    <td valign='top'><table align='right' class='listTable'>
                        <tr>
                            <th>Unassigned Students</th>
                            <td>$unassignedCount</td>
                        </tr>
                    </table></td><td valign='top'>";
        groupStudentTable($students, $unassigned);
        echo "      </td>
                </tr><tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
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
                            <td class='widthWide'>$project->title</td>
                        </tr><tr>
                            <th>Brief</th>
                            <td class='widthWide'>$project->brief</td>
                        </tr><tr>
                            <th>Supervisor</th>
                            <td class='widthWide'>$project->leader</td>
                        </tr><tr>
                            <th>Supervisor Email</th>
                            <td class='widthWide'>$project->email</td>
                        </tr><tr>
                            <th>Members</th>
                            <td class='widthWide'>$members of $project->allocation</td>
                        </tr>
                    </table></td>
                    <td valign='top'>";
        groupStudentTable($students, $project->studentIndices);
        echo "      </td>
                </tr><tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>";
    }
    echo "  </table>";

    require "footer.php";
?>
