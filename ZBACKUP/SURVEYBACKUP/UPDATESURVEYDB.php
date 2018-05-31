<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">

</style><!--[if lte IE 7]>
<style>
.content { margin-right: -1px; } /* this 1px negative margin can be placed on any of the columns in this layout with the same corrective effect. */
ul.nav a { zoom: 1; }  /* the zoom property gives IE the hasLayout trigger it needs to correct extra whiltespace between the links */
</style>
<![endif]--></head>

<body>
<p>
<?php

//Database Access
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'mydb';

//Connect to Database
$CON = mysqli_connect($host, $user, $pass, $db);

//Check if database is connected or not
if($CON)
	echo "<h1>Database Connected</h1>";
else
	echo "<h1>No Connection </h1></br>";

//Form Variable
$STUDENT_ID= MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['STUDENT_ID']);
$LOCATION = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['LOCATION']);
$CURRENT_COURSE = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['CURRENT_COURSE']);
$ROLE1 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['ROLE1']);
$ROLE2 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['ROLE2']);
$ROLE3 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['ROLE3']);
$TECHNICAL_SKILLS1 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['TECHNICAL_SKILLS1']);
$TECHNICAL_SKILLS2 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['TECHNICAL_SKILLS2']);
$TECHNICAL_SKILLS3 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['TECHNICAL_SKILLS3']);
$TECHNICAL_RATING1 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['TECHNICAL_RATING1']);
$TECHNICAL_RATING2 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['TECHNICAL_RATING2']);
$TECHNICAL_RATING3 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['TECHNICAL_RATING3']);
$SOFT_SKILLS1 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['SOFT_SKILLS1']);
$SOFT_SKILLS2 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['SOFT_SKILLS2']);
$SOFT_SKILLS3 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['SOFT_SKILLS3']);
$SOFT_RATING1 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['SOFT_RATING1']);
$SOFT_RATING2 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['SOFT_RATING2']);
$SOFT_RATING3 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['SOFT_RATING3']);
$PROJECT_PREFERENCE1 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_PREFERENCE1']);
$PROJECT_PREFERENCE2 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_PREFERENCE2']);
$PROJECT_PREFERENCE3 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_PREFERENCE3']);
$STUDENT_PERMISSION = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['STUDENT_PERMISSION']);
$STUDENT_ASPIRATION = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['STUDENT_ASPIRATION']);
$STUDENT_COMMENT = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['STUDENT_COMMENT']);


//If Student ID Not Found, Inserting Survey into survey Table
$sql2 = "UPDATE survey SET sid='$sid',
location='$location',
employ='$employ',
capstone='$capstone',
course='$course',
skill1='$skill1',
skill2='$skill2',
skill3='$skill3',
skill4='$skill4',
skill5='$skill5',
skill6='$skill6',
skill7='$skill7',
skill8='$skill8',
skill9='$skill9',
skill10='$skill10',
skill11='$skill11',
skill12='$skill12',
skill13='$skill13',
skill14='$skill14',
techsk1='$techsk1',
techsk2='$techsk2',
techsk3='$techsk3',
techsk4='$techsk4',
techsk5='$techsk5',
techsk6='$techsk6',
techskpro1='$techskpro1',
techskpro2='$techskpro2',
techskpro3='$techskpro3',
techskpro4='$techskpro4',
techskpro5='$techskpro5',
techskpro6='$techskpro6',
softsk1='$softsk1',
softsk2='$softsk2',
softsk3='$softsk3',
softsk4='$softsk4',
softsk5='$softsk5',
softsk6='$softsk6',
softskpro1='$softskpro1',
softskpro2='$softskpro2',
softskpro3='$softskpro3',
softskpro4='$softskpro4',
softskpro5='$softskpro5',
softskpro6='$softskpro6',
projti1='$projti1',
projti2='$projti2',
projti3='$projti3',
aspira='$aspira',
profile='$profile',
Entrepre='$Entrepre',
permis='$permis',
additi='$additi' WHERE sid= $sid";



