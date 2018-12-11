<?php
 	$PageTitle = "Home";
	require "HEADER_STAFF.PHP";
?>
<div id="contents">
  <h2>Welcome <?= $staff_firstname. ' '.$staff_lastname?></h2>
  <p>Corral is an application that provides staff with the ability to match students to projects with <br>
    no manual assigning required. Once a project and desired skills have been set, a student list <br>
    is imported before Corral automatically assigns the best candidates for the project.

  <p>To create or view projects in Corral, please select a link below:</p>
  <p><a href="../PROJECT/ADDPROJECT">Create A Project</a></p>
  <p><a href="../PROJECT/PROJECTLIST">All Projects</a></p>
  <p><a href="../PROJECT/PROJECTSEARCH">Search Projects</a></p>
</div>
<hr>
<?php require "FOOTER_STAFF.PHP"; ?>
