<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<style>
/* Form Validate Status, Message Font Appear in RED */
#form #stat {
	color: #F00;
}
</style>

<body>
<h2><span style="font-size:32px"><strong>Student Survey Form</strong></span></h2>
<p style="font-size:18px">Dear Student,  </p>
<p>As you know, Corral Project is strongly committed to set of ethical principle code for recruitment. Therefore, it’s very important to answer the survey ethically.  </p>
<p>We are writing you this to encourage students to participate in this survey. By participating, you can help improve the conditions and group selection for every project submitted.  </p>
<p>In order to serve student for their future career, we are interesting to learn more about your skills. This survey will take less than 5 minutes to complete.  </p>
<p>Thank you for your time to participate in this survey. Please don’t hesitate to contact us for any enquires about the survey. </p>
<hr>
<form action="INSERT_SURVEY.php" method="post" name="form" id="form" >
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
        <option value="Cloud, but may travel in Deakin Campus">Cloud, but may travel in Deakin Campus</option>
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
      <td height="35"><p>6) Technical Skill: list at least three technical skills that you posses.</p></td>
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
      <td height="35">Tech Skill 4:</td>
      <td><input type="text" name="techsk4" id="techsk4" /></td>
    </tr>
    <tr>
      <td height="35">Tech Skill 5:</td>
      <td><input type="text" name="techsk5" id="techsk5" /></td>
    </tr>
    <tr>
      <td height="35">Tech Skill 6:</td>
      <td><input type="text" name="techsk6" id="techsk6" /></td>
    </tr>
    <tr>
      <td height="35"><p>7) Technical Skill Proficiency: rate the proficiency of each technical skills in the previous question.</p></td>
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
      <td><select name="techskpro3" id="techskpro3" >
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Tech Skill 4:</td>
      <td><select name="techskpro4" id="techskpro4" >
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Tech Skill 5:</td>
      <td><select name="techskpro5" id="techskpro5" >
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Tech Skill 6:</td>
      <td><select name="techskpro6" id="techskpro6" >
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35"><p>8) Soft Skills: list at least three soft skills.</p></td>
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
      <td height="35">Soft Skill 4:</td>
      <td><input type="text" name="softsk4" id="softsk4" /></td>
    </tr>
    <tr>
      <td height="35">Soft Skill 5:</td>
      <td><input type="text" name="softsk5" id="softsk5" /></td>
    </tr>
    <tr>
      <td height="35">Soft Skill 6:</td>
      <td><input type="text" name="softsk6" id="softsk6" /></td>
    </tr>
    <tr>
      <td height="35"><p>9) Soft Skill Proficiency: rate the proficiency of each soft skills in the previous question. </p></td>
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
      <td height="35">Soft Skill 4:</td>
      <td><select name="softskpro4" id="softskpro4" >
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Soft Skill 5:</td>
      <td><select name="softskpro5" id="softskpro5" >
        <option selected="selected"  value="">Choose one of the list Below</option>
        <option value="4">Expert skill</option>
        <option value="3">High skill</option>
        <option value="2">Intermediate skill</option>
        <option value="1">Novice skill</option>
      </select></td>
    </tr>
    <tr>
      <td height="35">Soft Skill 6:</td>
      <td><select name="softskpro6" id="softskpro6" >
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
      <td><textarea name="additi" rows="6" id="additi" maxlength="600" style='width:20em'></textarea></td>
    </tr>
  </table>
  
  <blockquote>
    <p>&nbsp;</p>
    <div id="stat"></div>
    <p>&nbsp;</p>
</blockquote>
  <input type="submit" name="submit" id="submit" value="Submit Survey" />
  <input type="reset" name="button2" id="button2" value="Reset"/>
</form>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../STYLES/register.js"></script>
</body>
</html>
