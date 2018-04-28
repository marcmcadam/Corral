<!DOCTYPE html>
<?php
require('../DATABASE/CONNECTDB.PHP');
    // If the values are posted, (created by marc) insert them into the database.
{


  $ID=$_GET['ID'];

	$SQLQuery =  "SELECT * FROM PROJECT WHERE PROJECT_NUM = '$ID'";
	$result = mysqli_query($CON, $SQLQuery);
	while ($row = mysqli_fetch_array($result))
		{
			$PROJECTNAME = $row['PROJECT_NAME'];
			$PROJECTBRIEF = $row['PROJECT_BRIEF'];
			$PROJECTLEADER = $row['PROJECT_LEADER'];
			$PROJECTSTATUS = $row['PROJECT_STATUS'];
		}
  }
?>

<html>

</html>
<h1> Change Project </h1>
				<form action=<?php echo "ADMINUPDATECONFIRMED.PHP?ID=" . $PROJECTID ?> method="post">
              <table>
              <tr>
              <td>Project Name:</td>
                <td> <input type="text" size=30 maxlength=30 name="PROJECT_NAME" value='<?php echo $PROJECTNAME;?>' autofocus required/> </td>
              </tr>
              <tr>
                <td>Project Description:</td>
              <td> <textarea name ="PROJECT_BRIEF" maxlength=5000 rows=10 cols=70 value='<?php echo $PROJECTBRIEF;?>' autofocus required></textarea></td>
              </tr>
              <tr>
              <td>Project Leader:</td>
                <td> <input type="text" size=30 maxlength=30 name="PROJECT_LEADER" value='<?php echo $PROJECTLEADER;?>' autofocus required/> </td>
              </tr>
              <tr>
              <td>Project Status:</td>
                <td> <input type="text" size=30 maxlength=30 name="PROJECT_STATUS" value='<?php echo $PROJECTSTATUS;?>' autofocus required/> </td>
              </tr>
						<tr>
							<td><input type='submit'/></td>
						</tr>

					</table>
					</form>
					</html>
