<?php

session_start();
$url = $_SESSION["currenturl"];

//get inputs.
$username = $_POST['username'];
$password = $_POST['password'];

//avoid sql injection.
$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

//db connection.
require('dbConn.php');

//query.
$sql = "SELECT * FROM login WHERE uname='$username' AND pword='$password'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$_SESSION["userid"] = $row['userid'];
$_SESSION["uname"] = $row['uname'];
$_SESSION["usertype"] = $row['usertype'];
$type = $row['usertype'];

if ($row['uname'] == $username && $row['pword'] == $password) {
    if ($type == "admin") {
        echo("Logged in as admin. Welcome " . $row['uname']);
        header("location: ../AdminFunc/notification.php");
        die();
    } else if ($type == "researcher" || $type == "normal") {
        echo("Logged in as user. Welcome " . $row['uname']);
        if (preg_match('/index/', $url)) {
            header("location:../index.php?login=true");
            die();
        } else if (preg_match('/features/', $url)) {
            header("location:../CoreFunc/features.php?login=true");
            die();
        } else {
            header("location:../index.php?login=true");
            die();
        }
    }
} else {
    echo("Invalid username or password");
    if (preg_match('/index/', $url)) {
        header("location:../index.php?error=invalidunpw");
        die();
    } else if (preg_match('/features/', $url)) {
        header("location:../CoreFunc/features.php?error=invalidunpw");
        die();
    } else {
        header("location:../index.php?error=invalidunpw");
        die();
    }
}
?>