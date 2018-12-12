<?php
 	$PageTitle = "Student Survey";
	require "../PAGES/HEADER_STUDENT.PHP";
  require_once "../DATABASE/CONNECTDB.PHP";

  function skillOptions($title, $key) {
    echo "<tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr><tr>
            <th>$title</th>
            <td><label for='4$key'><div class='radioCell'>
                <input type='radio' id='4$key' name='$key' value='4' class='radioCell'>&nbsp;
            </div></label></td>
            <td><label for='3$key'><div class='radioCell'>
                <input type='radio' id='3$key' name='$key' value='3' class='radioCell'>&nbsp;
            </div></label></td>
            <td><label for='2$key'><div class='radioCell'>
                <input type='radio' id='2$key' name='$key' value='2' class='radioCell'>&nbsp;
            </div></label></td>
            <td><label for='1$key'><div class='radioCell'>
                <input type='radio' id='1$key' name='$key' value='1' class='radioCell'>&nbsp;
            </div></label></td>
            <td><label for='0$key'><div class='radioCell'>
                <input type='radio' id='0$key' name='$key' value='0' checked class='radioCell'>&nbsp;
            </div></label></td>
        </tr>";
  }
  $error = FALSE;
  // If form has been submitted, sanitise and process inputs
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $valid = TRUE;

    $i = 0;
    $survey_results = [];
    for ($i = 0; $i < 20; $i += 1)
    {
        if (isset($_POST[$i]))
        {
            $value = $_POST[$i];
            if (!is_null($value))
            {
              if(preg_match('/^[0-4]$/', $value)) {
                $survey_results['stu_skill_'.sprintf("%02d", $i)] = $value;
              } else {
                $valid = FALSE;
              }
            }
        }
    }
    if ($valid) {
      $count = sizeof($survey_results);
      $keys = array_keys($survey_results);
      $values = array_values($survey_results);
      // Check to see if a survey exists already for this student
      $query = "SELECT * FROM surveyanswer WHERE stu_ID='$id'";
      $result = mysqli_query($CON, $query) or die(mysqli_error($CON));
      $survey_count = mysqli_num_rows($result);
      // If student has not already submitted a survey, insert a record
      if ($survey_count == 0){
        // Build query
        $fields = "(stu_ID,";
        $results = "(".$id.",";
        for ($j=0; $j<$count; $j++) {
          $fields .= $keys[$j].",";
          $results .= $values[$j].",";
        }
        // Remove last comma and close bracket
        $fields = substr($fields, 0, -1).")";
        $results = substr($results, 0, -1).")";

        $sql = "INSERT INTO surveyanswer $fields VALUES $results";
        if (!mysqli_query($CON,$sql)) {
          $error = TRUE;
        }
      } elseif ($survey_count==1) {
        // If student has already submitted a survey, update existing record
        $sql = "UPDATE surveyanswer SET ";
        for ($j=0; $j<$count; $j++) {
          $sql .= $keys[$j] . " = " . $values[$j] . ",";
        }
        $sql = substr($sql, 0, -1); // Remove last comma
        $sql .= " WHERE stu_ID='$id'";
        if (!mysqli_query($CON,$sql)) {
          $error = TRUE;
        }
      }
    } else {
      // Invalid data, injection attempt?
      echo "Invalid data. Please reload and try again.";
      $error = TRUE;
    }
    if (!$error) {
      echo "<h2>Survey Complete</h2>";
      echo "<p>Thank you for completing the skills survey.</p>";
    }
  } else { // If not submitted, print form:
?>

<style>
    table {
        border-collapse: collapse;
    }
    td, th {
        text-align: center;
        width: 96px;
        border: 0;
        padding: 0;
    }
    td div {
        width: 100%;
        height: 100%;
    }
    .radioCell {
        background: #e0e0e0;
        cursor: pointer;
    }
    .radioCell:hover {
        background: #e0f0ff;
    }
</style>

<div style="text-align: center;">
    <?php if($error) echo "There was an error saving your survey. Please try again."; ?>
    <h1>Skills Survey</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <table align="center"><tr>
    <th>&nbsp;</th>
    <th>Expert</th>
    <th>High</th>
    <th>Intermediate</th>
    <th>Novice</th>
    <th>None</th>
    </tr>

<?php
  // Get Skill Names from Database
  $sql = "SELECT * FROM skillnames";
  $res = mysqli_query($CON, $sql);
  $row = mysqli_fetch_assoc($res);

  // Call skillOptions() to print a row for skill_## if that skill has a name value
    for ($i=0; $i<20; $i++) {
        $name = $row['skill_'.sprintf('%02d',$i)];
        if (!is_null($name)) {
        skillOptions($name, $i);
    }
  }
?>
    </table>
    <br>
    <input type="submit" value="Submit Responses" style="font-size: 1.5em" class="inputButton">
    </form>
</div> <?php } ?>
<?php require "../PAGES/FOOTER_STUDENT.PHP"; ?>
