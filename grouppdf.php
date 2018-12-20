<?php
session_start();

if ( !isset($_SESSION['STAFF_ID'])) {
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: stafflogin.php");
}	else {
	$id = $_SESSION['STAFF_ID'];
	$staff_firstname = $_SESSION['STAFF_FIRSTNAME'];
	$staff_lastname = $_SESSION['STAFF_LASTNAME'];
}

require_once "connectdb.php";
require_once "../TCPDF/tcpdf.php";
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("Student Groups List");
$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->setDefaultMonospacedFont('helvetica');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
$obj_pdf->setPrintHeader(false);
$obj_pdf->setPrintFooter(false);
$obj_pdf->SetAutoPageBreak(TRUE, 10);
$obj_pdf->SetFont('helvetica', '', 11);
$obj_pdf->AddPage();
$content = '';
$content .= '
<h4>Student Groups List</h4>
<table border="1" cellspacing="0" cellpadding="3">
  <tr>
    <th>Student ID</th>
    <th>Student FirstName</th>
    <th>Student LastName</th>
    <th>Student Campus</th>
    <th>Student Email</th>
    <th>Project ID</th>
    <th>Project Name</th>
  </tr>
';

$sql = "SELECT groups.stu_ID, student.stu_FirstName, student.stu_LastName, student.stu_Campus, student.stu_Email, groups.pro_num, project.pro_title FROM ((groups INNER JOIN student ON groups.stu_ID=student.stu_ID) INNER JOIN project ON groups.pro_num=project.pro_num) ORDER BY pro_num ASC";
$result = mysqli_query($CON, $sql);
while($row = mysqli_fetch_array($result)) {
	switch ($row["stu_Campus"]) {
		case 1:
			$campus = "Burwood";
			break;
		case 2:
			$campus = "Geelong";
			break;
		case 3:
			$campus = "Cloud";
			break;
	}
$content .= '
  <tr>
    <td>'.$row["stu_ID"].'</td>
    <td>'.$row["stu_FirstName"].'</td>
    <td>'.$row["stu_LastName"].'</td>
    <td>'.$campus.'</td>
    <td>'.$row["stu_Email"].'</td>
    <td>'.$row["pro_num"].'</td>
    <td>'.$row["pro_title"].'</td>
  </tr>
  ';
}
$content .= '</table>';
$obj_pdf->writeHTML($content);
$obj_pdf->Output('file.pdf', 'I');
?>
