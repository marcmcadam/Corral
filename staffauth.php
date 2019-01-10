<?php
// This is used to verify staff member is logged in. Used on all staff specific pages.
if ( !isset($_SESSION['sta_Email'])) {
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: stafflogin");
}	else {
    $id = $_SESSION['sta_Email'];
    $sta_FirstName = $_SESSION['sta_FirstName'];
    $sta_LastName = $_SESSION['sta_LastName'];
    if (isset($_SESSION['unit']))
        $unitID = (string)$_SESSION['unit']; // TODO: check it belongs to this staff
    else
    {
        require_once "connectdb.php";
        require_once "getfunctions.php";
        $units = getUnits($CON);
        if (sizeof($units) == 0)
            $unitID = "dummy"; // TODO: hackish
        else
            $unitID = $units[0];
        $_SESSION['unit'] = $unitID;
    }
}
?>
