<?php
 	$PageTitle = "Student List";
	require "HEADER_STAFF.PHP";
?>
<div id="contents" >

<h2>Student Information</h2>
<?php

require('../DATABASE/CONNECTDB.PHP');

$sql="SELECT * FROM student ORDER BY STUDENT_ID ASC";
$res=mysqli_query($CON, $sql);

echo "<p><table width='1250px' height='150px' border='1px' cellpadding='10px' align='center'></p>";
echo "<tr><th>ID</th><th>FIRSTNAME</th><th>LASTNAME</th><th>LOCATION</th><th>EMAIL</th><th>Update Information</th></tr>";

while ($row=mysqli_fetch_assoc($res)){
    echo "<tr><td align='center' width='70px'>{$row['STUDENT_ID']}</td><td align='center' width='190px'>{$row['STUDENT_FIRSTNAME']}</td><td align='center' width='190px'>{$row['STUDENT_LASTNAME']}</td><td align='center' width='180px'>{$row['STUDENT_LOCATION']}</td><td align='center'  width='500px'>{$row['STUDENT_EMAIL']}</td><td align='center'><a href='STUDENTUPDATE.php?number={$row['STUDENT_ID']}&firstname={$row['STUDENT_FIRSTNAME']}&lastname={$row['STUDENT_LASTNAME']}&location={$row['STUDENT_LOCATION']}&email={$row['STUDENT_EMAIL']}'>Update</a></td></tr>";
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

<?php require "FOOTER_STAFF.PHP"; ?>
