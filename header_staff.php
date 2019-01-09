<?php
    session_start();
    require "staffauth.php";
    require_once "getfunctions.php";
    require_once "connectdb.php";

    $parsedURL = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $parsedParts = explode("/", $parsedURL);
    $pagePart = $parsedParts[sizeof($parsedParts) - 1];
    $pageNoGet = explode("?", $pagePart)[0];
    if ($pageNoGet == "header_staff" && isset($_GET["unit"]))
    {
        $_SESSION["unit"] = (string)$_GET["unit"]; // TODO: needs validation?
        $return = $_GET["return"]; // TODO: needs validation?
        header("location: $return");
        die;
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $PageTitle." - Corral"; ?></title>
<link rel="stylesheet" type="text/css" href="styles.css">
<link rel="icon" type="image/ico" href="favicon.ico">
<?php echo isset($script) ? $script : "" ; // Echo header script if one exists (JavaScript Validation etc)?>
</head>

<body>
<div class="navbar">
    <div class="menu" style="width: 12%;"><a href="staffhome"><p>Corral</p></a>
    </div><div class="menu" style="width: 12%;"><a href="#"><p>Units</p></a>
        <ul>
            <li><a href="unit"><p>Add Unit</p></a></li>
            <li><a href="unitlist"><p>View Units</p></a></li>
        </ul>
    </div><div class="menu" style="width: 12%;"><a href="#"><p>Projects</p></a>
        <ul>
            <li><a href="project?number="><p>Add Project</p></a></li>
            <li><a href="projectlist"><p>View Projects</p></a></li>
        </ul>
    </div><div class="menu" style="width: 12%;"><a href ="#"><p>Groups</p></a>
        <ul>
            <li><a href="grouplist"><p>Project Groups</p></a></li>
            <li><a href="begin"><p>Begin Sort</p></a></li>
            <li><a href="sortedgroups"><p>Sort Results</p></a></li>
        </ul>
    </div><div class="menu" style="width: 12%;"><a href ="#"><p>Admin</p></a>
        <ul>
            <li><a href="studentlist"><p>Students</p></a></li>
            <li><a href="stafflist"><p>Staff</p></a></li>
            <li><a href="datamgmt"><p>Manage Corral Data</p></a></li>
        </ul>
    </div><div class="menuGap" style="width: 15%;">
        <?php
            $units = getUnits($CON);
            $page = $_SERVER["REQUEST_URI"];
            echo "<form action='header_staff'>
                    <select class='updateList' name='unit' onchange='this.form.submit()'>";
                    $i=0;
                    while (isset($units[$i])) {
                        echo "<option value='".$units[$i]."'";
                        if ($units[$i] === $unitID)
                            echo " selected";
                        echo ">".$units[$i]."</option>";
                        $i++;
                    }
                    echo "</select>
                    <input hidden type='text' class='updateButton' name='return' value='$page'>
                </form>";
        ?>
    </div><div class="menuGap" style="width: 15%;">
        <form action="search" method="get">
            <input type="text" placeholder="Search.." name="search" class='updateBox' style='max-width: 128px;'>
        </form>
    </div><div class="menuGap" style="width: 8%;">
        <form action="logout" method="get">
            <button class="updateButton">Logout</button>
        </form>
    </div>
</div>
<div class="main">
