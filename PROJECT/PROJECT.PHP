<?php
    $PageTitle = "Project Details";
    require "../PAGES/HEADER_STAFF.PHP";
    require '../DATABASE/CONNECTDB.PHP';

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

      $columns = ["hc", "js", "php", "java", "c", "cpp", "oc", "db", "u3", "ui", "se"];
      $skillImp = [];
      $skillBias = array_fill(0, 11, 0); //[];
      foreach ($columns as $c)
      {
          $imp = (int)$project["pro_$c"];
          // TODO: bias from database
          array_push($skillImp, $imp);
      }

      function skillOptions($title, $n)
      {
          global $columns;
          global $skillImp;
          global $skillBias;

          $key = $columns[$n];
          $imp = $skillImp[$n];
          $bias = $skillBias[$n];

          echo "<tr>
              <td>$title</td>
              <td><input type='range' min='0' max='100' id='imp$key' name='imp$key' value='$imp' oninput='outImp$key.value=imp$key.value'><br><br></td>
              <td style='width: 32px'><output name='outImp$key' id='outImp$key' for='imp$key'>$imp</output><br><br></td>
              <td><input hidden type='range' min='-1' max='1' value='0' name='bias$key' value='$bias'><br><br></td>
          </tr>";
      }
      echo ';
        <style>
          th, td {
              padding: 8px 16px;
          }
        </style>
        <div style="text-align: center">
        <h1>Project Details</h1><br>
        <form action="UPDATE.PHP" method="post">';

            echo "  <input hidden type='text' name='pro_num' value='$pro_num'>
                    Project Title<br>
                    <input type='text' name='PRO_TITLE' id='ip2' value='$title'><br><br>
                    Project Leader<br>
                    <input type='text' name='PRO_LEADER' id='ip2' value='$leader'><br><br>
                    Leader Email<br>
                    <input type='email' name='PRO_EMAIL' id='ip2' value='$email'><br><br>
                    Project Brief<br>
                    <textarea name='PRO_BRIEF' rows='5' cols='40' id='ip3'>$brief</textarea><br><br>
                    <h2>Project Status</h2>
                    <select name='View'>
                  		<option value='Active' ". ($status=='Active' ? 'Selected' : '') .">Active</option>
                  		<option value='Inactive' ". ($status=='Inactive' ? 'Selected' : '') .">Inactive</option>
                  		<option value='Planning' ". ($status=='Planning' ? 'Selected' : '') .">Planning</option>
                  		<option value='Cancelled' ". ($status=='Cancelled' ? 'Selected' : '') .">Cancelled</option>
                  	</select>
                    <br>
                    <h2>Project skills</h2>

                    <table align='center'>
                        <tr>
                            <th>Skill</th>
                            <th>Importance</th>
                            <th> &nbsp; <!--bias--> </th>
                        </tr>
            ";
            /*
                <input type='radio' name='PRO_STATUS' value='active'>Active<br>
                <input type='radio' name='PRO_STATUS' value='inactive'>Inactive<br>
                <input type='radio' name='PRO_STATUS' value='planning'>Planning<br>
            */

            skillOptions("HTML/CSS", 0);
            skillOptions("JavaScript", 1);
            skillOptions("PHP", 2);
            skillOptions("Java", 3);
            skillOptions("C", 4);
            skillOptions("C++", 5);
            skillOptions("Objective-C", 6);
            skillOptions("Database", 7);
            skillOptions("Unity", 8);
            skillOptions("UI", 9);
            skillOptions("Security", 10);

        echo '</table>
        <input type="submit" action="UPDATE.PHP" value="Update Details">
    </form>';

  } else {
    echo "<h2>Invalid Project</h2>";
  } ?>
</div>
<?php require "../PAGES/FOOTER_STAFF.PHP"; ?>
