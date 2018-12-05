<?php
 	$PageTitle = "Home";
	require "HEADER_STUDENT.PHP";
?>
<div id="contents">
  <h2>Welcome, <?= $student_firstname. ' '?></h2>

  <p>This site aims to provide staff and students with a platform to view and request access to upcoming projects.
    Through this platform, staff and teachers may upload projects for students, including details of the skills sets and
    numbers required for the job. Students who register can then complete a quick survey to determine their levels or proficency
    in certain areas such as IT and communication. Corral takes this information, and provides Teachers with a list of suitable
    candidates for the positions available.</p>
  <p>The purpose of the skills survey is to gauge the potential talent of each student and match
  	accordingly under the criteria for specific projects. As it currently stands, placing members into well-rounded
  	teams is a slow and tedious process. With Corral, the procedure is automated which enables supervisors to quickly organise
    people into groups.</p>
  <p>When you are ready to undertake the survey, simple select the survey tab above and fill in the details. Once complete,
    you can log out of the site and your supervisor will handle the rest.</p>
  <p>For more information, please click <a href="../PAGES/STUDENTABOUTUS">here</a></p>
</div>

<hr>

<?php require "FOOTER_STUDENT.PHP"; ?>
