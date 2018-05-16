<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta charset="utf-8">
<title>Template</title>
<style>

#form #stat {
	color: #F00;
}

body {
  padding-bottom: 40px;
  background-color: #eee;
}

.Header {
	background-color: #333;
	font-family: Arial, Helvetica, sans-serif;
	color: white;
	text-align: center;
	padding: 5px;
}

.Footer {
	padding: 20px;
	background-color: #333;
	color: white;
	text-align: center;
	font-family: Arial, Helvetica, sans-serif;
}

p {
	margin-left: 40px;
	margin-right: 50px;
	font-family: Arial, Helvetica, sans-serif;
}

h2 {
	margin-left: 40px;
	font-family: Arial, Helvetica, sans-serif;
}

/* The navagation bar for the site, linked to the drop downs */
	.navbar {
    overflow: hidden;
    background-color: #333;
    font-family: Arial, Helvetica, sans-serif;
}

.navbar a {
    float: left;
    font-size: 16px;
    color: white;
    text-align: center;
    padding: 14px 100px;
    text-decoration: none;
}

/* This is for the drop down in the navigation bar */
.dropdown {
    float: left;
    overflow: hidden;
}

.dropdown .dropbtn {
    font-size: 16px;    
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
    background-color: red;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}



</style>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">
</head>

<body>
<div class="Header">
	<h1>Corral</h1>
</div>

<div class="navbar">
	<a href="../PAGES/STUDENTHOME">Home</a>
	<a href="../SURVEY/STUDENTSURVEY">Survey</a>
	<a href="../PAGES/STUDENTCONTACT">Contacts</a>
	<a href="../PAGES/STUDENTABOUTUS">About Us</a>
	<a href="../Access/LOGOUT">Logout</a>
</div>

