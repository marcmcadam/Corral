<?php
session_start();

if ( $_SESSION['STUDENT_ID'] != 1) {
	$_SESSION['message'] = "You mus log in before viewing this page";
	header("location: ../ACCESS/error");
	}
	else {
	$id = $_SESSION['STUDENT_ID'];
	$student_firstname = $_SESSION['STUDENT_FIRSTNAME'];
	$student_lastname = $_SESSION['STUDENT_LASTNAME'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>

<meta charset="utf-8">

<title>Project List</title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">
<style>
/*Picture wont float right?*/

#stockpic

{

    float:right;

}

</style>

</head>

<body>
<div class="Header">

</div>

<div class="navbar">
	<a href="../PAGES/STUDENTHOME">Home</a>
	<a href="../SURVEY/STUDENTSURVEY">Survey</a>
	<a href="../PAGES/STUDENTCONTACT">Contacts</a>
	<a href="../PAGES/STUDENTABOUTUS">About Us</a>
	<a href="../Access/LOGOUT">Logout</a>
</div>

<p style="font-size:32px"><strong>Hi <?= $student_firstname. ' '?></strong></p>

			<p>
				When you are ready, select the dropdown and choose the option most relevant to your skills. Upon reaching the 'Skill' section, simply enter in a skill
				that you believe you are proficient in (networking, for example) and give it a rating. When you reach the lower sections, add some comments to help us match you
				to a group that would benefit from the skills you possess.
			</p>
			<br>

			<FORM ACTION="../SURVEY/SURVEYSUBMIT" METHOD="POST">
				<p>
				<label for="STUDENT_ID">Student ID </label>
				<input type="text" name="STUDENT_ID" id="STUDENT_ID" />
				</p>

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
			<label for="ROLES">3) Project role, choose roles you think best align with your skills</label>
			<p>Programmer (General)
			<select name="ROLE1" id="ROLE1">
			<option selected disabled hidden style='display: none' value="">Select</option>
			<option value="Expert skill">Expert skill</option>
			<option value="High skill">High skill</option>
			<option value="Intermediate skill">Intermediate skill</option>
			<option value="Novice skill">Novice skill</option>
			</select>
			</p>
			<p>UX/UI Designer
			<select name="ROLE2" id="ROLE2">
			<option selected disabled hidden style='display: none' value="">Select</option>
			<option value="Expert skill">Expert skill</option>
			<option value="High skill">High skill</option>
			<option value="Intermediate skill">Intermediate skill</option>
			<option value="Novice skill">Novice skill</option>
			</select>
			</p>
			<p>Security Specialist
			<select name="ROLE3" id="ROLE3">
			<option selected disabled hidden style='display: none' value=''>Select</option>
			<option value="Expert skill">Expert skill</option>
			<option value="High skill">High skill</option>
			<option value="Intermediate skill">Intermediate skill</option>
			<option value="Novice skill">Novice skill</option>
			</select>
			</p>
			<p>Database Developer:
	      <select name="ROLE4" id="ROLE4">
	      	<option selected disabled hidden style='display: none' value="">Select</option>
	        <option value="Expert skill">Expert skill</option>
	        <option value="High skill">High skill</option>
	        <option value="Intermediate skill">Intermediate skill</option>
	        <option value="Novice skill">Novice skill</option>
	      </select>
	    </p>
	    <p>Web Developer:
	      <select name="ROLE5" id="ROLE5">
	      	<option selected disabled hidden style='display: none' value="">Select</option>
	        <option value="Expert skill">Expert skill</option>
	        <option value="High skill">High skill</option>
	        <option value="Intermediate skill">Intermediate skill</option>
	        <option value="Novice skill">Novice skill</option>
	      </select>
	    </p>
	    <p>Cloud Service Developer:
	      <select name="ROLE6" id="ROLE6">
	      	<option selected disabled hidden style='display: none' value="">Select</option>
	        <option value="Expert skill">Expert skill</option>
	        <option value="High skill">High skill</option>
	        <option value="Intermediate skill">Intermediate skill</option>
	        <option value="Novice skill">Novice skill</option>
	      </select>
	    </p>
	    <p>App Developer (Mobile):
	      <select name="ROLE7" id="ROLE7">
	        <option selected disabled hidden style='display: none' value="">Select</option>
	        <option value="Expert skill">Expert skill</option>
	        <option value="High skill">High skill</option>
	        <option value="Intermediate skill">Intermediate skill</option>
	        <option value="Novice skill">Novice skill</option>
	      </select>
	    </p>
	    <p>Network Engineer:
	      <select name="ROLE8" id="ROLE8">
	        <option selected disabled hidden style='display: none' value="">Select</option>
	        <option value="Expert skill">Expert skill</option>
	        <option value="High skill">High skill</option>
	        <option value="Intermediate skill">Intermediate skill</option>
	        <option value="Novice skill">Novice skill</option>
	      </select>
	    </p>
	    <p>VR/Game Developer (Programming):
	      <select name="ROLE9" id="ROLE9">
	        <option selected disabled hidden style='display: none' value="">Select</option>
	        <option value="Expert skill">Expert skill</option>
	        <option value="High skill">High skill</option>
	        <option value="Intermediate skill">Intermediate skill</option>
	        <option value="Novice skill">Novice skill</option>
	      </select>
	    </p>
	    <p>3D Artist/Animator:
	      <select name="ROLE10" id="ROLE10">
	        <option selected disabled hidden style='display: none' value="">Select</option>
	        <option value="Expert skill">Expert skill</option>
	        <option value="High skill">High skill</option>
	        <option value="Intermediate skill">Intermediate skill</option>
	        <option value="Novice skill">Novice skill</option>
	      </select>
	    </p>
	    <p>Technical Artist:
	      <select name="ROLE11" id="ROLE11">
	        <option selected disabled hidden style='display: none' value="">Select</option>
	        <option value="Expert skill">Expert skill</option>
	        <option value="High skill">High skill</option>
	        <option value="Intermediate skill">Intermediate skill</option>
	        <option value="Novice skill">Novice skill</option>
	      </select>
	    </p>
	    <p>Project Manager (Requires Technical Skill):
	      <select name="ROLE12" id="ROLE12">
	        <option selected disabled hidden style='display: none' value="">Select</option>
	        <option value="Expert skill">Expert skill</option>
	        <option value="High skill">High skill</option>
	        <option value="Intermediate skill">Intermediate skill</option>
	        <option value="Novice skill">Novice skill</option>
	      </select>
	    </p>
	    <p>Interactive Media Developer:
	      <select name="ROLE13" id="ROLE13">
	        <option selected disabled hidden style='display: none' value="">Select</option
	        ><option value="Expert skill">Expert skill</option>
	        <option value="High skill">High skill</option>
	        <option value="Intermediate skill">Intermediate skill</option>
	        <option value="Novice skill">Novice skill</option>
	      </select>
	    </p>
	    <p>Business Analyst:
	      <select name="ROLE14" id="ROLE14">
	        <option selected disabled hidden style='display: none' value="">Select</option
	        ><option value="Expert skill">Expert skill</option>
	        <option value="High skill">High skill</option>
	        <option value="Intermediate skill">Intermediate skill</option>
	        <option value="Novice skill">Novice skill</option>
	      </select>
	    </p>

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
			<p>
			<label for="TECHNICAL_SKILLS4">Tech Skill 4: </label>
			<input type="text" name="TECHNICAL_SKILLS4" id="TECHNICAL_SKILLS4" />
			</p>
			<p>
			<label for="TECHNICAL_SKILLS5">Tech Skill 5: </label>
			<input type="text" name="TECHNICAL_SKILLS5" id="TECHNICAL_SKILLS5" />
			</p>
			<p>
			<label for="TECHNICAL_SKILLS6">Tech Skill 6: </label>
			<input type="text" name="TECHNICAL_SKILLS6" id="TECHNICAL_SKILLS6" />
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

			<p>Technical Skill 4 Rating
			<select name="TECHNICAL_RATING4" id="TECHNICAL_RATING4">
			<option selected="selected" disabled="disabled" hidden="hidden" style='display: none' value="">Select</option>
			<option value="Expert skill">Expert skill</option>
			<option value="High skill">High skill</option>
			<option value="Intermediate skill">Intermediate skill</option>
			<option value="Novice skill">Novice skill</option>
			</select>
			</p>

			<p>Technical Skill 5 Rating
			<select name="TECHNICAL_RATING5" id="TECHNICAL_RATING5">
			<option selected="selected" disabled="disabled" hidden="hidden" style='display: none' value="">Select</option>
			<option value="Expert skill">Expert skill</option>
			<option value="High skill">High skill</option>
			<option value="Intermediate skill">Intermediate skill</option>
			<option value="Novice skill">Novice skill</option>
			</select>
			</p>

			<p>Technical Skill 6 Rating
			<select name="TECHNICAL_RATING6" id="TECHNICAL_RATING6">
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
			<p>
			<label for="SOFT_SKILLS4">Soft Skill 4: </label>
			<input type="text" name="SOFT_SKILLS4" id="SOFT_SKILLS4" />
			</p>
			<p>
			<label for="SOFT_SKILLS5">Soft Skill 5: </label>
			<input type="text" name="SOFT_SKILLS5" id="SOFT_SKILLS5" />
			</p>
			<p>
			<label for="SOFT_SKILLS6">Soft Skill 6: </label>
			<input type="text" name="SOFT_SKILLS6" id="SOFT_SKILLS6" />
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
			<p>Soft Skill 4 Rating
			<select name="SOFT_RATING4" id="SOFT_RATING4">
			<option selected="selected" disabled="disabled" hidden="hidden" style='display: none' value="">Select</option>
			<option value="Expert skill">Expert skill</option>
			<option value="High skill">High skill</option>
			<option value="Intermediate skill">Intermediate skill</option>
			<option value="Novice skill">Novice skill</option>
			</select>
			</p>
			<p>Soft Skill 5 Rating
			<select name="SOFT_RATING5" id="SOFT_RATING5">
			<option selected="selected" disabled="disabled" hidden="hidden" style='display: none' value="">Select</option>
			<option value="Expert skill">Expert skill</option>
			<option value="High skill">High skill</option>
			<option value="Intermediate skill">Intermediate skill</option>
			<option value="Novice skill">Novice skill</option>
			</select>
			</p>
			<p>Soft Skill 6 Rating
			<select name="SOFT_RATING6" id="SOFT_RATING6">
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
	<h4>© Copyright Deakin University & Group 29 2018</h4>
</div>
</body>
</html>
