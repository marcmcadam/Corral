<?php
 	$PageTitle = "Student Profile";
	require "HEADER_STUDENT.PHP";
?>


<h2>Welcome, <?= $student_firstname. ' '?></h2>
<p>The purpose of the skills survey is to gauge the potential talent of each student and match
	accordingly under the criteria for specific projects. As it currently stands, placing members into well-rounded
	teams is a slow and tedious process. With Corral, the procedure is automated which enables supervisors to quickly organise
	 people into groups.
	<br><br>

	When you are ready to undertake the survey, simple select the survey tab above and fill in the details. Once complete,
	you can log out of the site and your supervisor will handle the rest.</p>

<?php require "FOOTER_STUDENT.PHP"; ?>
