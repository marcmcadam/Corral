<?php
// This is used to verify staff member is logged in. Used on all staff specific pages.
if ( !isset($_SESSION['sta_Email'])) {
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: stafflogin");
}	else {
    $id = $_SESSION['sta_Email'];
    $sta_FirstName = $_SESSION['sta_FirstName'];
    $sta_LastName = $_SESSION['sta_LastName'];

    require_once "connectdb.php";
    require_once "getfunctions.php";
    $units = getStaffUnits($CON, $id);
    if (isset($_SESSION['unit']))
    {
        $unitID = (string)$_SESSION['unit'];
        if (!in_array($unitID, $units))
            unset($unitID);
    }
    if (!isset($unitID))
    {
        if (sizeof($units) == 0)
            $unitID = ""; // TODO: hackish
        else
            $unitID = $units[0];
        $_SESSION['unit'] = $unitID;
    }
}
?>
