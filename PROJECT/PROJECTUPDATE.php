<?php
 	$PageTitle = "Project Update";
	require "../PAGES/HEADER_STAFF.PHP";
?>
<div id="contents">
<h2>Update Project</h2>
<p><form action="../PROJECT/PROJECTPROCESS" method="post"></p>
<p>Project Number </p>
<p><input type="number" name="PROJECT_NUM" value="<?php echo $_GET['number'];?>" id="ip4"/></p>
<p>Project Title </p>
<p><input type="text" name="PROJECT_TITLE" value="<?php echo $_GET['title'];?>" id="ip2"/></p>
<p>Project Leader </p>
<p><input type="text" name="PROJECT_LEADER" value="<?php echo $_GET['leader'];?>" id="ip2"/></p>
<p>Leader Email </p>
<p><input type="email" name="PROJECT_EMAIL" value="<?php echo $_GET['email'];?>" id="ip2"/></p>
<p>Project Brief </p>
<p><textarea name="PROJECT_BRIEF" rows="5" cols="40" value="<?php echo $_GET['brief'];?>" id="ip3"></textarea></br></p>
<p>Project Status &nbsp</br></br><input type="radio" name="PROJECT_STATUS" value="active"/>Active</br></br><input type="radio" name="PROJECT_STATUS" value="inactive"/>Inactive</br></br><input type="radio" name="PROJECT_STATUS" value="planning"/>Planning</br></br>
<input type="radio" name="PROJECT_STATUS" value="cancelled"/>Cancelled</br></p>

<p>Project skills</p>
html/css<select name="hc">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

Java Script<select name="js">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

PHP<select name="php">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

JAVA<select name="java">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

C<select name="c">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

C Plus Plus<select name="cpp">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

Objective-C<select name="oc">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

Databse<select name="db">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

Unity<select name="u3">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

UI<select name="ui">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

Security<select name="se">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></br></br>

<p><input type="submit" value="update">&nbsp&nbsp<input type="reset" value="reset"></p>
</form>
</div>


<hr>

<?php require "../PAGES/FOOTER_STAFF.PHP"; ?>
