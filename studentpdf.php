<?php
session_start();
require "getfunctions.php";
require "staffauth.php";

require_once "connectdb.php";
require_once "TCPDF/tcpdf.php";
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("Student List");
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
<h4>Student List</h4>
<table border="1" cellspacing="0" cellpadding="3">
	<tr>
		<th>Student ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Campus</th>
		<th>Email</th>
	</tr>
';

$sql = "SELECT stu_ID, stu_FirstName, stu_LastName, stu_Campus, stu_Email FROM student";
$result = mysqli_query($CON, $sql);
while($row = mysqli_fetch_array($result)) {
	$campus = getcampus($row["stu_Campus"]);
$content .= '
		<tr>
			<td>'.$row["stu_ID"].'</td>
			<td>'.$row["stu_FirstName"].'</td>
			<td>'.$row["stu_LastName"].'</td>
			<td>'.$campus.'</td>
			<td>'.$row["stu_Email"].'</td>
		</tr>
	';
}
$content .= '</table>';
$obj_pdf->writeHTML($content);
$obj_pdf->Output('file.pdf', 'I');
?>
