<?php
 	$PageTitle = "Home";
	require "header_staff.php";
?>
<div>
  <h2>Welcome <?= $sta_FirstName. ' '.$sta_LastName?></h2>
  <p>Corral is an application that provides staff with the ability to match students to projects with <br>
    no manual assigning required. Once a project and desired skills have been set, a student list <br>
    is imported before Corral automatically assigns the best candidates for the project.
  <?php /*
  <p>To create or view projects in Corral, please select a link below:</p>
  <table align='center'><tr><td>
      <form action="project">&nbsp;<button class="inputButton">Create A Project</button>&nbsp;</form>
  </td><td>
      <form action="projectlist">&nbsp;<button class="inputButton">All Projects</button>&nbsp;</form>
  </td><td>
      <form action="projectsearch">&nbsp;<button class="inputButton">Search Projects</button>&nbsp;</form>
  </td></tr></table>
  */ ?>
</div>
<?php require "footer.php"; ?>
