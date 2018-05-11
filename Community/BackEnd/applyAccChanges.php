<?php
/**
 * Created by PhpStorm.
 * User: imesh
 * Date: 2017-04-28
 * Time: 3:16 PM
 */

session_start();
require('../../CommonFiles/dbConn.php'); //db connection.

$uid=$_SESSION["userid"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$nic = $_POST["nic"];
$occu = $_POST["occupation"];
$email = $_POST["email"];
$mobile = $_POST["mobile"];
$byear = $_POST["byear"];
$bmonth=$_POST["bmonth"];
$bday = $_POST["bday"];

$dobLong= $byear.'-'.$bmonth.'-'.$bday;
$dob=date("Y-m-d", strtotime($dobLong));

$sql="UPDATE userdetails SET firstname='$fname', lastname='$lname', nic='$nic', dob='$dob', occupation='$occu', mobile='$mobile', email='$email'
      WHERE userid='$uid';";
if(mysqli_query($conn,$sql)){
    echo('Success');
}
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
