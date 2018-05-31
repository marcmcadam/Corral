<?php
session_start();
REQUIRE('../DATABASE/CONNECTDB.PHP');

if ( $_SESSION['STAFF_ID'] != 1) {
	$_SESSION['message'] = "You mus log in before viewing this page";
	header("location: ../ACCESS/error");
	}
	else {
	$id = $_SESSION['STAFF_ID'];
	$staff_firstname = $_SESSION['STAFF_FIRSTNAME'];
	$staff_lastname = $_SESSION['STAFF_LASTNAME'];
	}
?>
<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>Add Project</title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesstaff.css">
</head>



<body>

<div class="Header">
	<h1>Corral</h1>
</div>


<div class ="navbar">
	<ul>
		<li><a href="../PAGES/STAFFHOME">Home</a></li>
		<li><a href ="#">Survey</a>
			<ul>
				<li><a href ="#">Projects</a>
					<ul>
						<li><a href ="../PROJECT/ADDPROJECT">Create Project</a></li>
						<li><a href ="../PROJECT/PROJECTLIST">Project List</a></li>
						<li><a href ="../PROJECT/PROJECTSEARCH">Project Search</a></li>
					</ul>
				</li>
				<li><a href ="#">Groups</a>
					<ul>
						<li><a href ="../PROJECT/NEWGROUP">Create Group</a></li>
						<li><a href ="../PROJECT/GROUPUPDATE">Update Group</a></li>
						<li><a href ="../PROJECT/GROUPLIST">List Groups</a>
						</li>
					</ul>
				</li>
				<li><a href ="#">Users</a>
					<ul>
						<li><a href ="../PROJECT/STUDENTLIST">Student List</a></li>
						<li><a href ="../PROJECT/STAFFLIST">Staff List</a></li>
						<li><a href ="../PROJECT/MEMBERSEARCH">Search For</a></li>
						</li>
					</ul>
				</li>
			</ul>
		</li>
		<li><a href ="../PAGES/STAFFCONTACT">Contacts</a></li>
		<li><a href ="../PAGES/STAFFABOUTUS">About Us</a></li>
		<li><a href ="../ACCESS/stafflogout">Logout</a></li>
	</ul>
</div>


<div id="contents" >
<h2>Add New Project</h2>


<form method="post">
<p>Project Title &nbsp<br><input type="text" name="PRO_TITLE"/></br></p>
<p>Project Leader &nbsp<br><input type="text" name="PRO_LEADER"/></br></p>
<p>Leader Email &nbsp<br><input type="email" name="PRO_EMAIL"/></br></p>
<p>Project Brief</br><textarea name="PRO_BRIEF" rows="5" cols="40"></textarea></br></p>
<p>Project Status &nbsp</br></br><input type="radio" name="PRO_STATUS" value="active"/>Active</br></br><input type="radio" name="PRO_STATUS" value="inactive"/>Inactive</br></br><input type="radio" name="PRO_STATUS" value="planning"/>Planning</br></br></p>
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

<p><input type="submit">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="reset" value="reset"></p>
</form>

