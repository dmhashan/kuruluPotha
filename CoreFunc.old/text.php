<?php

ob_start();
require('./tool/fpdf.php');

$pdf = new FPDF('P', 'mm', 'A4');

//Page no 01
$pdf->AddPage();

////Header
$pdf->SetFont('Arial', '', 20);
$pdf->MultiCell(190, 8, "\nKurulu Poth", "0", "L");
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(190, 8, "Sri Lankan largest E-Guidance system for Avitourism", "0", "L");
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(134, 189, 124);
$pdf->MultiCell(190, 5, "Develped by Uva Wellassa University, Badulla, Sri Lanka.", "0", "L", TRUE);
$pdf->Image("../img/hhdmenu/bl_logo.png", 120, 8, 75);
//////
///User details
if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
    $uname = $_SESSION["uname"];
} else {
    header("location: logout.php");
    die();
}


$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->MultiCell(190, 8, "\nAuto generated bird's checklist report", "", "C");
$pdf->SetFont('Arial', '', 11);
$pdf->MultiCell(190, 8, "User Name :" .$uname, "1", "L");


//$pdf->MultiCell(190, 60, "Body", "B");


$pdf->AddPage();
//$pdf->Cell(0, 15, $reportName, 0, 0, 'C');

$pdf->Output("report.pdf", "I");
ob_end_flush();
?>