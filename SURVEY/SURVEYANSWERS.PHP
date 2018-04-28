<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="../styles/styles.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>

<!doctype html>

<html>

<FORM ACTION="SURVEYSUBMIT.PHP" METHOD="POST">
        <table>
        <tr>
	<td>Student Number:</td><td> <input type="text" name="STUDENT_ID" style="width:200px; height:20px;"></td>
        </tr>
        <tr>
	<td>Email Address: </td><td><input type="text" name="STUDENT_EMAIL" style="width:200px; height:20px;"></td>
        </tr>
        <tr>
	<td>First Name: </td><td><input type="text" name="STUDENT_FIRSTNAME" style="width:200px; height:20px;"></td>
        </tr>
        <tr>
	<td>Last Name:</td><td> <input type="text" name="STUDENT_LASTNAME" size="40"style="width:200px; height:20px;"></td>
        </tr>
        </table><br>


  <label>Location:</label>
  <br>
  <input type="radio" name="LOCATION" value="BURWOOD" /> <label><span>Burwood</span></label>
  &nbsp;&nbsp;&nbsp;
  <input type="radio" name="LOCATION" value="GEELONG" /> <label><span>Geelong</span></label>
  &nbsp;&nbsp;&nbsp;
  <input type="radio" name="LOCATION" value="CLOUD" /> <label><span>Cloud</span></label>
  <br><br>


  <label>Current Course: </label>
  <br>
  <input type="radio" name="CURRENT_COURSE" value="BACHELOR OF COMPUTER SCIENCE" /> <label><span>BACHELOR OF COMPUTER SCIENCE</span></label>
  &nbsp;&nbsp;&nbsp;
  <input type="radio" name="CURRENT_COURSE" value="BACHELOR OF IT" /> <label><span>BACHELOR OF IT</span></label>
  &nbsp;&nbsp;&nbsp;
  <input type="radio" name="CURRENT_COURSE" value="BACHELOR OF PROGRAMMING" /> <label><span>BACHELOR OF PROGRAMMING</span></label>
  &nbsp;&nbsp;&nbsp;
  <input type="radio" name="CURRENT_COURSE" value="BACHELOR OF CYBER SECURITY" /> <label><span>BACHELOR OF CYBER SECURITY</span></label>
  <br><br>


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
