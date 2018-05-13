<?php
	session_start();
	
	//get inputs.
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	//avoid sql injection.
	$username=stripcslashes($username);
	$password=stripcslashes($password);
	$username=mysql_real_escape_string($username);
	$password=mysql_real_escape_string($password);
	
	//db connection.
	require('../CommonFiles/dbConn.php');
	
	//query.
	$sql="SELECT * FROM login WHERE uname='$username' AND pword='$password'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	$_SESSION["userid"]=$row['userid'];
	$_SESSION["uname"]=$row['uname'];
    $_SESSION["usertype"]=$row['usertype'];
	$type=$row['usertype'];
	
	if($row['uname']==$username && $row['pword']==$password){
		if($type=="admin"){
			echo("Logged in as admin. Welcome ".$row['uname']);
			header("location: ../AdminFunc/main.php");
			die();
		}
		else if($type=="user"){
			echo("Logged in as user. Welcome ".$row['uname']);
			header("location: ../Community/userMain.php");
			die();
		}
	}else{
		echo("Invalid username or password");
                header("location: ../index.php?error=invalidunpw");
		die();
	}
	
?>