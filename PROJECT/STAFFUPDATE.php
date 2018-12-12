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
      //$row['STAFF_ID']
      print "<br><br>".$row['STAFF_FIRSTNAME']."<br><br>";


      print "<p><form action='../PROJECT/STAFFPROCESS' method='post'></p>";
      print "<p>Staff ID </p>
      <p><input type ='text' name ='STAFF_ID' value ='".$row["STAFF_ID"]."' id='ip2'/></p>
      <p>Firstname </p>
      <p><input type ='text' name ='STAFF_FIRSTNAME' value ='". $row['STAFF_FIRSTNAME']."' id='ip2'/></p>
      <p>Lastname </p>
      <p><input type ='text' name ='STAFF_LASTNAME' value ='". $row['STAFF_LASTNAME']."' id='ip2'/></p>
      <p>Location </p>
      <p><select name ='STAFF_LOCATION'>
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
      <p><input type='text' name='STAFF_EMAIL' value='".$row['STAFF_EMAIL']."' id='ip2'/></p>

      <p><input type='submit' value='Update'>&nbsp&nbsp<input type='reset' value='Reset'></p>
      </form>
      </div>



      <hr>";
    }
  }
}

require "../PAGES/FOOTER_STAFF.PHP"; ?>
