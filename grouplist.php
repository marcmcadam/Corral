<?php
    $PageTitle = "Project Groups";
    require "header_staff.php";
    require_once "connectdb.php";
    require_once "getdata.php";
    require_once "getfunctions.php";

    sortingData($unitID, $skillNames, $sort, $students, $projects);

    echo "<h2>$PageTitle</h2>
        <table align='center' cellpadding='8px' style='width: 100%;'>";
    // display unassigned students
    {
        $unassigned = [];
        foreach ($students as $y => $student)
        {
            if (is_null($student->projectIndex))
                array_push($unassigned, $student);
        }
        
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
                    </table></td><td valign='top'><table align='left' class='listTable'>
                        <tr>";
        if ($unassignedCount > 0)
        {
            echo "      <th>ID</th>
                        <th>Name</th>
                        <th>Survey</th>
                        <th>Email</th>
                        <th>Campus</th>";
        }
        echo "      </tr>";
        foreach ($unassigned as $student)
        {
            $campus = getCampus($student->campus);
            $survey = is_null($student->skills) ? "-" : "Y";
            echo "      <tr>
                            <td style='text-align: right;'>$student->id</td>
                            <td style='text-align: left;'>$student->text</td>
                            <td style='text-align: center;'>$survey</td>
                            <td style='text-align: left;'>$student->email</td>
                            <td style='text-align: left;'>$campus</td>
                        </tr>";
        }
        echo "      </table></td>
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
                            <th>Leader</th>
                            <td style='text-align: left;'>$project->leader</td>
                        </tr><tr>
                            <th>Email</th>
                            <td style='text-align: left;'>$project->email</td>
                        </tr><tr>
                            <th>Members</th>
                            <td style='text-align: left;'>$members of $project->allocation</td>
                        </tr>
                    </table></td><td valign='top'><table align='left' class='listTable'>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Survey</th>
                            <th>Email</th>
                            <th>Campus</th>
                        </tr>";
        foreach ($project->studentIndices as $y)
        {
            $student = $students[$y];
            $campus = getCampus($student->campus);
            $survey = is_null($student->skills) ? "-" : "Y";
            echo "      <tr>
                            <td style='text-align: right;'>$student->id</td>
                            <td style='text-align: left;'>$student->text</td>
                            <td style='text-align: center;'>$survey</td>
                            <td style='text-align: left;'>$student->email</td>
                            <td style='text-align: left;'>$campus</td>
                        </tr>";
        }
        echo "      </table></td>
                </tr>";
    }
    echo "  </table>";

    require "footer.php";
?>
