<?php
    require_once '../DATABASE/CONNECTDB.PHP';
    
    $pro_num = (int)mysqli_real_escape_string($CON, $_POST['pro_num']);
    $title = mysqli_real_escape_string($CON, $_POST['PRO_TITLE']);
    $leader = mysqli_real_escape_string($CON, $_POST['PRO_LEADER']);
    $email = mysqli_real_escape_string($CON, $_POST['PRO_EMAIL']);
    $brief = mysqli_real_escape_string($CON, $_POST['PRO_BRIEF']);
    $status = mysqli_real_escape_string($CON, $_POST['PRO_STATUS']);
    $minimum = mysqli_real_escape_string($CON, $_POST['min']);
    $maximum = mysqli_real_escape_string($CON, $_POST['max']);
    $importance = mysqli_real_escape_string($CON, $_POST['impAll']);

    function postImportance($key)
    {
        return min(max((int)$_POST["imp$key"], 0), 100);
    }
    
    function postBias($key)
    {
        return min(max((int)$_POST["bias$key"], -1), 1);
    }
    
    $numSkills = 20;

    $skillImp = [];
    $skillBias = [];
    for ($s = 0; $s < $numSkills; $s += 1)
    {
        array_push($skillImp, postImportance($s));
        array_push($skillBias, postBias($s));
    }

    // TODO: include updating pro_min, pro_max, pro_imp and biases
    
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
?>
