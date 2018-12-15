<?php
 	$PageTitle = "Home";
	require "HEADER_STUDENT.PHP";
?>
<div>
  <h2>Welcome, <?= $student_firstname. ' '?></h2>

  <p>The purpose of the Corral survey is to match each student's skills to projects that would <br>
    benefit from their skillset. Assigning people to teams is a slow and tedious process but with Corral, <br>
    the procedure is automated which enables supervisors to quickly organise people into groups.</p>
  <p>When you are ready to undertake the survey, simply select the survey tab above and fill in the details. <br>
    Once complete, you can log out of the site and your supervisor will handle the rest.</p>
</div>


<?php require "FOOTER_STUDENT.PHP"; ?>
