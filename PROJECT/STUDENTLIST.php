<?php
 	$PageTitle = "Student List";
	require "../PAGES/HEADER_STAFF.PHP";
?>
<h2>Student Information</h2>
<form action="STUDENTCSV" method="post">
	<input type="submit" value="Export Student List To CSV">
</form>
<form action="STUDENTPDF" method="post">
	<input type="submit" value="Export Student List To PDF">
</form>
<form action="SURVEYCSV" method="post">
	<input type="submit" value="Export Student Survey To CSV">
</form>
<br>
<?php
    require_once '../DATABASE/CONNECTDB.PHP';

    $sql = "SELECT * FROM student ORDER BY stu_ID ASC";
    $res = mysqli_query($CON, $sql);

    echo "<table width='1250px' border='1px' cellpadding='8px' align='center'>
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
            <td align='center'>";
        switch ($row["stu_Campus"]) {
          case 1:
            echo "Burwood";
            break;
          case 2:
            echo "Geelong";
            break;
          case 3:
            echo "Cloud";
            break;
        }
        echo "</td>
                <td align='center'>{$row['stu_Email']}</td>
                <td align='center'>$surveyDone</td>
                <td align='center'>$projectText</td>
                <td align='center'><a href='STUDENTUPDATE.php?number={$row['stu_ID']}&firstname={$row['stu_FirstName']}&lastname={$row['stu_LastName']}&location={$row['stu_Campus']}&email={$row['stu_Email']}'>Update</a></td>
        </tr>";
    }

    echo "</table>";
    mysqli_free_result($res);
    mysqli_close($CON);
    
    require "../PAGES/FOOTER_STAFF.PHP";
?>
