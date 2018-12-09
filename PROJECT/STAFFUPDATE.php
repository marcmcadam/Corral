<?php
 	$PageTitle = "Staff Update";
	require "../PAGES/HEADER_STAFF.PHP";
?>
<div id="contents">
<h2>Update Staff List</h2>
<p><form action="../PROJECT/STAFFPROCESS" method="post"></p>


<p>Staff ID </p>
<p><input type="text" name="STAFF_ID" value="<?php echo $_GET['number'];?>" id="ip2"/></p>
<p>Firstname </p>
<p><input type="text" name="STAFF_FIRSTNAME" value="<?php echo $_GET['firstname'];?>" id="ip2"/></p>
<p>Lastname </p>
<p><input type="text" name="STAFF_LASTNAME" value="<?php echo $_GET['lastname'];?>" id="ip2"/></p>
<p>Location </p>
<p><select name="stu_Campus">
    <option value="1"<?php if ($_GET['location']==1) echo "selected"; ?>>Burwood</option>
    <option value="2"<?php if ($_GET['location']==2) echo "selected"; ?>>Geelong</option>
    <option value="3"<?php if ($_GET['location']==3) echo "selected"; ?>>Cloud</option>
</select></p>
<p>Email </p>
<p><input type="text" name="STAFF_EMAIL" value="<?php echo $_GET['email'];?>" id="ip2"/></p>

<p><input type="submit" value="Update">&nbsp&nbsp<input type="reset" value="Reset"></p>
</form>
</div>



<hr>

<?php require "../PAGES/FOOTER_STAFF.PHP"; ?>
