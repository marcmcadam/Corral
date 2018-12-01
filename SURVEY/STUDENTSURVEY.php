<?php
 	$PageTitle = "Student Survey";
	require "../PAGES/HEADER_STUDENT.PHP";
?>

<h2>Student Survey</h2>
<form action="../SURVEY/surveyprocess" method="post">

<p>STUDENT_FIRSTNAME: <input type="text" name="STUDENT_FIRSTNAME" id="ip2"></p>

<p>Project skills</p>
<p>html/css: <select name="hc">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></p>

<p>Java Script: <select name="js">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></p>

<p>PHP: <select name="php">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></p>

<p>JAVA: <select name="java">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></p>

<p>C: <select name="c">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></p>

<p>C Plus Plus: <select name="cpp">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></p>

<p>Objective-C: <select name="oc">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></p>

<p>Databse: <select name="db">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></p>

<p>Unity: <select name="u3">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></p>

<p>UI: <select name="ui">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></p>

<p>Security: <select name="se">
<option value="Expert">Expert</option>
<option value="High">High</option>
<option value="Intermediate">Intermediate</option>
<option value="Novice">Novice</option>
<option value="not required" selected>Not required</option></select></p>

<p><input type="submit">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="reset" value="reset"></p>
</form>

<?php require "../PAGES/FOOTER_STUDENT.PHP"; ?>