<?php
if (isset($_POST['se'])) {
	
	$title=$_POST['PRO_TITLE'];
	$leader=$_POST['PRO_LEADER'];
	$email=$_POST['PRO_EMAIL'];
	$brief=$_POST['PRO_BRIEF'];
	$status=$_POST['PRO_STATUS'];

	if($_POST['hc']=="not required"){
	$hc=0;
	}elseif($_POST['hc']=="Novice"){
	$hc=1;
	}elseif($_POST['hc']=="Intermediate"){
	$hc=2;
	}elseif($_POST['hc']=="High"){
	$hc=3;
	}elseif($_POST['hc']=="Expert"){
	$hc=4;
	}

	if($_POST['js']=="not required"){
	$js=0;
	}elseif($_POST['js']=="Novice"){
	$js=1;
	}elseif($_POST['js']=="Intermediate"){
	$js=2;
	}elseif($_POST['js']=="High"){
	$js=3;
	}elseif($_POST['js']=="Expert"){
	$js=4;
	}		

	if($_POST['php']=="not required"){
	$php=0;
	}elseif($_POST['php']=="Novice"){
	$php=1;
	}elseif($_POST['php']=="Intermediate"){
	$php=2;
	}elseif($_POST['php']=="High"){
	$php=3;
	}elseif($_POST['php']=="Expert"){
	$php=4;
	}		

	if($_POST['java']=="not required"){
	$java=0;
	}elseif($_POST['java']=="Novice"){
	$java=1;
	}elseif($_POST['java']=="Intermediate"){
	$java=2;
	}elseif($_POST['java']=="High"){
	$java=3;
	}elseif($_POST['java']=="Expert"){
	$java=4;
	}		

	if($_POST['c']=="not required"){
	$c=0;
	}elseif($_POST['c']=="Novice"){
	$c=1;
	}elseif($_POST['c']=="Intermediate"){
	$c=2;
	}elseif($_POST['c']=="High"){
	$c=3;
	}elseif($_POST['c']=="Expert"){
	$c=4;
	}

	if($_POST['cpp']=="not required"){
	$cpp=0;
	}elseif($_POST['cpp']=="Novice"){
	$cpp=1;
	}elseif($_POST['cpp']=="Intermediate"){
	$cpp=2;
	}elseif($_POST['cpp']=="High"){
	$cpp=3;
	}elseif($_POST['cpp']=="Expert"){
	$cpp=4;
	}
		
	if($_POST['oc']=="not required"){
	$oc=0;
	}elseif($_POST['oc']=="Novice"){
	$oc=1;
	}elseif($_POST['oc']=="Intermediate"){
	$oc=2;
	}elseif($_POST['oc']=="High"){
	$oc=3;
	}elseif($_POST['oc']=="Expert"){
	$oc=4;
	}

	if($_POST['db']=="not required"){
	$db=0;
	}elseif($_POST['db']=="Novice"){
	$db=1;
	}elseif($_POST['db']=="Intermediate"){
	$db=2;
	}elseif($_POST['db']=="High"){
	$db=3;
	}elseif($_POST['db']=="Expert"){
	$db=4;
	}

	if($_POST['u3']=="not required"){
	$u3=0;
	}elseif($_POST['u3']=="Novice"){
	$u3=1;
	}elseif($_POST['u3']=="Intermediate"){
	$u3=2;
	}elseif($_POST['u3']=="High"){
	$u3=3;
	}elseif($_POST['u3']=="Expert"){
	$u3=4;
	}
	
	if($_POST['ui']=="not required"){
	$ui=0;
	}elseif($_POST['ui']=="Novice"){
	$ui=1;
	}elseif($_POST['ui']=="Intermediate"){
	$ui=2;
	}elseif($_POST['ui']=="High"){
	$ui=3;
	}elseif($_POST['ui']=="Expert"){
	$ui=4;
	}

	if($_POST['se']=="not required"){
	$se=0;
	}elseif($_POST['se']=="Novice"){
	$se=1;
	}elseif($_POST['se']=="Intermediate"){
	$se=2;
	}elseif($_POST['se']=="High"){
	$se=3;
	}elseif($_POST['se']=="Expert"){
	$se=4;
	}
			
	/*$hc=$_POST['hc'];
	$js=$_POST['js'];
	$php=$_POST['php'];
	$java=$_POST['java'];
	$c=$_POST['c'];
	$cpp=$_POST['cpp'];
	$oc=$_POST['oc'];
	$db=$_POST['db'];
	$u3=$_POST['u3'];
	$ui=$_POST['ui'];
	$se=$_POST['se'];*/
	
	$sql_id = "SELECT pro_title FROM project";
	$res_id = mysqli_query($CON, $sql_id);
	IF(mysqli_num_rows($res_id) > 0) {
		echo "<p style='margin-left: 35%;'>There is already a project with the typed title. Please try again</p>";
	}else {
	$sql="INSERT INTO project (pro_title,pro_leader,pro_email,pro_brief,pro_status,pro_hc,pro_js,pro_php,pro_java,pro_c,pro_cpp,pro_oc,pro_db,pro_u3,pro_ui,pro_se) VALUES ('$title','$leader','$email','$brief','$status','$hc','$js','$php','$java','$c','$cpp','$oc','$db','$u3','$ui','$se')";
        $b=mysqli_query($CON,$sql);
         if(!$b){
               echo "<p>Failed to create a project</p>";
	          }else{
                if(mysqli_affected_rows($CON)>0){
                   echo "<p>Project successfully created</p>";
                    //echo "<p><a href='PROJECTLIST.PHP'>Back to project list</a></p>";
                }else{
                    return "<p>not affected rows</p>";
                }

            }
	}
        mysqli_close($CON);
?>

</div>

<hr>
<div class="Footer">

	<h4>© Copyright Deakin University & Group 29 2018</h4>

</div>

</body>

</html>
