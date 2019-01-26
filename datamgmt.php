<?php
  $PageTitle = "Manage Corral Data";
  require "header_staff.php";
?>
<ul class="flexcontainer">
  <li class="flexitem">
    <h3>Student Information</h3>
    <h4>Manage</h4>
      <form action="studentlist.php">
        <button class="inputButton">View and Edit Students</button>
      </form>
    <h4>Import</h4>
      <form action="importStudents.php">
        <button class="inputButton">Import Students from CSV</button>
      </form>
    <h4>Export</h4>
      <form action="studentcsv.php" method="post">
      	<input type="submit" value="Student List to CSV" class="inputButton" style="width: 161px">
      </form>
      <form action="studentpdf.php" method="post">
      	<input type="submit" value="Student List to PDF" class="inputButton" style="width: 161px">
      </form>
      <form action="surveycsv.php" method="post">
      	<input type="submit" value="Survey Results to CSV" class="inputButton">
      </form>
  </li>
  <li class="flexitem">
    <h3>Staff Information</h3>
    <h4>Manage</h4>
      <form action="stafflist.php">
        <button class="inputButton" style="width: 161px">View and Edit Staff</button>
      </form>
    <h4>Import</h4>
      <form action="importStaff.php" >
        <button class="inputButton">Import Staff from CSV</button>
      </form>
    <h4>Export</h4>
      <form action="staffcsv.php" method="post">
      	<input type="submit" name="STAFF_CSV" value="Export Staff List To CSV" class="inputButton">
      </form>
      <form action="staffpdf.php" method="post">
      	<input type="submit" name="STAFF_PDF" value="Export Staff List to PDF" class="inputButton">
      </form>
  </li>
  <li class="flexitem">
    <h3>Project Information</h3>
    <h4>Manage</h4>
      <form action="projectlist.php">
        <button class="inputButton">View and Edit Projects</button>
      </form>
      <h4>Import</h4>
      <form action="">
        <button class="inputButton" style="width: 161px">NYI</button>
      </form>
    <h4>Export</h4>
      <form action="projectlistcsv.php" method="post">
        <input type="submit" name="export_excel" value="Export As CSV" class="inputButton" style="width: 161px">
      </form>
      <form action="projectlistpdf.php" method="post">
        <input type="submit" name="export_PDF" value="Export As PDF" class="inputButton" style="width: 161px">
      </form>
  </li>
  <li class="flexitem">
    <h3>Unit Information</h3>
    <h4>Manage</h4>
      <form action="unitlist.php">
        <button class="inputButton">View and Edit Units</button>
      </form>
      <h4>Import</h4>
      <form action="">
        <button class="inputButton" style="width: 161px">NYI</button>
      </form>
        <h4>Export</h4>
        <form action="">
          <button class="inputButton" style="width: 161px">NYI</button>
        </form>
  </li>
  <li class="flexitem">
    <h3>Group Information</h3>
    <h4>Manage</h4>
      <form action="grouplist.php">
        <button class="inputButton" style="width: 161px">View Groups</button>
      </form>
    <h4>Import</h4>
    <form action="">
      <button class="inputButton" style="width: 161px">NYI</button>
    </form>
    <h4>Export</h4>
      <form action="groupcsv.php" method="post">
        <input type="submit" value="Export Group List To CSV" class="inputButton">
      </form>
      <form action="grouppdf.php" method="post">
        <input type="submit" value="Export Group List To PDF" class="inputButton">
      </form>
  </li>
</ul>
<?php require "footer.php"; ?>
