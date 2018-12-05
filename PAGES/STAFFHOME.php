<?php
 	$PageTitle = "Home";
	require "HEADER_STAFF.PHP";
?>
<div id="contents">
  <h2>Welcome <?= $staff_firstname. ' '.$staff_lastname?></h2>
  <p>This site aims to provide staff and students with a platform to view and request access to upcoming
    projects. Through this platform, staff and teachers may upload projects for students, including details
    of the skills sets and numbers required for the job. Students who register can then complete a quick
    survey to determine their levels or proficency in certain areas such as IT and communication. The Corral
    Project takes this information, and provides Teachers with a list of suitable candidates for the
    positions available.</p>
  <p>From here you can look at the project form, past projects and results for project group pairings</p>
  <p>The following links below will get you to those pages:</p>
  <p><a href="../PROJECT/ADDPROJECT">Create A Project</a></p>
  <p><a href="../PROJECT/PROJECTLIST">All Projects</a></p>
  <p><a href="../PROJECT/PROJECTSEARCH">Search Projects</a></p>
  <p>If you wish to log out, <a href="../PAGES/STAFFLOGOUT">click here</a></p>
  <p>For more information, please click <a href="../PAGES/STAFFABOUTUS">here</a></p>
</div>
<hr>
<?php require "FOOTER_STAFF.PHP"; ?>
