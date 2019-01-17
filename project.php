<?php
$PageTitle = "Project Details";
require "header_staff.php";
require_once "connectdb.php";
require_once "getfunctions.php";
require "sanitise.php";

$maxSkillImportance = 4;

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
    if (ctype_digit($_POST['min']))
        $minimum = min(max((int)mysqli_real_escape_string($CON, $_POST['min']), 0), 1000000);
    else
        $minimum = 0;
    $maximum = $minimum;
    if (ctype_digit($_POST['impAll']))
        $importance = min(max((int)mysqli_real_escape_string($CON, $_POST['impAll']), 0), 1000000);
    else
        $importance = 0;

    function postImportance($key)
    {
        global $maxSkillImportance;
        global $CON;
        $text = "imp$key";
        if (array_key_exists($text, $_POST))
            $value = (int)mysqli_real_escape_string($CON, $_POST[$text]);
        else
            $value = 0;
        return min(max($value, 0), $maxSkillImportance);
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

  $sql = "UPDATE project SET unit_ID='$unitID',pro_title='$title',pro_leader='$leader',pro_email='$email',pro_brief='$brief', pro_min='$minimum', pro_max='$maximum', pro_imp='$importance'";
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



    echo "
    <script>
        function getImportanceText(number)
        {
            switch (number)
            {
                case 0:
                    return 'None';
                case 1:
                    return 'Low';
                case 2:
                    return 'Moderate';
                case 3:
                    return 'High';
                case 4:
                    return 'Essential';
                default:
                    return '! out of range !';
            }
        }
    </script>
    ";

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
          global $maxSkillImportance;
          global $skillNames;
          global $skillImp;
          global $skillBias;

          $key = $n;
          $name = $skillNames[$n];
          $imp = $skillImp[$n];
          $bias = $skillBias[$n];

          $descriptionJS = "document.getElementById(\"outImp$key\").innerHTML=getImportanceText(parseInt(document.getElementById(\"imp$key\").value));";
          echo "    <tr>
                        <td>$name</td>
                        <td><input type='range' min='0' max='$maxSkillImportance' id='imp$key' name='imp$key' value='$imp' oninput='$descriptionJS'></td>
                        <td style='width: 32px' id='outImp$key'></td>
                        <td><input type='range' min='-1' max='1' name='bias$key' value='$bias'></td>
                        <script>$descriptionJS</script>
                    </tr>
                    "; // description script is inside the <tr> to keep n-th child styling correct
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
                Title<br>
                <input type='text' name='PRO_TITLE' class='inputBox' value='$title'><br><br>
                Supervisor<br>
                <input type='text' name='PRO_LEADER' class='inputBox' value='$leader'><br><br>
                Supervisor Email<br>
                <input type='email' name='PRO_EMAIL' class='inputBox' value='$email'><br><br>
                Brief<br>
                <textarea name='PRO_BRIEF' rows='5' cols='40' class='inputBox'>$brief</textarea><br>
                <br>
                Relative Number of Members<br>";
                /*<br>";
                Minimum <input type='text' name='min' value='$minimum'><br>
                <br>
                Maximum <input type='text' name='max' value='$maximum'><br>*/
        echo "  <input type='text' name='min' class='inputBox' value='$minimum'><br>
                <sub>scaled up or down for the number of students</sub><br>
                <input hidden type='text' name='max' value='0'><br>
                <br>
                <table align='center' class='listTable'>
                    <tr>
                        <th>Skill<br>&nbsp;</th>
                        <th>Skill Demand<br>
                            <sub>Irrelevant | Essential</sub></th>
                        <th style='width: 96px'>&nbsp;<br>&nbsp;</th>
                        <th>Skill Level Preference<br>
                            <sub>Many Low Skill | Any | Few High Skill</sub></th>
                    </tr>
                    <tr>
                        <td>Amplify All</td>
                        <td><input type='range' min='0' max='100' id='impAll' name='impAll' value='$importance' oninput='outImpAll.value=impAll.value'></td>
                        <td style='width: 32px'><output name='outImpAll' id='outImpAll' for='impAll'>$importance</output></td>
                        <td></td>
                    </tr>
        ";

        for ($i = 0; $i < $numSkills; $i += 1)
        {
            if (is_null($skillNames[$i]))
                continue;

            skillOptions($i);
        }

        echo '  </table>
                <br>
                <input type="submit" value="Save Changes" class="inputButton">
            </form>
        </div>';

    require "footer.php";
?>
