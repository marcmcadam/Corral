<?php
	$PageTitle = "Project Search";
	require "../PAGES/HEADER_STAFF.PHP";
	$script = '

<script type="text/javascript">
fucntion validate(search) {
	if(document.search.View.value == ""){
		alert("Please select a search value");
		return false
	}
	return true
}
</script>';
?>

<h2>Project View</h2>
<form style="margin-left: 40px" action="../PROJECT/VIEWRESULTS" method="post" name="search" id="search" onSubmit="return validate(search)">
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

<?php require "../PAGES/FOOTER_STAFF.PHP"; ?>
