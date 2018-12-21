<?php
 	$PageTitle = "Skill Names";
	require "header_staff.php";
  require_once "connectdb.php";

  // If form has been submitted, sanitise and process inputs
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Clean skillnames and assign variables
    for ($i=0;$i<20;$i++) {
      $skillfield = sprintf('skill_%02d',$i);
      $p = mysqli_real_escape_string($CON, $_POST[sprintf('skill_%02d', $i)]);
      if (strlen($p) == 0)
        $p = null;
      $$skillfield = $p;
    }
    $sql = "UPDATE skillnames SET ";
    for ($i=0;$i<20;$i++) {
      $skillvalue = sprintf('skill_%02d',$i);
      $v = $$skillvalue;
      $sql .= sprintf('skill_%02d',$i);
      if ($v == null)
        $sql .= " = null, ";
      else
        $sql .= " = '".$v."', ";
    }
    $sql = substr($sql, 0, -2); // Remove last comma
    $sql .= " WHERE skill_ID = 1";
    if(!mysqli_query($CON, $sql)) {
      echo "SQL Error: ".mysqli_error($CON);
    }
    echo "<h2>Project Skills Updated</h2>";
  } // End form processing

  if ($_SERVER["REQUEST_METHOD"] != "POST") {
  $sql = "SELECT * FROM skillnames WHERE skill_ID = 1";
  $res = mysqli_query($CON, $sql);
  $row = mysqli_fetch_assoc($res);
?>

<style>
    td {
        padding: 4px;
    }
</style>

<h2>Update Skill List</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

  <table align="center">
  <?php
    for ($i=0;$i<20;$i++) {
      $j = $i + 1;
      echo '
       <tr>
        <td>Skill '.$j.'</td>
        <td><input type="text" name="'.sprintf('skill_%02d', $i).'" value="'.$row[sprintf('skill_%02d',$i)].'" class="inputBox"></td>
       </tr>';
    }
  ?>
  </table>
  <p><input type="submit" value="Update" class="inputButton">&nbsp;&nbsp;<input type="reset" value="Reset" class="inputButton"></p>
</form>
<?php } // End of form display ?>

<?php require "footer.php"; ?>
