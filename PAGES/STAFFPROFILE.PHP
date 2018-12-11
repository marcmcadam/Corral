<!DOCTYPE html>
<html>
<head>
	<style>
	/* Center the loader */
	#loader {
			margin: auto;
			top: 50%;
			width: 516px;
			height: 335px;
		background-image: url("logo.png");
	}

	/* Add animation to "page content" */
	.animate-bottom {
	  position: relative;
	  -webkit-animation-name: animatebottom;
	  -webkit-animation-duration: 1s;
	  animation-name: animatebottom;
	  animation-duration: 1s
	}

	@-webkit-keyframes animatebottom {
	  from { bottom:-100px; opacity:0 }
	  to { bottom:0px; opacity:1 }
	}

	@keyframes animatebottom {
	  from{ bottom:-100px; opacity:0 }
	  to{ bottom:0; opacity:1 }
	}

	#myDiv {
	  display: none;
	  text-align: center;
	}

	</style>
</head>

<body onload="myFunction()" style="margin:0;">
<div id="loader" ></div>

<div style="display:none;" id="myDiv" class="animate-bottom">
	<?php
	$PageTitle = "Staff Profile";
	require "HEADER_STAFF.PHP";
?>
<h2>Welcome <?= $staff_firstname. ' '.$staff_lastname?></h2>
<p>From here you can look at the project form, past projects and results for project group pairings</p>

<p>The following links below will get you to those pages:</p>
<p><a href="../PROJECT/ADDPROJECT">Create A Project</a></p>
<p><a href="../PROJECT/PROJECTLIST">All Projects</a></p>
<p><a href="../PROJECT/PROJECTSEARCH">Search Projects</a></p>
<p>If you wish to log out, <a href="../PAGES/STAFFLOGOUT">click here</a></p>
<?php require "FOOTER_STAFF.PHP"; ?>
</div>
<script>
var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 3000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>
</body>
</html>
