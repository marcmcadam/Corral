<?php
	$PageTitle = "Project Search";
	require "HEADER_STAFF.PHP";
	$script = '<script type="text/javascript">
function validate(search) {
	if(document.search.View.value == ""){
		alert("Please select a search value");
		return false
	}
	return true
}
</script>'
?>

<h2>Project View</h2>
<form action="../PROJECT/SEARCHRESULTS" style="margin-left: 40px" method="post" name="search" id="search" onSubmit="return validate(search)">
	What are you searching for: <select name="View">
		<option value="">--Select--</option>
		<option value="student">Students</option>
		<option value="staff">Staff</option>
	</select><br><br>
	First name: <input type="text" name="FirstName" id="ip2"><br><br>
	Email: <input type="text" name="Email" id="ip2"><br><br>
	Location: <select name="Location">
		<option value="">--Select--</option>
		<option value="Burwood">Burwood</option>
		<option value="Geelong">Geelong</option>
		<option value="Cloud">Cloud</option>
	</select><br><br>
	<input type="submit" name="Submit" value="Submit">
	<input type="reset" value="Clear Search"><br><br>
</form>
<br><br>

<?php require "FOOTER_STAFF.PHP"; ?>
