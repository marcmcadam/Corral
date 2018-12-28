<?php
 	$PageTitle = "Home";
	require "header_staff.php";
?>
<div>
  <h2>Welcome <?= $sta_FirstName. ' '.$sta_LastName?></h2>
  <p>Corral is an application that provides staff with the ability to match students to projects with <br>
    no manual assigning required. Once a project and desired skills have been set, a student list <br>
    is imported before Corral automatically assigns the best candidates for the project.

  <p>To create or view projects in Corral, please select a link below:</p>
  <form action="project"><button class="inputButton">Create A Project</button></form>
  <form action="projectlist"><button class="inputButton">All Projects</button></form>
  <form action="projectsearch"><button class="inputButton">Search Projects</button></form>
</div>
<?php require "footer.php"; ?>
