<?php
    session_start();
    $PageTitle = "Group List";
    require "staffauth.php";
    require_once "connectdb.php";
    require_once "unitdata.php";
    require_once "getfunctions.php";
    require_once "TCPDF/tcpdf.php";

    $obj_pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, "UTF-8", false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("Student Groups List");
    $obj_pdf->SetHeaderData("", "", PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, "", PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, "", PDF_FONT_SIZE_DATA));
    $obj_pdf->setDefaultMonospacedFont("helvetica");
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, "10", PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false);
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetFont("helvetica", "", 11);
    ob_start();

    $unitData = unitData($unitID);
    $skillNames = $unitData->skillNames;
    $sort = $unitData->sort;
    $students = $unitData->students;
    $projects = $unitData->projects;
    $unassigned = $unitData->unassigned;
    
    // display projects
    foreach ($projects as $p => $project)
    {
        $obj_pdf->AddPage();
        $members = sizeof($project->studentIndices);
        echo '<table border="1px" cellspacing="0" cellpadding="4px" width="50%" style="text-align: center;">
                  <tr>
                      <th style="background-color: #404040; color: #ffffff;">Title</th>
                      <td style="text-align: left;">'.$project->title.'</td>
                  </tr><tr>
                      <th style="background-color: #404040; color: #ffffff;">Brief</th>
                      <td style="text-align: left;">'.$project->brief.'</td>
                  </tr><tr>
                      <th style="background-color: #404040; color: #ffffff;">Supervisor</th>
                      <td style="text-align: left;">'.$project->leader.'</td>
                  </tr><tr>
                      <th style="background-color: #404040; color: #ffffff;">Email</th>
                      <td style="text-align: left;">'.$project->email.'</td>
                  </tr><tr>
                      <th style="background-color: #404040; color: #ffffff;">Members</th>
                      <td style="text-align: left;">'.$members.'</td>
                  </tr>
              </table><br><br>';
        groupStudentTablePDF($students, $project->studentIndices);

        $obj_pdf->writeHTML(ob_get_contents());
        ob_clean();
    }

    $obj_pdf->Output("$unitID-groups.pdf", "I");
?>
