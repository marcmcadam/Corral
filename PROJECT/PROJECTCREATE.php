<?php
	$PageTitle = "Create Project";
	require "../PAGES/HEADER_STAFF.PHP";
?>
<div id="contents">

  <h2>Project Added</h2>
	<?php
 require("../DATABASE/CONNECTDB.php");


			$title=$_POST['PROJECT_TITLE'];
			$leader=$_POST['PROJECT_LEADER'];
			$email=$_POST['PROJECT_EMAIL'];
			$brief=$_POST['PROJECT_BRIEF'];
			$status=$_POST['PROJECT_STATUS'];





	    if(empty($brief)){
	        echo "<p>you need to input project brief</p>";
	    }else{



	        $sql="INSERT INTO PROJECT (PROJECT_TITLE,PROJECT_LEADER,PROJECT_EMAIL,PROJECT_BRIEF,PROJECT_STATUS) VALUES ('$title','$leader','$email','$brief','$status')";

	        $b=mysqli_query($CON,$sql);

	         if(!$b){
	                echo "<p>Failed to create a project</p>";
	          }else{
	                if(mysqli_affected_rows($CON)>0){
	                    echo "<p>Project successfully created</p>";
	                    echo "<p><a href='../PROJECT/PROJECTLIST.PHP'>Back to project list</a></p>";
	                }else{
	                    return "<p>not affected rows</p>";
	                }
	            }

	        mysqli_close($CON);
	    }

	?>


<hr>

<?php require "../PAGES/FOOTER_STAFF.PHP"; ?>
