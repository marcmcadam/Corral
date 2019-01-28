<?php
    session_start();
    session_regenerate_id();  // prevention of session hijacking
    require "staffauth.php";
    require_once "connectdb.php";
    require_once "unitdata.php";
    require_once "getfunctions.php";
    require_once "TCPDF/tcpdf.php";

    $obj_pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, "UTF-8", false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("Project List");
    $obj_pdf->SetHeaderData("", "", PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, "", PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, "", PDF_FONT_SIZE_DATA));
    $obj_pdf->setDefaultMonospacedFont("helvetica");
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, "10", PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false);
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetFont("helvetica", "", 11);

    $unitData = unitData($unitID);
    $skillNames = $unitData->skillNames;
    $sort = $unitData->sort;
    $students = $unitData->students;
    $projects = $unitData->projects;
    $unassigned = $unitData->unassigned;

	$rows = [["ID", "Title", "Brief", "Supervisor", "Supervisor Email", "Relative Members"]];
	foreach ($projects as $project)
	{
		$row = [$project->id, $project->title, $project->brief, $project->leader, $project->email, $project->minimum];
		$rows[] = $row;
	}

	$obj_pdf->AddPage();
    ob_start();
	rowOutputPDF($rows);
	$obj_pdf->writeHTML(ob_get_contents());
	ob_clean();

    $obj_pdf->Output("$unitID-projects.pdf", "I");
?>
