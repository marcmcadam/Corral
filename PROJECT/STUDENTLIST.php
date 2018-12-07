<?php
 	$PageTitle = "Student List";
	require "../PAGES/HEADER_STAFF.PHP";
?>
<h2>Student Information</h2>
<form action="STUDENT_CSV" method="post">
	<input type="submit" value="Export Student List To CSV">
</form>
<form action="STUDENTPDF" method="post">
	<input type="submit" value="Export Student List To PDF">
</form>
<form action="SURVEY_CSV" method="post">
	<input type="submit" value="Export Student Survey To CSV">
</form>
<br>
<?php
    require_once '../DATABASE/CONNECTDB.PHP';

    $sql = "SELECT * FROM student ORDER BY stu_ID ASC";
    $res = mysqli_query($CON, $sql);

    echo "<p><table width='1250px' height='150px' border='1px' cellpadding='10px' align='center'></p>";
    echo "<tr>  <th>ID</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Campus</th>
                <th>Email</th>
                <th>Survey</th>
                <th>Update Information</th>
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
        
        echo "<tr>
            <td align='center' width='70px'>$stu_id</td>
            <td align='center' width='190px'>{$row['stu_FirstName']}</td>
            <td align='center' width='190px'>{$row['stu_LastName']}</td>
            <td align='center' width='180px'>";
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
                <td align='center' width='500px'>{$row['stu_Email']}</td>
                <td align='center' width='70px'>$surveyDone</td>
                <td align='center'><a href='STUDENTUPDATE.php?number={$row['stu_ID']}&firstname={$row['stu_FirstName']}&lastname={$row['stu_LastName']}&location={$row['stu_Campus']}&email={$row['stu_Email']}'>Update</a></td>
        </tr>";
    }

    echo "</table>";
    mysqli_free_result($res);
    mysqli_close($CON);
    
    require "../PAGES/FOOTER_STAFF.PHP";
?>
