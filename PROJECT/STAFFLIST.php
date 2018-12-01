<?php
 	$PageTitle = "Staff List";
	require "../PAGES/HEADER_STAFF.PHP";
?>
<div id="contents" >

<h2>Staff Information</h2>
<?php

require('../DATABASE/CONNECTDB.PHP');

$sql="SELECT * FROM STAFF ORDER BY STAFF_ID ASC";
$res=mysqli_query($CON, $sql);

echo "<p><table width='1250px' height='150px' border='1px' cellpadding='10px' align='center'></p>";
echo "<tr><th>ID</th><th>FIRSTNAME</th><th>LASTNAME</th><th>LOCATION</th><th>EMAIL</th><th>Update Information</th></tr>";

while ($row=mysqli_fetch_assoc($res)){
    echo "<tr><td align='center' width='70px'>{$row['STAFF_ID']}</td><td align='center' width='190px'>{$row['STAFF_FIRSTNAME']}</td><td align='center' width='190px'>{$row['STAFF_LASTNAME']}</td><td align='center' width='180px'>{$row['STAFF_LOCATION']}</td><td align='center'  width='500px'>{$row['STAFF_EMAIL']}</td><td align='center'><a href='STAFFUPDATE.php?number={$row['STAFF_ID']}&firstname={$row['STAFF_FIRSTNAME']}&lastname={$row['STAFF_LASTNAME']}&location={$row['STAFF_LOCATION']}&email={$row['STAFF_EMAIL']}'>Update</a></td></tr>";
}

echo "</table>";
mysqli_free_result($res);
mysqli_close($CON);

?>
</div>


<hr>

<form action="../PROJECT/STAFFCSV" method="post">
	<input type="submit" name="STAFF_CSV" value="Export Staff List To CSV">
</form>

<p>

<form action="../PROJECT/STAFFPDF" method="post">
	<input type="submit" name="STAFF_PDF" value="Export Staff List to PDF">
</form>

<br>

<?php require "../PAGES/FOOTER_STAFF.PHP"; ?>
