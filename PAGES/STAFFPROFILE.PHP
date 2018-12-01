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
