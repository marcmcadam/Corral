<?php
    $PageTitle = "Project Details";
    require "../PAGES/HEADER_STAFF.PHP";
    require_once '../DATABASE/CONNECTDB.PHP';

//Sanitisation functions
function SanitiseGeneric($CON, $input){
	$input = mysqli_real_escape_string($CON,$input);
  $input = preg_replace("/[,]+/", "", $input);
  $input = strip_tags($input);
	$input = trim($input);
  return $input;
}
function SanitiseString($CON, $input){
	$input = mysqli_real_escape_string($CON,$input);
  $input = preg_replace("/[,]+/", "", $input);
  $input = strip_tags($input);
	$input = trim($input);
  $input = strtolower($input);
  return $input;
}

function SanitiseName($CON, $input){
  $input = mysqli_real_escape_string($CON,$input);
  $input = preg_replace("/[,]+/", "", $input);
  $input = strip_tags($input);
	$input = trim($input);
  $input = strtolower($input);
  $input = ucfirst($input);
  return $input;
}


    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $pro_num = (int)SanitiseGeneric($CON, $_POST['pro_num']);
        $title = SanitiseName($CON, $_POST['PRO_TITLE']);
        $leader = SanitiseName($CON, $_POST['PRO_LEADER']);
        $email = SanitiseString($CON, $_POST['PRO_EMAIL']);
        $brief = SanitiseGeneric($CON, $_POST['PRO_BRIEF']);
        $status = mysqli_real_escape_string($CON, $_POST['PRO_STATUS']);
        $minimum = mysqli_real_escape_string($CON, $_POST['min']);
        $maximum = mysqli_real_escape_string($CON, $_POST['max']);
        $importance = mysqli_real_escape_string($CON, $_POST['impAll']);

        if($status != "Active" && $status != "Inactive" && $status != "Planning" && $status != "Cancelled" ){
          $status = "Planning";
        }

        function postImportance($key)
        {
            global $CON;
            $value = mysqli_real_escape_string($CON, $_POST["imp$key"]);
            return min(max((int)$value, 0), 100);
        }

        function postBias($key)
        {
            global $CON;
            $value = mysqli_real_escape_string($CON, $_POST["bias$key"]);
            return min(max((int)$value, -1), 1);
        }

        $numSkills = 20;

        $skillImp = [];
        $skillBias = [];
        for ($s = 0; $s < $numSkills; $s += 1)
        {
            array_push($skillImp, postImportance($s));
            array_push($skillBias, postBias($s));
        }

        $sql = "UPDATE project SET pro_title='$title',pro_leader='$leader',pro_email='$email',pro_brief='$brief',pro_status='$status', pro_min='$minimum', pro_max='$maximum', pro_imp='$importance'";
        for ($i = 0; $i < $numSkills; $i += 1)
        {
            $imp = $skillImp[$i];
            $bias = $skillBias[$i];
            $sql .= ", pro_skill_".sprintf("%02d", $i)."=$imp";
            $sql .= ", pro_bias_".sprintf("%02d", $i)."=$bias";
        }
        $sql .= " WHERE pro_num = $pro_num";
        $query = mysqli_query($CON, $sql);
        if (!$query)
            echo mysqli_error($CON);
        else
            header("location: PROJECTLIST.PHP");
    }
    else
    {

    }
?>

<?php
    $numSkills = 20;
    $surveyID = 1;
    require '../DATABASE/SKILLNAMES.PHP';

    $pro_num = filter_input(INPUT_GET, 'number', FILTER_VALIDATE_INT);
    if($pro_num) {
      $sql="SELECT * FROM project WHERE pro_num = $pro_num";
      $query = mysqli_query($CON, $sql);
      if (!$query)
      {
          echo mysqli_error($CON);
          die;
      }
      $project = mysqli_fetch_assoc($query);
      $title = $project['pro_title'];
      $brief = $project['pro_brief'];
      $leader = $project['pro_leader'];
      $email = $project['pro_email'];
      $status = $project['pro_status'];
      $minimum = $project['pro_min'];
      $maximum = $project['pro_max'];
      $importance = $project['pro_imp'];

      $numSkills = 20;

      $skillImp = [];
      $skillBias = [];
      for ($i = 0; $i < $numSkills; $i += 1)
      {
          $imp = (int)$project["pro_skill_".sprintf("%02d", $i)];
          $bias = (int)$project["pro_bias_".sprintf("%02d", $i)];
          array_push($skillImp, $imp);
          array_push($skillBias, $bias);
      }

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
      echo ";
        <style>
          th, td {
              padding: 8px 16px;
          }
        </style>
        <div style='text-align: center'>
        <h1>Project Details</h1><br>
        <form method='post'>
            <input hidden type='text' name='pro_num' value='$pro_num'>
                Project Title<br>
                <input type='text' name='PRO_TITLE' id='ip2' value='$title'><br><br>
                Project Leader<br>
                <input type='text' name='PRO_LEADER' id='ip2' value='$leader'><br><br>
                Leader Email<br>
                <input type='email' name='PRO_EMAIL' id='ip2' value='$email'><br><br>
                Project Brief<br>
                <textarea name='PRO_BRIEF' rows='5' cols='40' id='ip3'>$brief</textarea><br><br>
                <h2>Project Status</h2>
                <select name='PRO_STATUS'>
                    <option value='Active' ". ($status=='Active' ? 'Selected' : '') .">Active</option>
                    <option value='Inactive' ". ($status=='Inactive' ? 'Selected' : '') .">Inactive</option>
                    <option value='Planning' ". ($status=='Planning' ? 'Selected' : '') .">Planning</option>
                    <option value='Cancelled' ". ($status=='Cancelled' ? 'Selected' : '') .">Cancelled</option>
                </select>
                <br>
                <h2>Sorting</h2>
                Number of members:<br>
                <br>
                Minimum <input type='text' name='min' value='$minimum'><br>
                <br>
                Maximum <input type='text' name='max' value='$maximum'><br>
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
            skillOptions($i);

        echo '  </table>
            <input type="submit" value="Save Changes" style="font-size: 1.5em; padding: 8px;">
        </form>
        </div>';
    } else {
        echo "<h2>Invalid Project</h2>";
    }
    require "../PAGES/FOOTER_STAFF.PHP";
?>
