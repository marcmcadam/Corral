<?php
    $students1k = false;

    require "STAFFDATA.PHP";
    require "SKILLNAMESDATA.PHP";
    if ($students1k)
        require "STUDENTDATA1000.PHP";
    else
        require "STUDENTDATA.PHP";
    
    require_once "../connectdb.php";
    
    //empty existing project table
    $project = "TRUNCATE project";
    if (mysqli_query($CON, $project)) {
      echo "<p>Project data deleted</p>";
    } else {
      echo "Error deleting project data: " . mysqli_error($CON);
    }
    
    //empty existing surveydata table
    $surveyanswer = "TRUNCATE surveyanswer";
    if (mysqli_query($CON, $surveyanswer)) {
      echo "<p>surveyanswer data deleted</p>";
    } else {
      echo "Error deleting surveyanswer data: " . mysqli_error($CON);
    }
    
    $numSkills = 20;
    
    $rarity = 2.0;
    function randomSkill()
    {
        global $rarity;
        $m = (int)floor(pow($rarity, 5.0));
        $r = random_int(0, $m - 1);
        return 4 - (int)floor(log($r) / log($rarity));
    }
    
    function randomSkills()
    {
        global $numSkills;
        $skills = [];
        for ($i = 0; $i < $numSkills; $i += 1)
            array_push($skills, randomSkill());
        return $skills;
    }
    
    $studentIDs = [
    216000000,
    216116590,
    216600366,
    216030213,
    216252283,
    216822724,
    216420635,
    216830213,
    216988272,
    216986348,
    216147717,
    216901983,
    216469334,
    216152608,
    216207865,
    216746852,
    216337658,
    216232216,
    216429653,
    216909984,
    216463558,
    216592291,
    216786574,
    216983844,
    216528480,
    216314056,
    216965849,
    216275552,
    216779566,
    216412040,
    216762187,
    216498622,
    216567433,
    216249111,
    216168384,
    216883858,
    216427960,
    216391202,
    216360811,
    216902992,
    216292829,
    216720992,
    216765045,
    216440236,
    216249197,
    216828121,
    216671593,
    216587493,
    216782631,
    216949905,
    216656298,
    216685859,
    216543826,
    216454582,
    216242484,
    216636419,
    216275634,
    216184964,
    216440367,
    216402248,
    216674327,
    216734638,
    216380225,
    216800271,
    216585007,
    216021355,
    216049775,
    216836356,
    216510372,
    216254575,
    216375217,
    216498790,
    216708060,
    216425301,
    216848062,
    216435225,
    216510246,
    216935793,
    216181579,
    216040637,
    216926394,
    216817132,
    216390639,
    216072283,
    216270368,
    216120029,
    216333608,
    216608767,
    216725302,
    216843094,
    216553948,
    216801834,
    216338930,
    216542434,
    216899114,
    216446129,
    216026988,
    216776800,
    216820558,
    216043880
    ];
    if ($students1k)
    {
        for ($i = 0; $i < 900; $i += 1)
            array_push($studentIDs, 217000000 + $i);
    }
    $PROJECT = "INSERT INTO project (pro_title, pro_min, pro_max, pro_imp";
    for ($i = 0; $i < 20; $i += 1)
        $PROJECT .= ", pro_skill_" . sprintf("%02d", $i);
    for ($i = 0; $i < 20; $i += 1)
        $PROJECT .= ", pro_bias_" . sprintf("%02d", $i);
    $PROJECT .= ") VALUES ";
    
    $surveydata = "INSERT INTO surveyanswer (stu_ID";
    for ($i = 0; $i < 20; $i += 1)
        $surveydata .= ", stu_skill_" . sprintf("%02d", $i);
    $surveydata .= ") VALUES ";
    
    $numProjects = $students1k ? 200 : 20;
    $projectSizes = [];
    $projectSkills = [];
    for ($i = 0; $i < $numProjects; $i += 1)
    {
        if ($i > 0)
            $PROJECT .= ', ';
        $min = random_int(1, 9);
        $max = 0;
        $imp = 20;
        array_push($projectSizes, $min);
        $skills = randomSkills();
        array_push($projectSkills, $skills);
        $biases = array_fill(0, $numSkills, 0);
        $PROJECT .= '("Project ' . $i . '"' . ", $min, $max, $imp, " . join(", ", $skills) . ", " . join(", ", $biases) . ')';
    }
    $projectTotal = array_sum($projectSizes);    
    // proportionally distribute students
    $remaining = sizeof($studentIDs);
    $projectStudents = [];
    foreach ($projectSizes as $p => $value)
    {
        if ($projectTotal == 0)
            $proportion = 0.0;
        else
            $proportion = $value / $projectTotal;

        $take = (int)round($remaining * $proportion);
        $remaining -= $take;
        $projectTotal -= $value;
        $projectStudents[$p] = $take;
    }
    if ($projectTotal != 0 || $remaining != 0)
    {
        echo "Project group size failed";
        die;
    }
    
    $i = 0;
    foreach ($projectStudents as $p => $size)
    {
        $skills = $projectSkills[$p];
        for ($j = 0; $j < $size; $j += 1)
        {
            if ($i > 0)
                $surveydata .= ",";
            $surveydata .= "($studentIDs[$i], " . join(", ", $skills) . ")";
            $i += 1;
        }
    }
    if ($i != sizeof($studentIDs))
        die("Incorrect number of responses created.");
    
    // Insert sample data into table
    if (mysqli_query($CON,$PROJECT)) {
      echo "<p>Sample projects inserted</p>";
    } else {
      echo "Error inserting project data: " . mysqli_error($CON);
    }
    
    if (mysqli_query($CON,$surveydata)) {
      echo "<P>Sample surveyanswer data inserted</P>";
    } else {
      echo "Error inserting sample surveyanswer data: " . mysqli_error($CON);
    }
?>
