<?php
 	$PageTitle = "Skill Names";
	require "../PAGES/HEADER_STAFF.PHP";
  require_once "../DATABASE/CONNECTDB.PHP";

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

<h2>Update Skill List</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

  <table>
  <?php
    for ($i=0;$i<20;$i++) {
      $j = $i + 1;
      echo '
       <tr>
        <td><label for="'.sprintf('skill_%02d', $i).'">Skill '.$j.'</label></td>
        <td><input type="text" name="'.sprintf('skill_%02d', $i).'" value="'.$row[sprintf('skill_%02d',$i)].'" /></td>
       </tr>';
    }
  ?>
  </table>
  <p><input type="submit" value="Update">&nbsp;&nbsp;<input type="reset" value="Reset"></p>
</form>
<hr>
<?php } // End of form display ?>

<?php require "../PAGES/FOOTER_STAFF.PHP"; ?>
