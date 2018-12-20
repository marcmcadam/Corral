<?php
session_start();

if ( !isset($_SESSION['STAFF_ID'])) {
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: stafflogin.php");
	}
	else {
	$id = $_SESSION['STAFF_ID'];
	$staff_firstname = $_SESSION['STAFF_FIRSTNAME'];
	$staff_lastname = $_SESSION['STAFF_LASTNAME'];
	}

$view = ["All", "Active","Inactive","Planning","Cancelled"];
if(isset($_POST['View']) && in_array($_POST['View'], $view)) {
	require_once "connectdb.php";
	require_once "TCPDF/tcpdf.php";
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$obj_pdf->SetTitle("Project Results");
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
	<h4>Project Results</h4>
	<table border="1" cellspacing="0" cellpadding="3">
		<tr>
			<th>Project Title</th>
			<th>Project Brief</th>
			<th>Project Leader</th>
			<th>Project Email</th>
			<th>Project Status</th>
		</tr>
	';

	$status = $_POST['View'];
	if ($status == "All"){
		$sql = "SELECT pro_title, pro_brief, pro_leader, pro_email, pro_status FROM project ORDER BY FIELD(pro_status, 'Active', 'Planning', 'Inactive', 'Cancelled'), pro_title ASC";
	} else {
		$sql = "SELECT pro_title, pro_brief, pro_leader, pro_email, pro_status FROM project WHERE pro_status = '".$status."' ORDER BY FIELD(pro_status, 'Active', 'Planning', 'Inactive', 'Cancelled'), pro_title ASC";
	}
	$result = mysqli_query($CON, $sql);
	while($row = mysqli_fetch_array($result)) {
		$content .= '
			<tr>
				<td>'.$row["pro_title"].'</td>
				<td>'.$row["pro_brief"].'</td>
				<td>'.$row["pro_leader"].'</td>
				<td>'.$row["pro_email"].'</td>
				<td>'.$row["pro_status"].'</td>
			</tr>
		';
	}
	$content .= '</table>';
	$obj_pdf->writeHTML($content);
	$obj_pdf->Output('file.pdf', 'I');
}
?>