<h2><span style="font-size:32px"><strong>Student Survey Form</strong></span></h2>
<p style="font-size:18px">Dear Student,  </p>
<p>As you know, Corral Project is strongly committed to set of ethical principle code for recruitment. Therefore, it’s very important to answer the survey ethically.  </p>
<p>We are writing you this to encourage students to participate in this survey. By participating, you can help improve the conditions and group selection for every project submitted.  </p>
<p>In order to serve student for their future career, we are interesting to learn more about your skills. This survey will take less than 5 minutes to complete.  </p>
<p>Thank you for your time to participate in this survey. Please don’t hesitate to contact us for any enquires about the survey. </p>
<hr>
<form id="form" name="form" method="post" action="../SURVEY/STUDENTSURVEYSUCCESSFULSUB">
  <table width="720" border="0" style="">
    <tr>
      <td width="234" height="35"><strong>Student ID Number: </strong></td>
      <td width="421"><strong>
        <input type="text" name="sid" id="sid" />
      </strong></td>
    </tr>
    <tr>
      <td height="35"><label for="location">1) Student Location:</label></td>
      <td><select name="location" id="location">
        <option selected="selected" value="">Choose one of the list Below</option>
        <option value="Burwood">Burwood</option>
        <option value="Geelong">Geelong</option>
        <option value="Cloud, but can travel in Deakin Campus">Cloud, but can travel in Deakin Campus</option>
        <option value="Cloud, located in Australia but can't easily travel to Deakin campus ">Cloud, located in Australia but can't easily travel to Deakin campus </option>
        <option value="Cloud, located outside Australia">Cloud, located outside Australia</option>
      </select></td>
    </tr>
    <tr>
      <td height="35"><label for="employ2">2) Are you working full-time, part-time or unemployed:</label></td>
      <td><select name="employ" id="employ">
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="Full-time">Full-time</option>
        <option value="Part-time">Part-time</option>
        <option value="Unemployed">Unemployed</option>
      </select></td>
    </tr>
    <tr>
      <td height="35"><label for="capstone2">3) Capstone Enrolment:</label></td>
      <td><select name="capstone" id="capstone">
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select></td>
    </tr>
    <tr>
      <td height="35"><label for="course2">4) Current Course: please choose the course/major you are enrolled in:</label></td>
      <td><select name="course" id="course">
        <option selected="selected"  value="">Choose one of the list Below</option>
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
      </select></td>
    </tr>
    <tr>
      <td height="35">5) Project role, choose roles you think best align with your skills:</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="35">Programmer (General):</td>
      <td><select name="skill1" id="skill1">
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">UX/UI Designer:</td>
      <td><select name="skill2" id="skill2">
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Security Specialist:</td>
      <td><select name="skill3" id="skill3">
        <option selected="selected"  value=''>Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Database Developer:</td>
      <td><select name="skill4" id="skill4">
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35"><label for="skill2"></label>
Web Developer: </td>
      <td><select name="skill5" id="skill5">
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Cloud Service Developer:</td>
      <td><select name="skill6" id="skill6">
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">App Developer (Mobile):</td>
      <td><select name="skill7" id="skill7">
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Network Engineer:</td>
      <td><select name="skill8" id="skill8">
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">VR/Game Developer </td>
      <td><select name="skill9" id="skill9">
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">3D Artist/Animator:</td>
      <td><select name="skill10" id="skill10">
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Technical Artist:</td>
      <td><select name="skill11" id="skill11">
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Project Manager:</td>
      <td><select name="skill12" id="skill12">
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Interactive Media Developer:</td>
      <td><select name="skill13" id="skill13">
        <option selected="selected"  value="">Choose one of the list Below</option
        >
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Business Analyst:</td>
      <td><select name="skill14" id="skill14">
        <option selected="selected"  value="">Choose one of the list Below</option
        >
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">6) Technical Skill: list at least three technical skills that you posses.</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="35">Tech Skill 1:</td>
      <td><input type="text" name="techsk1" id="techsk2" /></td>
    </tr>
    <tr>
      <td height="35">Tech Skill 2:</td>
      <td><input type="text" name="techsk2" id="techsk3" /></td>
    </tr>
    <tr>
      <td height="35">Tech Skill 3:</td>
      <td><input type="text" name="techsk3" id="techsk1" /></td>
    </tr>
    <tr>
      <td height="35">7) Technical Skill Proficiency: rate the proficiency of each technical skills in the previous question.</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="35">Tech Skill 1:</td>
      <td><select name="techskpro1" id="techskpro1" >
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Tech Skill 2:</td>
      <td><select name="techskpro2" id="techskpro2" >
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Tech Skill 3:</td>
      <td><select name="techskpro4" id="techskpro4" >
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">8) Soft Skills: list at least three soft skills.</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="35">Soft Skill 1:</td>
      <td><input type="text" name="softsk1" id="softsk1" /></td>
    </tr>
    <tr>
      <td height="35">Soft Skill 2:</td>
      <td><input type="text" name="softsk2" id="softsk2" /></td>
    </tr>
    <tr>
      <td height="35">Soft Skill 3:</td>
      <td><input type="text" name="softsk3" id="softsk3" /></td>
    </tr>
    <tr>
      <td height="35">9) Soft Skill Proficiency: rate the proficiency of each soft skills in the previous question.</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="35">Soft Skill 1:</td>
      <td><select name="softskpro1" id="softskpro1" >
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Soft Skill 2:</td>
      <td><select name="softskpro2" id="softskpro2" >
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Soft Skill 3:</td>
      <td><select name="softskpro3" id="softskpro3" >
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">10) Project Preferences: list the projects you would prefer to work in order of preference (three projects maximum). Choose the project base on your skills and knowledge.</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="35">Project Title 1:</td>
      <td><input type="text" name="projti1" id="projti1" /></td>
    </tr>
    <tr>
      <td height="35">Project Title 2:</td>
      <td><input type="text" name="projti2" id="projti2" /></td>
    </tr>
    <tr>
      <td height="35">Project Title 3:</td>
      <td><input type="text" name="projti3" id="projti3" /></td>
    </tr>
    <tr>
      <td height="35">11) Aspiration: tell us a few words what do you want to achieve in this unit and how you aim to contribute.
      <label for="aspira2"></label></td>
      <td><input name="aspira" type="text" id="aspira" value="" size="60" /></td>
    </tr>
    <tr>
      <td height="35">12) Profile: provide a link to your professional profile (i.e. Linkedin profile or online portfolio). </td>
      <td><input name="profile" type="text" id="profile" value="" size="60" /></td>
    </tr>
    <tr>
      <td height="35">13) Entrepreneurship: do you want to create your own start-up company or work for a new start-up?</td>
      <td><select name="Entrepre" id="Entrepre">
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">14) Permission to use Survey Data internally: for work and research development purpose.</td>
      <td><select name="permis" id="permis">
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select></td>
    </tr>
    <tr>
      <td height="35"><p>15) Thanks and Additional Comments.</p>
      <p><em>Many Thanks for completing this survey, we really appreciate it. If you have anything else to add that we might find usful or think we should know about, please add it here:</em></p></td>
      <td><textarea name="additi" cols="60" rows="6" id="additi"></textarea></td>
    </tr>
  </table>
  
  <blockquote>
    <p>&nbsp;</p>
    <div id="stat"></div>
    <p>&nbsp;</p>
</blockquote>
  <input type="submit" name="submit" id="submit" value="Submit Survey" />
  <input type="reset" name="button2" id="button2" value="Reset" />
</form>
<p>&nbsp;</p>

<div class="Footer">
	<h4>© Copyright Deakin University & Group 29 2018</h4>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../STYLES/register.js"></script>

</body>
</html>