//Check if survey is updated into database table
if(!mysqli_query($CON, $sql2))
{
	echo "<h2>Survey Not Updated </h2>";
}
else
{
	//Print Out Survey Result
echo "<h2>Survey Updated to Database</h2>";
echo "<table border=1 cellspacing=0 cellpading=0>
<tr> <td><font color=blue>Student ID</td> <td>$sid</font></td></tr>
<tr> <td><font color=blue>Student Location</td> <td>$location</font></td></tr>
<tr> <td><font color=blue>Student Employment Status</td> <td>$employ</font></td></tr>
<tr> <td><font color=blue>Student Enrolled in Capstone</td> <td>$capstone</font></td></tr>
<tr> <td><font color=blue>Student Current Course</td> <td>$course</font></td></tr>
<tr> <td><font color=blue>Student Programmer Level (4 to 1)</td> <td>$skill1</font></td></tr>
<tr> <td><font color=blue>Student UX/UI Designer Level (4 to 1)</td> <td>$skill2</font></td></tr>
<tr> <td><font color=blue>Student Security Specialist Level (4 to 1)</td> <td>$skill3</font></td></tr>
<tr> <td><font color=blue>Student Database Developer Level (4 to 1)</td> <td>$skill4</font></td></tr>
<tr> <td><font color=blue>Student Web Developer Level (4 to 1)</td> <td>$skill5</font></td></tr>
<tr> <td><font color=blue>Student Cloud Service Developer Level (4 to 1)</td> <td>$skill6</font></td></tr>
<tr> <td><font color=blue>Student App Developer Level (4 to 1)</td> <td>$skill7</font></td></tr>
<tr> <td><font color=blue>Student Network Engineer Level (4 to 1)</td> <td>$skill8</font></td></tr>
<tr> <td><font color=blue>Student VR/Game Developer Level (4 to 1)</td> <td>$skill9</font></td></tr>
<tr> <td><font color=blue>Student 3D Artist/Animator Level (4 to 1)</td> <td>$skill10</font></td></tr>
<tr> <td><font color=blue>Student Technical Artist Level (4 to 1)</td> <td>$skill11</font></td></tr>
<tr> <td><font color=blue>Student Project Manager Level (4 to 1)</td> <td>$skill12</font></td></tr>
<tr> <td><font color=blue>Student Interactive Media Developer Level (4 to 1)</td> <td>$skill13</font></td></tr>
<tr> <td><font color=blue>Student Business Analyst Level (4 to 1)</td> <td>$skill14</font></td></tr>
<tr> <td><font color=blue>Student Technical Skill 1</td> <td>$techsk1</font></td></tr>
<tr> <td><font color=blue>Student Technical Skill 2</td> <td>$techsk2</font></td></tr>
<tr> <td><font color=blue>Student Technical Skill 3</td> <td>$techsk3</font></td></tr>
<tr> <td><font color=blue>Student Technical Skill 4</td> <td>$techsk4</font></td></tr>
<tr> <td><font color=blue>Student Technical Skill 5</td> <td>$techsk5</font></td></tr>
<tr> <td><font color=blue>Student Technical Skill 6</td> <td>$techsk6</font></td></tr>
<tr> <td><font color=blue>Student Technical Skill Proficiency 1 (4 to 1)</td> <td>$techskpro1</font></td></tr>
<tr> <td><font color=blue>Student Technical Skill Proficiency 2 (4 to 1)</td> <td>$techskpro2</font></td></tr>
<tr> <td><font color=blue>Student Technical Skill Proficiency 3 (4 to 1)</td> <td>$techskpro3</font></td></tr>
<tr> <td><font color=blue>Student Technical Skill Proficiency 4 (4 to 1)</td> <td>$techskpro4</font></td></tr>
<tr> <td><font color=blue>Student Technical Skill Proficiency 5 (4 to 1)</td> <td>$techskpro5</font></td></tr>
<tr> <td><font color=blue>Student Technical Skill Proficiency 6 (4 to 1)</td> <td>$techskpro6</font></td></tr>
<tr> <td><font color=blue>Student Soft Skill 1</td> <td>$softsk1</font></td></tr>
<tr> <td><font color=blue>Student Soft Skill 2</td> <td>$softsk2</font></td></tr>
<tr> <td><font color=blue>Student Soft Skill 3</td> <td>$softsk3</font></td></tr>
<tr> <td><font color=blue>Student Soft Skill 4</td> <td>$softsk4</font></td></tr>
<tr> <td><font color=blue>Student Soft Skill 5</td> <td>$softsk5</font></td></tr>
<tr> <td><font color=blue>Student Soft Skill 6</td> <td>$softsk6</font></td></tr>
<tr> <td><font color=blue>Student Soft Skill Proficiency 1 (4 to 1)</td> <td>$softskpro1</font></td></tr>
<tr> <td><font color=blue>Student Soft Skill Proficiency 2 (4 to 1)</td> <td>$softskpro2</font></td></tr>
<tr> <td><font color=blue>Student Soft Skill Proficiency 3 (4 to 1)</td> <td>$softskpro3</font></td></tr>
<tr> <td><font color=blue>Student Soft Skill Proficiency 4 (4 to 1)</td> <td>$softskpro4</font></td></tr>
<tr> <td><font color=blue>Student Soft Skill Proficiency 5 (4 to 1)</td> <td>$softskpro5</font></td></tr>
<tr> <td><font color=blue>Student Soft Skill Proficiency 6 (4 to 1)</td> <td>$softskpro6</font></td></tr>
<tr> <td><font color=blue>Student Project Title 1</td> <td>$projti1</font></td></tr>
<tr> <td><font color=blue>Student Project Title 2</td> <td>$projti2</font></td></tr>
<tr> <td><font color=blue>Student Project Title 3</td> <td>$projti3</font></td></tr>
<tr> <td><font color=blue>Student Aspiration</td> <td>$aspira</font></td></tr>
<tr> <td><font color=blue>Student Profile</td> <td>$profile</font></td></tr>
<tr> <td><font color=blue>Student Entrepreneurship</td> <td>$Entrepre</font></td></tr>
<tr> <td><font color=blue>Student Entrepreneurship</td> <td>$permis</font></td></tr>
<tr> <td><font color=blue>Student Final Words</td> <td>$additi</font></td></tr>
</table>";
}
//Close database connection
//mysqli_close($CON);
?>
<br>

<form id="export" name="export" method="post" action="SURVEY_CSV.php">
  <label for="sid"></label>
      Student ID
      <input name="sid" type="text" id="sid" value= <?php echo $sid?> size="9" readonly/>
      <input name="export2" type="submit" value="Export To CSV"/>
       <br><br>
</form>
<form id="form1" name="form1" method="post" action="ALL_SURVEY_CSV.php">
 <br>
Total Survey Records:
<label for="textfield"></label>
<?php
$all = "SELECT * FROM survey";
$count2 = mysqli_query($CON,$all);
$resultcount2 = mysqli_num_rows($count2);
?>
<input type="text" name="textfield" id="textfield" value= <?php echo $resultcount2?> size="4" readonly/>
<input type="submit" name="button" id="button" value="Export All Survey To CSV" />
</form>
<p>&nbsp; </p>
<p>&nbsp; </p>


</p>
</br>
</body>
</html>
