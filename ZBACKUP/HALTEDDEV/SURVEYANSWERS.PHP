<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="../styles/styles.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>

<!doctype html>

<html>

<body>
<div class="Header">
	<h1>Corral Project</h1>
</div>

<div class="navbar">
	<a href="#Home">Home</a>
	<a href="SURVEYANSWERS.PHP">Survey</a>
	<a href="#Contacts">Contact</a>
	<a href="#About Us">About Us</a>
	<a href="#Logout">Logout</a>
</div>

	<h1>Student Survey</h1>

	<p>Instructions</p>

<FORM ACTION="SURVEYSUBMIT.PHP" METHOD="POST">
  <table>
	<p>
    <label for="LOCATION">1) Student Location: </label>
    <select name="LOCATION" id="LOCATION">
      <option selected disabled hidden style='display: none' value="">Location</option>
      <option value="Burwood">Burwood</option>
      <option value="Geelong">Geelong</option>
      <option value="Cloud, but can travel in Deakin Campus">Cloud, but can travel in Deakin Campus</option>
      <option value="Cloud, located in Australia but can't easily travel to Deakin campus ">Cloud, located in Australia but can't easily travel to Deakin campus </option>
      <option value="Cloud, located outside Australia">Cloud, located outside Australia</option>
    </select>
  </p>

	<p>
    <label for="CURRENT_COURSE">2) Current Course: please choose the course/major you are enrolled in:</label>
    <select name="CURRENT_COURSE" id="CURRENT_COURSE">
      <option selected disabled hidden style='display: none' value="">Course And Major</option>
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

 <br></br>

 <p>5) Project role, choose roles you think best align with your skills:</p>
 <blockquote>
	 <p>---------------------------------------------------------------------------</p>
	 <p>Programmer (General):
		 <label for="skill1"></label>
		 <select name="TECHNICAL_SKILLS1" id="TECHNICAL_SKILLS1">
			 <option selected disabled hidden style='display: none' value="">Choose one of the list Below</option>
			 <option value="Expert skill">Expert skill</option>
			 <option value="High skill">High skill</option>
			 <option value="Intermediate skill">Intermediate skill</option>
			 <option value="Novice skill">Novice skill</option>
		 </select>
	 </p>
	 <p>UX/UI Designer:
		 <select name="TECHNICAL_SKILLS2" id="TECHNICAL_SKILLS2">
			 <option selected disabled hidden style='display: none' value="">Choose one of the list Below</option>
			 <option value="Expert skill">Expert skill</option>
			 <option value="High skill">High skill</option>
			 <option value="Intermediate skill">Intermediate skill</option>
			 <option value="Novice skill">Novice skill</option>
		 </select>
	 </p>
	 <p>Security Specialist:
		 <select name="TECHNICAL_SKILLS3" id="TECHNICAL_SKILLS3">
		 <option selected disabled hidden style='display: none' value=''>Choose one of the list Below</option>
			 <option value="Expert skill">Expert skill</option>
			 <option value="High skill">High skill</option>
			 <option value="Intermediate skill">Intermediate skill</option>
			 <option value="Novice skill">Novice skill</option>
		 </select>
	 </p>
		 </select>
	 </p>




  Technical skills:<br>

    <span>Skill 1:&nbsp;</span><input type="text" name="TECHNICAL_SKILLS1"><br>
    <span>Skill 2:&nbsp;</span><input type="text" name="TECHNICAL_SKILLS2"><br>
    <span>Skill 3:&nbsp;</span><input type="text" name="TECHNICAL_SKILLS3"><br><br>


  Skills RATING:<br>

  <label><span>Skill 1:</span></label>
  <select name="TECHNICAL_RATING1">
  <option value="Novice"> Novice</option>
  <option value="Intermediate"> Intermediate</option>
  <option value="High"> High</option>
  <option value="Expert"> Expert</option></select>
  <BR></BR>

  <label><span>Skill 2:</span></label>
  <select name="TECHNICAL_RATING2">
  <option value="Novice"> Novice</option>
  <option value="Intermediate"> Intermediate</option>
  <option value="High"> High</option>
  <option value="Expert"> Expert</option></select>
  <BR></BR>

  <label><span>Skill 3:</span></label>
  <select name="TECHNICAL_RATING3">
  <option value="Novice"> Novice</option>
  <option value="Intermediate"> Intermediate</option>
  <option value="High"> High</option>
  <option value="Expert"> Expert</option></select></br>
  <BR></BR>


  SOFT skills:<br>

    <span>Skill 1:&nbsp;</span><input type="text" name="SOFT_SKILLS1"><br>
    <span>Skill 2:&nbsp;</span><input type="text" name="SOFT_SKILLS2"><br>
    <span>Skill 3:&nbsp;</span><input type="text" name="SOFT_SKILLS3"><br><br>


  Skills RATING:<br>

  <label><span>Skill 1:</span></label>
  <select name="SOFT_RATING1">
  <option value="Novice"> Novice</option>
  <option value="Intermediate"> Intermediate</option>
  <option value="High"> High</option>
  <option value="Expert"> Expert</option></select>
  <BR></BR>

  <label><span>Skill 2:</span></label>
  <select name="SOFT_RATING2">
  <option value="Novice"> Novice</option>
  <option value="Intermediate"> Intermediate</option>
  <option value="High"> High</option>
  <option value="Expert"> Expert</option></select>
  <BR></BR>

  <label><span>Skill 3:</span></label>
  <select name="SOFT_RATING3">
  <option value="Novice"> Novice</option>
  <option value="Intermediate"> Intermediate</option>
  <option value="High"> High</option>
  <option value="Expert"> Expert</option></select>
  <BR></BR>

	<input type="submit" name="Submit" value="Submit" style="height:40px;width:100px;font-size:15px;font-weight:bold;">
	<input type="reset" value="Clear Form" style="height:40px;width:100px;font-size:15px;font-weight:bold;"><br><br>

</form>

<div class="Footer">
	<h4>This is copyrighted by Deakin and the project group 29</h4>
</div>
</body>
</html>
