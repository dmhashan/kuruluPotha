<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $birdIds = $_POST['selectedBirdsId'];
    $nBirds = count($birdIds);
} else {
    header("location: ../checkList.php");
    die();
}

session_start();
if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
    $uname = $_SESSION["uname"];
    $user_type = $_SESSION["usertype"];
} else {
    header("location: ../../CommonFiles/logout.php");
    die();
}

ob_start();
require('./tool/fpdf.php');

$pdf = new FPDF('P', 'mm', 'A4');

//Page no 01
$pdf->AddPage();

function filter_html($value){
    $value = mb_convert_encoding($value, 'ISO-8859-1', 'UTF-8');
    return $value;
}

////Header
$pdf->SetFont('Arial', '', 20);

$pdf->MultiCell(190, 8, "\nKurulu Poth", "0", "L");
//$pdf->AddFont('sin','','1090_Puskola Potha 2010.php');
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(190, 8, "Sri Lankan largest E-Guidance system for Avitourism", "0", "L");
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(134, 189, 124);
$pdf->MultiCell(190, 5, "Develped by Uva Wellassa University, Badulla, Sri Lanka.", "0", "L", TRUE);
$pdf->Image("../../img/hhdmenu/bl_logo.png", 120, 8, 75);
//////
///User details
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->MultiCell(190, 8, "\nAuto generated bird's checklist report", "", "C");
$pdf->SetFont('Arial', '', 11);
$user_details = "User Name : " . $uname;
$user_details .= "\nUser Type : " . $user_type;
$user_details .= "\nDate Created : " . date("Y-m-d");
$user_details .= "\nTime Created : " . date("h:i:s a");
$user_details .= "\nNumber of birds : " . $nBirds;
$pdf->MultiCell(190, 6, $user_details, "1", "L");




#Check index
$birdIdsString = "";
foreach ($birdIds as &$value) {
    if ($birdIdsString === "") {
        $birdIdsString = $value;
    } else {
        $birdIdsString = $birdIdsString . "," . $value;
    }
}
require '../../CommonFiles/dbConn.php';
$birdIdssql = "SELECT * FROM birddetails WHERE birdid IN (" . $birdIdsString . ") ORDER BY commonname";
$birdIdsresult = mysqli_query($conn, $birdIdssql);
$pdf->SetFont('Arial', '', 14);
$pdf->MultiCell(190, 8, "\nBird's Index (Sorted according commanname)", "B", "C");
$pdf->SetFont('Arial', '', 11);
$count = 1;
if (mysqli_num_rows($birdIdsresult) > 0) {
    while ($birdIdsrow = mysqli_fetch_assoc($birdIdsresult)) {
        $pdf->MultiCell(190, 8, $count . ") " . $birdIdsrow['commonname']." (".$birdIdsrow['scientificname'].")", "0", "L");
        $count++;
    }
} else {
    $pdf->Cell(10, 8, "No data", 0);
}
$pdf->Output("report.pdf", "I", TRUE);
ob_end_flush();
?>

