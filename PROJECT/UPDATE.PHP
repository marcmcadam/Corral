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
    
    $columns = ["hc", "js", "php", "java", "c", "cpp", "oc", "db", "u3", "ui", "se"];
    $skillImp = [];
    $skillBias = [];
    foreach ($columns as $c)
    {
        array_push($skillImp, postImportance($c));
        array_push($skillBias, postBias($c));
    }

    // TODO: include updating pro_min, pro_max, pro_imp and biases
    
    $sql = "UPDATE project SET pro_title='$title',pro_leader='$leader',pro_email='$email',pro_brief='$brief',pro_status='$status', pro_min='$minimum', pro_max='$maximum', pro_imp='$importance'";
    for ($i = 0; $i < sizeof($columns); $i += 1)
    {
        $c = $columns[$i];
        $imp = $skillImp[$i];
        $sql .= ", pro_$c=$imp";
    }
    $sql .= " WHERE pro_num = $pro_num";
    $query = mysqli_query($CON, $sql);
    if (!$query)
        echo mysqli_error($CON);
    else
        header("location: PROJECTLIST.PHP");
?>
