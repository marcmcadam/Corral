<?php
 	$PageTitle = "Project List";
	require "../PAGES/HEADER_STAFF.PHP";
?>
<div id="contents" >

<h2>List Group Listing </h2>

</div>
<p>This page under construction</p>
<?php
// require('../DATABASE/CONNECTDB.PHP');
// $sql="SELECT student_firstname,project_num FROM surveyanswer ORDER BY project_num ASC";
// $res=mysqli_query($CON, $sql);

echo "<p><table width='1250px' height='150px' border='1px' cellpadding='10px' align='center'></p>";
echo "<tr><th>Student_Firstname</th><th>Project_Number</th></tr>";

// while ($row=mysqli_fetch_assoc($res)){
// 	echo "<tr><td align='center' width='70px'>{$row['student_firstname']}</td><td align='center' width='70px'>{$row['project_num']}</td></tr>";
// }

echo "</table>";
// mysqli_free_result($res);
// mysqli_close($CON);
?>

<hr>

<?php require "../PAGES/FOOTER_STAFF.PHP"; ?>
