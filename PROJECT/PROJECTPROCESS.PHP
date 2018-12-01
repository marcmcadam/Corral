<?php
 	$PageTitle = "Project Process";
	require "../PAGES/HEADER_STAFF.PHP";
?>

<div id="contents">

  <h2>Project Added</h2>
	<?php
 require("../DATABASE/CONNECTDB.php");

	    $number=$_REQUEST['PROJECT_NUM'];
			$title=$_POST['PROJECT_TITLE'];
			$leader=$_POST['PROJECT_LEADER'];
			$email=$_POST['PROJECT_EMAIL'];
	    $brief=$_POST['PROJECT_BRIEF'];
	    $status=$_POST['PROJECT_STATUS'];

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

	    if(empty($brief)){
	        echo "<p>you need to input project brief</p>";
	    }else{



	        $sql="UPDATE project SET pro_title='$title', pro_leader='$leader', pro_email='$email', pro_brief='$brief', pro_status='$status', pro_hc='$hc', pro_js='$js', pro_php='$php', pro_java='$java', pro_c='$c', pro_cpp='$cpp', pro_oc='$oc', pro_db='$db', pro_u3='$u3', pro_ui='$ui', pro_se='$se' WHERE pro_num=$number";

	        $b=mysqli_query($CON,$sql);

	         if(!$b){
	                echo "<p>Failed to update project</p>";
	          }else{
	                if(mysqli_affected_rows($CON)>0){
	                    echo "<p>Project successfully updated</p>";
	                    echo "<p><a href='PROJECTLIST.PHP'>Back to project list</a></p>";
	                }else{
	                    return "<p>not affected rows</p>";
	                }
	            }

	        mysqli_close($CON);
	    }

	?>


<hr>

<?php require "../PAGES/FOOTER_STAFF.PHP"; ?>
