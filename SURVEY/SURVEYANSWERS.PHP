<?php
session_start();

if ( $_SESSION['STUDENT_ID'] != 1) {
	$_SESSION['message'] = "You mus log in before viewing this page";
	header("location: error.php");
	}
	else {
	$id = $_SESSION['STUDENT_ID'];
	$student_firstname = $_SESSION['STUDENT_FIRSTNAME'];
	$student_lastname = $_SESSION['STUDENT_LASTNAME'];
	}
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="../styles/stylesheet.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>

<html>

<body>

<div class="Header">
	<h1>Corral Project</h1>
</div>
<div class="navbar">
	<a href="../PAGES/STUDENTHOME.php">Home</a>
	<a href="../SURVEY/SURVEYANSWERS.php">Survey</a>
	<a href="../PAGES/STUDENTCONTACT.php">Contacts</a>
	<a href="../PAGES/STUDENTABOUTUS.php">About Us</a>
	<a href="../Access/LOGOUT.php">Logout</a>
</div>

			<h1>Student Survey</h1>
		  <br>
			<p>
				When you are ready, select the dropdown and choose the option most relevant to your skills. Upon reaching the 'Skill Rating' section, simply enter in a skill
				that you believe you are proficient in (networking, for example) and give it a rating. When you reach the lower sections, add some comments to help us match you
				to a group that would benefit from the skills you possess.
			</p>
			<br>

			<FORM ACTION="../SURVERY/SURVEYSUBMIT.PHP" METHOD="POST">
			<table>
			<p>
			<label for="LOCATION">1) Campus Location: </label>
			<p>
			<select name="LOCATION" id="LOCATION">
			<option selected disabled hidden style='display: none' value="">Select</option>
			<option value="Burwood">Burwood</option>
			<option value="Geelong">Geelong</option>
			<option value="Cloud, but can travel in Deakin Campus">Cloud, but can travel in Deakin Campus</option>
			<option value="Cloud, located in Australia but can't easily travel to Deakin campus ">Cloud, located in Australia but can't easily travel to Deakin campus </option>
			<option value="Cloud, located outside Australia">Cloud, located outside Australia</option>
			</select>
			</p></p>

			<p>
			<label for="CURRENT_COURSE">2) Please choose the course/major you are enrolled in:</label>
			<p>
			<select name="CURRENT_COURSE" id="CURRENT_COURSE">
			<option selected disabled hidden style='display: none' value="">Select</option>
			<option value="Bachelor of Computer Science (Cloud Computing)">Bachelor of Computer Science (Cloud Computing)</option>
			<option value="Bachelor of Computer Science (Cognitive Science)">Bachelor of Computer Science (Cognitive Science)</option>
			<option value="Bachelor of Computer Science (Data Science)">Bachelor of Computer Science (Data Science)</option>
			<option value="Bachelor of Cyber Security">Bachelor of Cyber Security</option>
			<option value="Bachelor of Game Design and Development">Bachelor of Game Design and Development</option>
			<option value="Bachelor of IT (Cloud Commuting)">Bachelor of IT (Cloud Commuting)</option>
			<option value="Bachelor of IT (Game Development)">Bachelor of IT (Game Development)</option>
			<option value="Bachelor of IT (Interactive Media Design)">Bachelor of IT (Interactive Media Design)</option>
			<option value="Bachelor of IT (Mobile &amp; Apps Design)">Bachelor of IT (Mobile &amp; Apps Design)</option>
			<option value="Bachelor of IT (Programming)">Bachelor of IT (Programming)</option>
			<option value="Bachelor of IT (Security)">Bachelor of IT (Security)</option>
			<option value="Bachelor of IT (Virtual and Argument Reality)">Bachelor of IT (Virtual and Argument Reality)</option>
			</select>
			</p>
			</p>

			<p>
			<label for="TECHNICAL_SKILLS">3) Project role, choose roles you think best align with your skills</label>
			<p>Programmer (General)
			<select name="TECHNICAL_SKILLS1" id="TECHNICAL_SKILLS1">
			<option selected disabled hidden style='display: none' value="">Select</option>
			<option value="Expert skill">Expert skill</option>
			<option value="High skill">High skill</option>
			<option value="Intermediate skill">Intermediate skill</option>
			<option value="Novice skill">Novice skill</option>
			</select>
			</p>
			<p>UX/UI Designer
			<select name="TECHNICAL_SKILLS2" id="TECHNICAL_SKILLS2">
			<option selected disabled hidden style='display: none' value="">Select</option>
			<option value="Expert skill">Expert skill</option>
			<option value="High skill">High skill</option>
			<option value="Intermediate skill">Intermediate skill</option>
			<option value="Novice skill">Novice skill</option>
			</select>
			</p>
			<p>Security Specialist
			<select name="TECHNICAL_SKILLS3" id="TECHNICAL_SKILLS3">
			<option selected disabled hidden style='display: none' value=''>Select</option>
			<option value="Expert skill">Expert skill</option>
			<option value="High skill">High skill</option>
			<option value="Intermediate skill">Intermediate skill</option>
			<option value="Novice skill">Novice skill</option>
			</select>
			</p>
			</select>
			</p>


			<p>
			<label for="TECHNICAL_SKILLS">4) Technical Skill: list at least three technical skills that you posses.</label>
			<p>
			<label for="TECHNICAL_SKILLS1">Tech Skill 1: </label>
			<input type="text" name="TECHNICAL_SKILLS1" id="TECHNICAL_SKILLS1" />
			</p>
			<p>
			<label for="TECHNICAL_SKILLS2">Tech Skill 2: </label>
			<input type="text" name="TECHNICAL_SKILLS2" id="TECHNICAL_SKILLS2" />
			</p>
			<p>
			<label for="TECHNICAL_SKILLS3">Tech Skill 3: </label>
			<input type="text" name="TECHNICAL_SKILLS3" id="TECHNICAL_SKILLS3" />
			</p>
			</p>


			<p>
			<label for="TECHNICAL_RATING">5) Technical Skill Proficiency: rate the proficiency of each technical skills in the previous question.</LABEL>
			<p>
			<p>Technical Skill 1 Rating
			<select name="TECHNICAL_RATING1" id="TECHNICAL_RATING1">
			<option selected disabled hidden style='display: none' value="">Select</option>
			<option value="Expert skill">Expert skill</option>
			<option value="High skill">High skill</option>
			<option value="Intermediate skill">Intermediate skill</option>
			<option value="Novice skill">Novice skill</option>
			</select>
			</p></p>

			<p>Technical Skill 2 Rating
			<select name="TECHNICAL_RATING2" id="TECHNICAL_RATING2">
			<option selected="selected" disabled="disabled" hidden="hidden" style='display: none' value="">Select</option>
			<option value="Expert skill">Expert skill</option>
			<option value="High skill">High skill</option>
			<option value="Intermediate skill">Intermediate skill</option>
			<option value="Novice skill">Novice skill</option>
			</select>
			</p>

			<p>Technical Skill 3 Rating
			<select name="TECHNICAL_RATING3" id="TECHNICAL_RATING3">
			<option selected="selected" disabled="disabled" hidden="hidden" style='display: none' value="">Select</option>
			<option value="Expert skill">Expert skill</option>
			<option value="High skill">High skill</option>
			<option value="Intermediate skill">Intermediate skill</option>
			<option value="Novice skill">Novice skill</option>
			</select>
			</p>

			<p>
			<label for="SOFT_SKILLS">6) SOFT Skill: list at least three SOFT skills that you posses.</label>
			<p>
			<label for="SOFT_SKILLS1">Soft Skill 1: </label>
			<input type="text" name="SOFT_SKILLS1" id="SOFT_SKILLS1" />
			</p>
			<p>
			<label for="SOFT_SKILLS2">Soft Skill 2: </label>
			<input type="text" name="SOFT_SKILLS2" id="SOFT_SKILLS2" />
			</p>
			<p>
			<label for="SOFT_SKILLS3">Soft Skill 3: </label>
			<input type="text" name="SOFT_SKILLS3" id="SOFT_SKILLS3" />
			</p>
			</p>

			<p>
			<label for="SOFT_RATING">7) SOFT Skill Proficiency: rate the proficiency of each SOFT skills in the previous question.</LABEL>
			<p>
			<p>Soft Skill 1 Rating
			<select name="SOFT_RATING1" id="SOFT_RATING1">
			<option selected disabled hidden style='display: none' value="">Select</option>
			<option value="Expert skill">Expert skill</option>
			<option value="High skill">High skill</option>
			<option value="Intermediate skill">Intermediate skill</option>
			<option value="Novice skill">Novice skill</option>
			</select>
			</p></p>

			<p>Soft Skill 2 Rating
			<select name="SOFT_RATING2" id="SOFT_RATING2">
			<option selected="selected" disabled="disabled" hidden="hidden" style='display: none' value="">Select</option>
			<option value="Expert skill">Expert skill</option>
			<option value="High skill">High skill</option>
			<option value="Intermediate skill">Intermediate skill</option>
			<option value="Novice skill">Novice skill</option>
			</select>
			</p>
			<p>Soft Skill 3 Rating
			<select name="SOFT_RATING3" id="SOFT_RATING3">
			<option selected="selected" disabled="disabled" hidden="hidden" style='display: none' value="">Select</option>
			<option value="Expert skill">Expert skill</option>
			<option value="High skill">High skill</option>
			<option value="Intermediate skill">Intermediate skill</option>
			<option value="Novice skill">Novice skill</option>
			</select>
			</p>

			<p>
				<label for="PROJECT_PREFERENCE">8) List the projects you would prefer to work in order of preference</label>
			</p>
		    <p>Project Title 1:
		      <label for="PROJECT_PREFERENCE1"></label>
		      <input type="text" name="PROJECT_PREFERENCE1" id="PROJECT_PREFERENCE1" />
		    </p>
				<p>Project Title 2:
					<label for="PROJECT_PREFERENCE2"></label>
					<input type="text" name="PROJECT_PREFERENCE2" id="PROJECT_PREFERENCE2" />
				</p>
				<p>Project Title 3:
					<label for="PROJECT_PREFERENCE3"></label>
					<input type="text" name="PROJECT_PREFERENCE3" id="PROJECT_PREFERENCE3" />
				</p>

				<p>
			    <label for="STUDENT_PERMISSION">9) Permission to use survey data internally: for work and research development purpose.</label>
					<p>
			    <select name="STUDENT_PERMISSION" id="STUDENT_PERMISSION">
			        	<option selected="selected" disabled="disabled" hidden="hidden" style='display: none' value="">Select</option>
			      <option value="Yes">I give permission for this</option>
			      <option value="No">I do not give permission for this</option>
			    </select>
				</p></p>


		  <p>
				<label for="STUDENT_ASPIRATION">10) Aspiration: tell us a few words what do you want to achieve in this unit and how you aim to contribute.</label>
		  </p>
		    <p><textarea name="STUDENT_ASPIRATION" cols="100" rows="5" id="STUDENT_ASPIRATION"></textarea></p>

		    <p>
		      <label for="STUDENT_COMMENT">Additional Comments</label>
				</p>
							  <p>If you have anything else to add that we might find usful or think we should know about, please add it below</p>
		    <p><textarea name="STUDENT_COMMENT" cols="100" rows="5" id="STUDENT_COMMENT"></textarea>
		    </p>

	<input type="submit" name="Submit" value="Submit" style="height:40px;width:100px;font-size:15px;font-weight:bold;">
	<input type="reset" value="Clear Form" style="height:40px;width:100px;font-size:15px;font-weight:bold;"><br><br>

</form>

<div class="Footer">
	<h4>This is copyrighted by Deakin and the project group 29</h4>
</div>
</body>
</html>
