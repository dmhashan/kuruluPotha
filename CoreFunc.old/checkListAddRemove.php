<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_GET['checkType']) && isset($_GET['userid']) && isset($_GET['birdid'])) {
    $checkType = $_GET['checkType'];
    $userid = $_GET['userid'];
    $birdid = $_GET['birdid'];
    require '../CommonFiles/dbConn.php';
    if ($checkType === "add") {
        $sql = "INSERT INTO checklist (userid, birdid) VALUES (" . $userid . ", " . $birdid . ")";
    } else if ($checkType === "remove") {
        $sql = "DELETE FROM checklist WHERE userid = " . $userid . " AND birdid = " . $birdid;
    } else {
        echo 'error';
    }
    $result = mysqli_query($conn, $sql);
    if ($data = mysqli_fetch_assoc($result)) {
        echo 'updated';
    }else{
        echo 'error';
    }
}