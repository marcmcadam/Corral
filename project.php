<?php
$PageTitle = "Project Details";
require "header_staff.php";
require_once "connectdb.php";
require_once "getfunctions.php";
require "sanitise.php";
?>

<?php
// define variables and set to empty values
$titleErr = $leaderErr = $emailErr = $briefErr = $statusErr = "";
$PRO_TITLE = $PRO_LEADER = $PRO_EMAIL = $PRO_BRIEF = $PRO_STATUS = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["PRO_TITLE"])) {
    $titleErr = "Title is required";
  } else {
    $PRO_TITLE = input($_POST["PRO_TITLE"]);
  }

if (empty($_POST["PRO_LEADER"])) {
    $leaderErr = "Leader is required";
} else {
  $PRO_LEADER = input($_POST["PRO_LEADER"]);
}

if (empty($_POST["PRO_EMAIL"])) {
    $emailErr = "Email is required";
} else {
  $PRO_EMAIL = input($_POST["PRO_EMAIL"]);
}

if (empty($_POST["PRO_BRIEF"])) {
    $briefErr = "Brief is required";
} else {
  $PRO_BRIEF = input($_POST["PRO_BRIEF"]);
}

if (empty($_POST["PRO_STATUS"])) {
    $statusErr = "Status is required";
} else {
  $PRO_STATUS = input($_POST["PRO_STATUS"]);
}
}

function input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $pro_ID_text = SanitiseGeneric($_POST['pro_ID'], $CON);
  if ($pro_ID_text == "")
  {
      $insert = "INSERT INTO project (unit_ID, pro_imp) VALUES ('$unitID', 20)";
      $query = mysqli_query($CON, $insert);
      if ($query)
          $pro_ID = mysqli_insert_id($CON);
      else
          die(mysqli_error($CON));
  }
  else
      $pro_ID = (int)$pro_ID_text;

    //$unit_ID = mysqli_real_escape_string($CON, $_POST['unit_ID']);
    $title = SanitiseName($CON, $_POST['PRO_TITLE']);
    $leader = SanitiseName($CON, $_POST['PRO_LEADER']);
    $email = SanitiseString($CON, $_POST['PRO_EMAIL']);
    $brief = SanitiseGeneric($_POST['PRO_BRIEF'], $CON);
    $status = mysqli_real_escape_string($CON, $_POST['PRO_STATUS']);
    if (ctype_digit($_POST['min']))
        $minimum = min(max((int)mysqli_real_escape_string($CON, $_POST['min']), 0), 1000000);
    else
        $minimum = 0;
    $maximum = $minimum;
    if (ctype_digit($_POST['impAll']))
        $importance = min(max((int)mysqli_real_escape_string($CON, $_POST['impAll']), 0), 1000000);
    else
        $importance = 0;

    if($status != "Active" && $status != "Inactive" && $status != "Planning" && $status != "Cancelled" ){
        $status = "Planning";
    }

    function postImportance($key)
    {
        global $CON;
        $text = "imp$key";
        if (array_key_exists($text, $_POST))
            $value = (int)mysqli_real_escape_string($CON, $_POST[$text]);
        else
            $value = 0;
        return min(max($value, 0), 100);
    }

    function postBias($key)
    {
        global $CON;
        $text = "bias$key";
        if (array_key_exists($text, $_POST))
            $value = (int)mysqli_real_escape_string($CON, $_POST[$text]);
        else
            $value = 0;
        return min(max($value, -1), 1);
    }

  $numSkills = 20;

  $skillImp = [];
  $skillBias = [];
  for ($s = 0; $s < $numSkills; $s += 1)
  {
      array_push($skillImp, postImportance($s));
      array_push($skillBias, postBias($s));
  }

  $sql = "UPDATE project SET unit_ID='$unitID',pro_title='$title',pro_leader='$leader',pro_email='$email',pro_brief='$brief',pro_status='$status', pro_min='$minimum', pro_max='$maximum', pro_imp='$importance'";
  for ($i = 0; $i < $numSkills; $i += 1)
  {
      $imp = $skillImp[$i];
      $bias = $skillBias[$i];
      $sql .= ", pro_skill_".sprintf("%02d", $i)."=$imp";
      $sql .= ", pro_bias_".sprintf("%02d", $i)."=$bias";
  }
  $sql .= " WHERE pro_ID = $pro_ID";
  $query = mysqli_query($CON, $sql);
  if (!$query)
      die(mysqli_error($CON));
  else
  {
      header("location: projectlist");
      die;
  }
}
?>

