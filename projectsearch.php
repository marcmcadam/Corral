<?php
	$PageTitle = "Project Search";
	require "header_staff.php";
?>

<h2>Project View</h2>
<form style="margin-left: 40px" action="viewresults.php" method="post" name="search" id="search">
	What are you searching for: <select name="View">
		<option value="">-Select-</option>
		<option value="All">All</option>
		<option value="Active">Active Projects</option>
		<option value="Inactive">Inactive Projects</option>
		<option value="Planning">Planning Projects</option>
		<option value="Cancelled">Cancelled Projects</option>
	</select><br><br>
	<input type="submit" name="Submit" value="Search">
</form>
<br><br>

<?php require "footer.php"; ?>
