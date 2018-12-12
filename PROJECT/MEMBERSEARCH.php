<?php
	$PageTitle = "Project Search";
	require "../PAGES/HEADER_STAFF.PHP";
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

<h1>Search</h1>
<form action="../PROJECT/SEARCHRESULTS" style="margin-left: 40px" method="post" name="search" id="search" onSubmit="return validate(search)">
    <table>
        <tr>
            <td> What are you searching for:</td>
            <td><select name="View" class="inputList">
                    <option value="">--Select--</option>
                    <option value="student">Students</option>
                    <option value="staff">Staff</option>
                </select></td>
            </td>
        </tr><tr>
        <td>&nbsp;</td><td>&nbsp;</td>
        </tr><tr>
            <td>First name:</td>
            <td><input type="text" name="FirstName" class="inputBox"></td>
        </tr><tr>
        <td>&nbsp;</td><td>&nbsp;</td>
        </tr><tr>
            <td>Email:</td>
            <td><input type="text" name="Email" class="inputBox"></td>
        </tr><tr>
        <td>&nbsp;</td><td>&nbsp;</td>
        </tr><tr>
            <td>Location:</td>
            <td><select name="Location" class="inputList">
                    <option value="">--Select--</option>
                    <option value="Burwood">Burwood</option>
                    <option value="Geelong">Geelong</option>
                    <option value="Cloud">Cloud</option>
                </select></td>
        </tr><tr>
        <td>&nbsp;</td><td>&nbsp;</td>
        </tr>
    </table>
	<input type="submit" name="Submit" value="Submit" class="inputButton">
	<input type="reset" value="Clear Search" class="inputButton">
</form>
<?php require "../PAGES/FOOTER_STAFF.PHP"; ?>