<?php
    $numSkills = 20;
    $skillnames = [];

    $pro_ID = filter_input(INPUT_GET, 'number', FILTER_VALIDATE_INT);

    $skillNames = getSkillNames($CON, $numSkills, $unitID);

    $skillImp = [];
    $skillBias = [];
    if (is_null($pro_ID) || $pro_ID == "")
    {
        // updating nothing. create a new project
        $pro_ID = "";
        $title = "";
        $brief = "";
        $leader = "";
        $email = "";
        $status = "";
        $minimum = 0;
        $maximum = 0;
        $importance = 20; // with limit as 100, is a number that can get 5 times larger, but also 5x smaller without losing too much fidelity (20/5 = 4)

        for ($i = 0; $i < $numSkills; $i += 1)
        {
          array_push($skillImp, 0);
          array_push($skillBias, 0);
        }
    }
    else
    {
      $sql="SELECT * FROM project WHERE pro_ID=$pro_ID AND unit_ID='$unitID'";
      $query = mysqli_query($CON, $sql);
      if (!$query)
          die(mysqli_error($CON));
      $project = mysqli_fetch_assoc($query);
      //$unit_ID = $project['unit_ID'];
      $title = $project['pro_title'];
      $brief = $project['pro_brief'];
      $leader = $project['pro_leader'];
      $email = $project['pro_email'];
      $status = $project['pro_status'];
      $minimum = $project['pro_min'];
      $maximum = $project['pro_max'];
      $importance = $project['pro_imp'];

      for ($i = 0; $i < $numSkills; $i += 1)
      {
          $imp = (int)$project["pro_skill_".sprintf("%02d", $i)];
          $bias = (int)$project["pro_bias_".sprintf("%02d", $i)];
          array_push($skillImp, $imp);
          array_push($skillBias, $bias);
      }
    }

      $numSkills = 20;
      $units = getUnits($CON);
      function skillOptions($n)
      {
          global $skillNames;
          global $skillImp;
          global $skillBias;

          $key = $n;
          $name = $skillNames[$n];
          $imp = $skillImp[$n];
          $bias = $skillBias[$n];

          echo "<tr>
              <td>$name</td>
              <td><input type='range' min='0' max='100' id='imp$key' name='imp$key' value='$imp' oninput='outImp$key.value=imp$key.value'><br><br></td>
              <td style='width: 32px'><output name='outImp$key' id='outImp$key' for='imp$key'>$imp</output><br><br></td>
              <td><input type='range' min='-1' max='1' name='bias$key' value='$bias'><br><br></td>
          </tr>";
      }
      echo "
        <style>
          th, td {
              padding: 8px 16px;
          }
        </style>
        <div style='text-align: center;'>
        <h2>Project Details</h2><br>
        <form method='post'>
            <input hidden type='text' name='pro_ID' value='$pro_ID'>
                Project Title<br>
                <input type='text' name='PRO_TITLE' class='inputBox' value='$title'></span><br><br>
                Project Leader<br>
                <input type='text' name='PRO_LEADER' class='inputBox' value='$leader'><br><br>
                Leader Email<br>
                <input type='email' name='PRO_EMAIL' class='inputBox' value='$email'><br><br>
                Project Brief<br>
                <textarea name='PRO_BRIEF' rows='5' cols='40' class='inputBox'>$brief</textarea><br><br>
                Project Status
                <select name='PRO_STATUS' class='inputList' size='1'>
                    <option value='Active'". ($status=='Active' ? 'Selected' : '') .">Active</option>
                    <option value='Inactive'". ($status=='Inactive' ? 'Selected' : '') .">Inactive</option>
                    <option value='Planning'". ($status=='Planning' ? 'Selected' : '') .">Planning</option>
                    <option value='Cancelled'". ($status=='Cancelled' ? 'Selected' : '') .">Cancelled</option>
                </select>
                <br><br>
                Number of members:<br>";
                /*<br>";
                Minimum <input type='text' name='min' value='$minimum'><br>
                <br>
                Maximum <input type='text' name='max' value='$maximum'><br>*/
        echo "  <input type='text' name='min' class='inputBox' value='$minimum'><br>
                <input hidden type='text' name='max' value='0'><br>
                <h2>Skills</h2>
                <table align='center'>
                    <tr>
                        <th>Skill</th>
                        <th>Importance</th>
                        <th>&nbsp;</th>
                        <th>Bias</th>
                    </tr>
                    <tr>
                        <td>All</td>
                        <td><input type='range' min='0' max='100' id='impAll' name='impAll' value='$importance' oninput='outImpAll.value=impAll.value'><br><br></td>
                        <td style='width: 32px'><output name='outImpAll' id='outImpAll' for='impAll'>$importance</output><br><br></td>
                    </tr>
        ";

        for ($i = 0; $i < $numSkills; $i += 1)
        {
            if (is_null($skillNames[$i]))
                continue;

            skillOptions($i);
        }

        echo '  </table>
            <input type="submit" value="Save Changes" style="font-size: 1.5em" class="inputButton">
        </form>
        </div>';

    require "footer.php";
?>
