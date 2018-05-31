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

//Form Variable
$sid = $_POST['sid'];
$location = $_POST['location'];
$employ = $_POST['employ'];
$capstone = $_POST['capstone'];
$course = $_POST['course'];
$skill1 = $_POST['skill1'];
$skill2 = $_POST['skill2'];
$skill3 = $_POST['skill3'];
$skill4 = $_POST['skill4'];
$skill5 = $_POST['skill5'];
$skill6 = $_POST['skill6'];
$skill7 = $_POST['skill7'];
$skill8 = $_POST['skill8'];
$skill9 = $_POST['skill9'];
$skill10 = $_POST['skill10'];
$skill11 = $_POST['skill11'];
$skill12 = $_POST['skill12'];
$skill13 = $_POST['skill13'];
$skill14 = $_POST['skill14'];
$techsk1 = $_POST['techsk1'];
$techsk2 = $_POST['techsk2'];
$techsk3 = $_POST['techsk3'];
$techsk4 = $_POST['techsk4'];
$techsk5 = $_POST['techsk5'];
$techsk6 = $_POST['techsk6'];
$techskpro1 = $_POST['techskpro1'];
$techskpro2 = $_POST['techskpro2'];
$techskpro3 = $_POST['techskpro3'];
$techskpro4 = $_POST['techskpro4'];
$techskpro5 = $_POST['techskpro5'];
$techskpro6 = $_POST['techskpro6'];
$softsk1 = $_POST['softsk1'];
$softsk2 = $_POST['softsk2'];
$softsk3 = $_POST['softsk3'];
$softsk4 = $_POST['softsk4'];
$softsk5 = $_POST['softsk5'];
$softsk6 = $_POST['softsk6'];
$softskpro1 = $_POST['softskpro1'];
$softskpro2 = $_POST['softskpro2'];
$softskpro3 = $_POST['softskpro3'];
$softskpro4 = $_POST['softskpro4'];
$softskpro5 = $_POST['softskpro5'];
$softskpro6 = $_POST['softskpro6'];
$projti1 = $_POST['projti1'];
$projti2 = $_POST['projti2'];
$projti3 = $_POST['projti3'];
$aspira = $_POST['aspira'];
$profile = $_POST['profile'];
$Entrepre = $_POST['Entrepre'];
$permis = $_POST['permis'];
$additi =htmlentities($_POST['additi']);


//Check if database is connected or not
if($CON)
	echo "<h1>Database Connected</h1>";
else
	echo "<h1>No Connection </h1></br>";
	

//Search Sutudent ID in Survey Table
$sql3 = "SELECT * FROM survey WHERE sid='$sid'";
$sqlsearch = mysqli_query($CON,$sql3);
$resultcount = mysqli_num_rows($sqlsearch);

//Search Sutudent ID in Student Table
$sql5 = "SELECT * FROM student WHERE STUDENT_ID='$sid'";
$sqlsearch5 = mysqli_query($CON,$sql5);
$resultcount5 = mysqli_num_rows($sqlsearch5);


//If Student ID Not Found in Student Table
if($resultcount5 == 0){
	echo "<h2>Student ID Not Found, Student Need To Register</h2>"; 
}

//If Student ID Found in Survey Table
else if($resultcount > 0 ){
	echo "<h2>Student ID Already Submit Survey</h2>";
}

else
{
//If Student ID Not Found, Inserting Survey into survey Table
$sql2 = "INSERT INTO survey (sid, 
location, 
employ,
capstone, 
course, 
skill1, skill2, skill3, skill4, skill5, skill6, skill7, skill8, skill9, skill10, skill11, skill12, skill13, skill14, techsk1, techsk2, techsk3, techsk4, techsk5, techsk6,
techskpro1, techskpro2, techskpro3, techskpro4, techskpro5, techskpro6, softsk1, softsk2, softsk3, softsk4, softsk5, softsk6,
softskpro1, softskpro2, softskpro3, softskpro4, softskpro5, softskpro6, projti1, projti2, projti3, aspira, profile, Entrepre, permis, additi) VALUES ('$sid', '$location', '$employ', '$capstone', '$course', '$skill1', '$skill2', '$skill3', '$skill4', '$skill5', '$skill6', '$skill7', '$skill8', '$skill9', '$skill10', '$skill11', '$skill12', '$skill13', '$skill14', '$techsk1', '$techsk2', '$techsk3', '$techsk4', '$techsk5', '$techsk6', '$techskpro1', '$techskpro2', '$techskpro3', '$techskpro4', '$techskpro5', '$techskpro6', '$softsk1', '$softsk2', '$softsk3', '$softsk4', '$softsk5','$softsk6', '$softskpro1', '$softskpro2', '$softskpro3', '$softskpro4', '$softskpro5', '$softskpro6', '$projti1', '$projti2', '$projti3', '$aspira', '$profile', '$Entrepre', '$permis', '$additi')";

//Check if survey is inserted into database table
if(!mysqli_query($CON, $sql2))
{
	echo "<h2>Survey Not Inserted </h2>";
	$sid = '';
	/*die ('' .mysqli_error); */
}
else
{
	//Print Out Survey Result
echo "<h2>Survey Inserted to Database</h2>";
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
