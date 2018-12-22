<?php
 	$PageTitle = "Student List";
	require "header_staff.php";
  require "getcampus.php";
?>

<h2>Student Information</h2>
<style>
    tr:nth-child(odd) {
        background-color: #f4f4f4;
    }
    tr:nth-child(even) {
        background-color: #ececec;
    }
</style>
<?php
require_once 'connectdb.php';

$sql = "SELECT * FROM student ORDER BY stu_ID ASC";
$res = mysqli_query($CON, $sql);

echo "<form name ='studentListForm' action='studentuser.php'  method='get'>
  <table width='1250px' border='1px' cellpadding='8px' align='center'>
    <tr>
        <th>ID</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>Campus</th>
        <th>Email</th>
        <th>Survey</th>
        <th>Project</th>
        <th>Update</th>
    </tr>";

while ($row = mysqli_fetch_assoc($res))
{
    $stu_id = $row["stu_ID"];

    $surveySQL = "SELECT a.stu_Id as 'stu_Id' FROM surveyanswer a WHERE a.stu_Id = $stu_id";
    $surveys = mysqli_query($CON, $surveySQL);

    if (!$surveys)
        $surveyDone = "?";
    else
    {
        $count = 0;
        while ($surveyRow = mysqli_fetch_assoc($surveys))
            $count += 1;

        if ($count == 0)
            $surveyDone = "-";
        else if ($count == 1)
            $surveyDone = "Y";
        else
            $surveyDone = "$count!";
    }

    $groupsSQL = "SELECT * FROM groups WHERE stu_Id = $stu_id";
    $groups = mysqli_query($CON, $groupsSQL);

    if (!$groups)
        $projectText = "?";
    else
    {
        $projectTitles = [];
        while ($groupRow = mysqli_fetch_assoc($groups))
        {
            $pro_num = $groupRow["pro_num"];

            $found = false;
            if (!is_null($pro_num))
            {
                $projectSQL = "SELECT * FROM project WHERE pro_num = $pro_num";
                $projects = mysqli_query($CON, $projectSQL);

                if ($projects)
                {
                    while ($projectRow = mysqli_fetch_assoc($projects))
                    {
                        $found = true;
                        array_push($projectTitles, $projectRow["pro_title"]);
                    }
                }
            }
            if (!$found)
                array_push($projectTitles, "?");
        }
        if (sizeof($projectTitles) == 0)
            $projectText = "-";
        else
            $projectText = join(", ", $projectTitles);
    }

    echo "<tr>
        <td align='center'>$stu_id</td>
        <td align='center'>{$row['stu_FirstName']}</td>
        <td align='center'>{$row['stu_LastName']}</td>
        <td align='center'>".getcampus($row["stu_Campus"])."</td>
        <td align='center'>{$row['stu_Email']}</td>
        <td align='center'>$surveyDone</td>
        <td align='center'>$projectText</td>
        <td align='center'><button value ='".$stu_id."' name='studentid' class='inputButton'>Update</button></td>
    </tr>";
}

echo "</table>";
mysqli_free_result($res);
mysqli_close($CON);
require "footer.php"; ?>
