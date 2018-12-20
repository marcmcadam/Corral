<?php
 	$PageTitle = "Results";
	require "header_staff.php";
?>

<h2>Results</h2>

<?php
require_once "connectdb.php";

$view = ["Active","Inactive","Planning","Cancelled"];

if (isset($_POST['View'])) {


  if ($_POST['View'] == "All") {
    $sql = "SELECT * FROM project";
  } elseif (in_array($_POST['View'], $view)){
	   $sql = 'SELECT * FROM project WHERE pro_status = "'.mysqli_real_escape_string($CON, $_POST["View"]).'"';
  } else {
    //invalid post, injection attempt?
  }
  if ($sql) {
    if(!$res = mysqli_query($CON, $sql)) {
      echo "Error: ".mysqli_error($CON);
    }
    echo "<p><table width='900px'  border='1px' cellpadding='10px'></p>";
    echo "<tr><th>Project Number</th><th>Project Brief</th><th>Project Leader</th><th>Project Status</th></tr>";
    while ($row=mysqli_fetch_assoc($res)){
        echo "<tr><td align='center'>{$row['pro_num']}</td><td align='center'>{$row['pro_brief']}</td><td align='center'>{$row['pro_leader']}</td><td align='center'>{$row['pro_status']}</td></tr>";
    }
    echo "</table>";
    mysqli_free_result($res);
    mysqli_close($CON);
  }
} else {
  // No post variable, redirect to search page
  header('Location: projectsearch.php');
}
?>

<br><hr>

Export Project CSV:
<form action="projectlistcsv.php" method="post">
	<select name="View">
		<option value="All">All</option>
		<option value="Active">Active Projects</option>
		<option value="Inactive">Inactive Projects</option>
		<option value="Planning">Planning Projects</option>
		<option value="Cancelled">Cancelled Projects</option>
	</select><br>
	<input type="submit" name="export_excel" value="CSV">
</form>

<br>

Export Project PDF:
<form action="projectlistpdf.php" method="post">
 <select name="View">
		<option value="All">All</option>
		<option value="Active">Active Projects</option>
		<option value="Inactive">Inactive Projects</option>
		<option value="Planning">Planning Projects</option>
		<option value="Cancelled">Cancelled Projects</option>
	</select><br>
	<input type="submit" name="export_PDF" value="PDF">
</form>
<br>
<a href="projectsearch.php">Back to Project Search</a><br>

<?php require "footer_staff.php"; ?>
