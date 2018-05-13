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

function filter_html($value) {
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
        $pdf->MultiCell(190, 8, $count . ") " . $birdIdsrow['commonname'] . " (" . $birdIdsrow['scientificname'] . ")", "0", "L");
        $count++;
    }
} else {
    $pdf->Cell(10, 8, "No data", 0);
}

//Full details
$birdIdsresult = mysqli_query($conn, $birdIdssql);
$count = 1;
if (mysqli_num_rows($birdIdsresult) > 0) {
    while ($birdsrow = mysqli_fetch_assoc($birdIdsresult)) {
        $sqlshape = "SELECT * FROM shape WHERE shapeid = " . $birdsrow['shapeid'];
        $resultshape = mysqli_query($conn, $sqlshape);
        $rowshape = mysqli_fetch_assoc($resultshape);
        $sqlredlist = "SELECT * FROM redlist WHERE redlistid = '" . $birdsrow['redlistid'] . "'";
        $resultredlist = mysqli_query($conn, $sqlredlist);
        $rowredlist = mysqli_fetch_assoc($resultredlist);
        $sqlEndemic = "SELECT * FROM location WHERE locationid IN (SELECT locationid FROM blss WHERE birdid=" . $birdsrow['birdid'] . " AND status=1)";
        $sqlResident = "SELECT * FROM location WHERE locationid IN (SELECT locationid FROM blss WHERE birdid=" . $birdsrow['birdid'] . " AND status=2)";
        $sqlMigrant = "SELECT * FROM location WHERE locationid IN (SELECT locationid FROM blss WHERE birdid=" . $birdsrow['birdid'] . " AND status=3)";
        $resultEndemic = mysqli_query($conn, $sqlEndemic);
        $resultResident = mysqli_query($conn, $sqlResident);
        $resultMigrant = mysqli_query($conn, $sqlMigrant);
        $endemicList = "";
        $residentList = "";
        $migrantList = "";
        while ($rowEndemic = mysqli_fetch_assoc($resultEndemic)) {
            if ($endemicList === "") {
                $endemicList = $rowEndemic['locationname'];
            } else {
                $endemicList = $endemicList . ", " . $rowEndemic['locationname'];
            }
        }
        while ($rowResident = mysqli_fetch_assoc($resultResident)) {
            if ($residentList === "") {
                $residentList = $rowResident['locationname'];
            } else {
                $residentList = $residentList . ", " . $rowResident['locationname'];
            }
        }
        while ($rowMigrant = mysqli_fetch_assoc($resultMigrant)) {
            if ($migrantList === "") {
                $migrantList = $rowMigrant['locationname'];
            } else {
                $migrantList = $migrantList . ", " . $rowMigrant['locationname'];
            }
        }

        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(190, 8, $count . ") " . $birdsrow['commonname'], "B", "L");
        $pdf->SetFont('Arial', '', 11);
        $pdf->MultiCell(120, 8, "Scientific Name - " . $birdsrow['scientificname'], "", "L");
        $pdf->Image("../../img/birds/" . $birdsrow['birdid'] . "-1.png", 120, 20,"",68);
        $pdf->MultiCell(120, 8, "Other Name - " . $birdsrow['othername'], "", "L");
        $pdf->MultiCell(120, 8, "Size - " . $birdsrow['size'], "", "L");
        $pdf->MultiCell(120, 8, "Shape - " . $rowshape['shapename'], "", "L");
        $pdf->MultiCell(120, 5, "\nRed List Category - " . $rowredlist['category'], "B", "L");
        $pdf->Image("../../img/birds/redList/" . $birdsrow['redlistid'] . ".png", 20, 63, 50);
        $pdf->MultiCell(190, 5, "\n\n\n\n\nDetails", "B", "L");
        $pdf->MultiCell(190, 8, $birdsrow['details'], "", "L");
        $pdf->MultiCell(190, 5, "\nLocation", "B", "L");
        if ($endemicList !== "") {
            $pdf->MultiCell(190, 8, "Endemic - " . $endemicList, "", "L");
        }
        if ($residentList !== "") {
            $pdf->MultiCell(190, 8, "Resident - " . $residentList, "", "L");
        }
        if ($migrantList !== "") {
            $pdf->MultiCell(190, 8, "Migrant - " . $migrantList, "", "L");
        }
        $count++;
        $pdf->MultiCell(190, 5, "\nNote", "B", "L");
        
    }
} else {
    $pdf->Cell(10, 8, "No data", 0);
}



$pdf->Output("report.pdf", "I", TRUE);
ob_end_flush();
?>

