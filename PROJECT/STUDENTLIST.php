<?php
 	$PageTitle = "Student List";
	require "../PAGES/HEADER_STAFF.PHP";
?>
<div id="contents" >

<h2>Student Information</h2>
<?php

require('../DATABASE/CONNECTDB.PHP');

$sql="SELECT * FROM student ORDER BY stu_ID ASC";
$res=mysqli_query($CON, $sql);

echo "<p><table width='1250px' height='150px' border='1px' cellpadding='10px' align='center'></p>";
echo "<tr><th>ID</th><th>FirstName</th><th>LastName</th><th>Campus</th><th>Email</th><th>Update Information</th></tr>";

while ($row=mysqli_fetch_assoc($res)){
    echo "<tr><td align='center' width='70px'>{$row['stu_ID']}</td><td align='center' width='190px'>{$row['stu_FirstName']}</td><td align='center' width='190px'>{$row['stu_LastName']}</td><td align='center' width='180px'>";
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
    echo "</td><td align='center'  width='500px'>{$row['stu_Email']}</td><td align='center'><a href='STUDENTUPDATE.php?number={$row['stu_ID']}&firstname={$row['stu_FirstName']}&lastname={$row['stu_LastName']}&location={$row['stu_Campus']}&email={$row['stu_Email']}'>Update</a></td></tr>";
}

echo "</table>";
mysqli_free_result($res);
mysqli_close($CON);

?>
</div>


<hr>


<form action="../PROJECT/STUDENTCSV" method="post">
	<input type="submit" name="STUDENT_CSV" value="Export Student List To CSV">
</form>

<p>

<form action="../PROJECT/STUDENTPDF" method="post">
	<input type="submit" name="STUDENT_PDF" value="Export Student List To PDF">
</form>

<p>

<form action="../SURVEY/SURVEYCSV" method="post">
	<input type="submit" name="SURVEY_CSV" value="Export Student Survey To CSV">
</form>


<br>

<?php require "../PAGES/FOOTER_STAFF.PHP"; ?>
