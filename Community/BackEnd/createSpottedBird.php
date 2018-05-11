<?php
/**
 * Created by PhpStorm.
 * User: imesh
 * Date: 2017-05-03
 * Time: 11:35 AM
 */

require('classes.php');

session_start();

$birdID = $_POST["sbid"];
$locationID = $_POST["slid"];
$photo = substr($_POST["sphoto"], 22);

$newSBird = new spottedBird;
$newSBird->addBird($birdID, $locationID, $photo);

?>