<?php

session_start();
$url = $_SESSION["currenturl"];
session_destroy();
if (preg_match('/index/',$url)) {
    header("location:../index.php?error=logagain");
    die();
} else if (preg_match('/features/',$url)) {
    header("location:../CoreFunc/features.php?error=logagain");
    die();
} else {
    header("location:../index.php?error=logagain");
    die();
}
?>