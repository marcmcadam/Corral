<?php
 	$PageTitle = "Staff Update";
	require "../PAGES/HEADER_STAFF.PHP";
  require("../DATABASE/CONNECTDB.php");
?>
<div id="contents">
<h2>Update Staff List</h2>
<?php
//DEBUG print "<br><br>".$_POST['staffid']."<br><br>"
if(!isset($_POST['staffid'])){
  print "<h3>You must first choose a staff member to update</h3><a href='../PROJECT/STAFFUPDATE.PHP'>You can select a staff memeber here</a>";
} else {
  $staff_ID = mysqli_real_escape_string($CON, $_POST['staffid']);
  if (!preg_match('/[0-9]$/', $staff_ID) ){
    print "invalid staff id detected: ".$staff_ID."<br>";
  } else {

    $query = "SELECT * FROM STAFF WHERE STAFF_ID = '".$staff_ID."'";
    $result = mysqli_query($CON, $query) or die(mysqli_error($CON));


    while ($row=mysqli_fetch_assoc($result)){
      print "<p><form action='../PROJECT/STAFFPROCESS' method='post'></p>";
      print "<p>Staff ID </p>
      <p><input type ='text' name ='STAFF_ID' value ='".$row["STAFF_ID"]."' class='inputBox'></p>
      <p>Firstname </p>
      <p><input type ='text' name ='STAFF_FIRSTNAME' value ='". $row['STAFF_FIRSTNAME']."' class='inputBox'></p>
      <p>Lastname </p>
      <p><input type ='text' name ='STAFF_LASTNAME' value ='". $row['STAFF_LASTNAME']."' class='inputBox'></p>
      <p>Location </p>
      <p><select name ='STAFF_LOCATION' class='inputList'>
          <option value='1'";
      if ($row['STAFF_LOCATION'] == 1) echo "selected";
        print ">Burwood</option>
          <option value='2'";
      if ($row['STAFF_LOCATION'] == 2) echo "selected";
        print ">Geelong</option>
          <option value='3'";
      if ($row['STAFF_LOCATION'] == 3) echo "selected";
      print " >Cloud</option>
      </select></p>
      <p>Email </p>
      <p><input type='text' name='STAFF_EMAIL' value='".$row['STAFF_EMAIL']."' class='inputBox'></p>
      <p><input type='submit' value='Update' class='inputButton'>&nbsp&nbsp<input type='reset' value='Reset' class='inputButton'></p>
      </form>
      </div>";
    }
  }
}

require "../PAGES/FOOTER_STAFF.PHP"; ?>
