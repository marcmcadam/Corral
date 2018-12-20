<?PHP
    require_once "condb.php";

    $select = mysqli_select_db($CON, 'CORRAL_PROJECT');
    if (!$select)
        die("Database selection failed: " . mysqli_error($CON));
    unset($select);
?>
