<?php
 	$PageTitle = "Home";
	require "header_staff.php";
?>
<div>
  <h2>Welcome <?= $staff_firstname. ' '.$staff_lastname?></h2>
  <p>Corral is an application that provides staff with the ability to match students to projects with <br>
    no manual assigning required. Once a project and desired skills have been set, a student list <br>
    is imported before Corral automatically assigns the best candidates for the project.

  <p>To create or view projects in Corral, please select a link below:</p>
  <p><a href="addproject.php">Create A Project</a></p>
  <p><a href="projectlist.php">All Projects   </a></p>
  <p><a href="projectsearch.php">Search Projects</a></p>
</div>
<?php require "footer.php"; ?>
