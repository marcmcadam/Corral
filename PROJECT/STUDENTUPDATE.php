<?php
 	$PageTitle = "Template";
	require "HEADER_STAFF.PHP";
?>
<div id="contents">
<h2>Update Student List</h2>
<p><form action="../PROJECT/STUDENTPROCESS" method="post"></p>


<p>Student ID </p>
<p><input type="text" name="STUDENT_ID" value="<?php echo $_GET['number'];?> "id="ip2"/></p>
<p>Firstname </p>
<p><input type="text" name="STUDENT_FIRSTNAME" value="<?php echo $_GET['firstname'];?>"id="ip2"/></p>
<p>Lastname </p>
<p><input type="text" name="STUDENT_LASTNAME" value="<?php echo $_GET['lastname'];?>"id="ip2"/></p>
<p>Location </p>
<p><input type="text" name="STUDENT_LOCATION" value="<?php echo $_GET['location'];?>"id="ip2"/></p>
<p>Email </p>
<p><input type="text" name="STUDENT_EMAIL" value="<?php echo $_GET['email'];?>"id="ip2"/></p>

<p><input type="submit" value="update">&nbsp&nbsp<input type="reset" value="reset"></p>
</form>
</div>



<hr>

<?php require "FOOTER_STAFF.PHP"; ?>
