<?php
  $PageTitle = "Manage Corral Data";
  require "header_staff.php";
?>
<h2>Import Data into Corral</h2>
<ul class="flexcontainer">
  <li class="flexitem">
    <h3>Student Information</h3>
    <form action="classlist.php">
      <button class="inputButton">Import Students from CSV</button>
    </form>
  </li>
  <li class="flexitem">
    <h3>Staff Information</h3>
  </li>
  <li class="flexitem">
    <h3>Project Information</h3>
  </li>
</ul>

<h2>Export Data from Corral's Database</h2>
<ul class="flexcontainer">
  <li class="flexitem">
    <h3>Student Information</h3>
    <form action="studentcsv.php" method="post">
    	<input type="submit" value="Student List to CSV" class="inputButton">
    </form>
    <form action="studentpdf.php" method="post">
    	<input type="submit" value="Student List to PDF" class="inputButton">
    </form>
    <form action="surveycsv.php" method="post">
    	<input type="submit" value="Survey Results to CSV" class="inputButton">
    </form>
  </li>
  <li class="flexitem">
    <h3>Staff Information</h3>
    <form action="staffcsv.php" method="post">
    	<input type="submit" name="STAFF_CSV" value="Export Staff List To CSV" class="inputButton">
    </form>
    <form action="staffpdf.php" method="post">
    	<input type="submit" name="STAFF_PDF" value="Export Staff List to PDF" class="inputButton">
    </form>
  </li>
  <li class="flexitem">
    <h3>Project Information</h3>
    <form action="projectlistcsv.php" method="post">
        <select name="View" class="inputList">
    		<option value="All">All Projects</option>
    		<option value="Active">Active Projects</option>
    		<option value="Inactive">Inactive Projects</option>
    		<option value="Planning">Planning Projects</option>
    		<option value="Cancelled">Cancelled Projects</option>
    	</select>
    	<input type="submit" name="export_excel" value="Export As CSV" class="inputButton">
    </form>
    <form action="projectlistpdf.php" method="post">
    	<select name="View" class="inputList">
    		<option value="All">All Projects</option>
    		<option value="Active">Active Projects</option>
    		<option value="Inactive">Inactive Projects</option>
    		<option value="Planning">Planning Projects</option>
    		<option value="Cancelled">Cancelled Projects</option>
    	</select>
    	<input type="submit" name="export_PDF" value="Export As PDF" class="inputButton">
    </form>
  </li>
  <li class="flexitem">
    <h3>Group Information</h3>
    <form action="groupcsv.php" method="post">
    	<input type="submit" value="Export Group List To CSV" class="inputButton">
    </form>
    <form action="grouppdf.php" method="post">
    	<input type="submit" value="Export Group List To PDF" class="inputButton">
    </form>
  </li>
</ul>
<?php require "footer.php"; ?>
