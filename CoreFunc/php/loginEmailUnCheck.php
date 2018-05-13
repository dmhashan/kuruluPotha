<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../../CommonFiles/dbConn.php';
if (isset($_GET['preEmail'])) {
    $preEmail = $_GET["preEmail"];
    $sql_email = "SELECT * FROM userdetails WHERE email='$preEmail';";
    $result_email = mysqli_query($conn, $sql_email);
    if (mysqli_num_rows($result_email) > 0) {
        echo "YESEMAIL";
    } else {
        echo "NOEMAIL";
    }
    exit();
}

if (isset($_GET['preUsername'])) {
    $preUsername = $_GET["preUsername"];

    $sql_un = "SELECT * FROM login WHERE uname='$preUsername';";
    $result_un = mysqli_query($conn, $sql_un);
    if (mysqli_num_rows($result_un) > 0) {
        echo "YESUN";
    } else {
        echo "NOUN";
    }
    exit();
}
