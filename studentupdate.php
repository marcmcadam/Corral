<?php
 	$PageTitle = "Template";
	require "header_staff.php";
?>
<h2>Update Student List</h2>
<p><form action="studentprocess.php" method="post"></p>


<p>Student ID </p>
<p><input type="text" name="stu_ID" value="<?php echo $_GET['number'];?>" class="inputBox"/></p>
<p>Firstname </p>
<p><input type="text" name="stu_FirstName" value="<?php echo $_GET['firstname'];?>" class="inputBox"/></p>
<p>Lastname </p>
<p><input type="text" name="stu_LastName" value="<?php echo $_GET['lastname'];?>" class="inputBox"/></p>
<p>Location </p>
<p><select name="stu_Campus" class="inputList">
    <option value="1"<?php if ($_GET['location']==1) echo "selected"; ?>>Burwood</option>
    <option value="2"<?php if ($_GET['location']==2) echo "selected"; ?>>Geelong</option>
    <option value="3"<?php if ($_GET['location']==3) echo "selected"; ?>>Cloud</option>
</select></p>
<p>Email </p>
<p><input type="text" name="stu_Email" value="<?php echo $_GET['email'];?>" class="inputBox"/></p>

<p><input type="submit" value="Update" class="inputButton">&nbsp&nbsp<input type="reset" value="Reset" class="inputButton"></p>
</form>
</div>



<hr>

<?php require "footer.php"; ?>
