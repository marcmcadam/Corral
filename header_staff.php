<?php
    session_start();
    session_regenerate_id();  // prevention of session hijacking
    require "staffauth.php";
    require_once "getfunctions.php";
    require_once "connectdb.php";
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
<div id="wrapper">
<div class="navbar">
    <div class="menu" style="width: 12%;"><a href="staffhome"><p>Corral</p></a>
    </div>
    <div class="menu" style="width: 12%;"><a href="#"><p>Units</p></a>
        <ul>
            <li><a href="unit"><p>Add Unit</p></a></li>
            <li><a href="unitlist"><p>View Units</p></a></li>
        </ul>
    </div>
    <?php
        if (isset($unitID) && $unitID != "")
        echo '  <div class="menu" style="width: 12%;"><a href="#"><p>Projects</p></a>
                    <ul>
                        <li><a href="project?number="><p>Add Project</p></a></li>
                        <li><a href="projectlist"><p>View Projects</p></a></li>
                    </ul>
                </div><div class="menu" style="width: 12%;"><a href ="#"><p>Groups</p></a>
                    <ul>
                    <li><a href="begin"><p>Sorting Setup</p></a></li>
                        <li><a href="grouplist"><p>View Groups</p></a></li>
                        <li><a href="sortedgroups"><p>Group Skills</p></a></li>
                    </ul>
                </div>';
    ?>
    <div class="menu" style="width: 12%;"><a href ="datamgmt"><p>Admin</p></a>
    </div><div class="menuGap" style="width: 20%;">
        <form action="search" method="get">
            <input type="text" placeholder="Search.." name="search" class='updateBox' style='max-width: 128px;'>
        </form>
    </div><div class="menuGap" style="width: 8%;">
        <form action="stafflogout" method="get">
            <button class="updateButton">Logout</button>
        </form>
    </div>
</div>
<div class="main">
