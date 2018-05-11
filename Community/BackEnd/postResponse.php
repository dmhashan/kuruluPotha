<?php
/**
 * Created by PhpStorm.
 * User: imesh
 * Date: 2017-04-23
 * Time: 7:57 PM
 */

require('classes.php');
session_start();

$postID=$_POST["postid"];
$respType=$_POST["type"];

$newResponse= new response;
$newResponse->processResponse($postID,$respType);

?>

<?php