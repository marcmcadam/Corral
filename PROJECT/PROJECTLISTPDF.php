<?php
session_start();

if ( $_SESSION['STAFF_ID'] != 1) {
	$_SESSION['message'] = "You mus log in before viewing this page";
	header("location: ../ACCESS/error");
	}
	else {
	$id = $_SESSION['STAFF_ID'];
	$staff_firstname = $_SESSION['STAFF_FIRSTNAME'];
	$staff_lastname = $_SESSION['STAFF_LASTNAME'];
	}
function fetch_data()
{
require('../DATABASE/CONNECTDB.PHP');
	$Status = $_POST['View'];
	$output = "";
	if ($Status == "All"){
		$sql = "SELECT pro_num, pro_title, pro_brief, pro_leader, pro_email, pro_status FROM project";
	} else {
		$sql = "SELECT pro_num, pro_title, pro_brief, pro_leader, pro_email, pro_status FROM project WHERE pro_status = '".$Status."'";
	}
	$result = mysqli_query($CON, $sql);
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
				<td>'.$row["pro_num"].'</td>
				<td>'.$row["pro_brief"].'</td>
				<td>'.$row["pro_leader"].'</td>
				<td>'.$row["pro_status"].'</td>
			</tr>
		';
	}
	return $output;
}
if(isset($_POST['export_PDF']))
{
	require_once('../TCPDF/tcpdf.php');
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
			<th>Project Number</th>
			<th>Project Brief</th>
			<th>Project Leader</th>
			<th>Project Status</th>
		</tr>
	';
	$content .= fetch_data();
	$content .= '</table>';
	$obj_pdf->writeHTML($content);
	$obj_pdf->Output('file.pdf', 'I');
}

?>
