<?php

////POST Check//////
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location: ../index.php?error=signupGet");
    die();
}
///////////////////

$firstName = ucwords(strtolower($_POST["fname"]));
$lastName = ucwords(strtolower($_POST["lname"]));
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
echo " <br>#1 " . $firstName . " # " . $lastName . " # " . $email . " # " . $username . " # " . $password;

$accountType = $_POST["accountSelect"];
$nic = $_POST["nic"];
$occupation = $_POST["occupation"];
$number = $_POST["number"];
$preDate = $_POST["gplus"];
$bday = date("Y-m-d", strtotime($preDate));
$resid = $_POST["resid"];
$resorg = $_POST["resorg"];
echo " <br>#2 " . $accountType . " # " . $nic . " # " . $occupation . " # " . $number . " # " . $bday;

$loginOK = FALSE;
$imageOK = FALSE;
$docOK = FALSE;

if (isset($_FILES["fileToUpload"]["tmp_name"])) {
    echo ' <br>#3 Document Ok # ' . $_FILES["fileToUpload"]["name"] . ' # ' . $_FILES["fileToUpload"]["tmp_name"];
}

if (isset($_FILES["imageToUpload"]["tmp_name"])) {
    echo ' <br>#4 Image Ok # ' . $_FILES["imageToUpload"]["name"] . ' # ' . $_FILES["imageToUpload"]["tmp_name"];
}


require '../CommonFiles/dbConn.php';

/////Email Username Check/////
$sql_email = "SELECT * FROM userdetails WHERE email='$email';";
$result_email = mysqli_query($conn, $sql_email);
if (mysqli_num_rows($result_email) > 0) {
    header("location: ../index.php?error=emailExit");
    die();
}
$sql_un = "SELECT * FROM login WHERE uname='$username';";
$result_un = mysqli_query($conn, $sql_un);
if (mysqli_num_rows($result_un) > 0) {
    header("location: ../index.php?error=usernameExit");
    die();
}
//////////////////////////////
/////inser into userdetails
$sqluserdetails = "INSERT INTO userdetails "
        . "(firstname, lastname, nic, dob, occupation, mobile, email) "
        . "VALUES "
        . "('$firstName','$lastName','$nic','$bday','$occupation','$number','$email');";
mysqli_query($conn, $sqluserdetails);
$id = mysqli_insert_id($conn);

if ($id > 0) {

    //////insert into login 
    $sqllogin = "INSERT INTO login "
            . "(uname,userid,pword,usertype,activated,blocked) "
            . "VALUES "
            . "('$username','$id','$password','$accountType','0','0');";
    $succ = mysqli_query($conn, $sqllogin);
    if ($succ > 0) {
        echo 'Userdetails and login updated successfullt';
        $loginOK = TRUE;
    }

    ///////upload photo
    $target_imdir = "../img/user/";
    $target_imname = 'img-' . $id . '.jpg';
    $target_imfile = $target_imdir . basename($target_imname);
    $uploadOk = 1;
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_imfile)) {
            echo "The file " . basename($_FILES["imageToUpload"]["name"]) . " has been uploaded.";
            $sqlpropic = "UPDATE userdetails SET propic = '$target_imname' WHERE userid = '$id';";
            $succpropic = mysqli_query($conn, $sqlpropic);
            if ($succpropic > 0) {
                echo 'Image OK';
                $imageOK = TRUE;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


    ////////Document Upload
    if ($accountType === "researcher") {
        $target_dir = "../document/";
        $file_extension = pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION);
        $target_file = $target_dir . 'doc-' . $id . '.' . $file_extension;
        $uploadOk = 1;
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 100000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                $doc_name = 'doc-' . $id . '.' . $file_extension;
                $sqldoc = "INSERT INTO researcher "
                        . "(resid, userid, resorg, rescert) "
                        . "VALUES "
                        . "('$resid','$id','$resorg','$doc_name');";
                $docsucc = mysqli_query($conn, $sqldoc);
                if ($docsucc > 0) {
                    echo 'Doc OK';
                    $docOK = TRUE;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $docOK = TRUE;
    }
}

if ($loginOK && $imageOK && $docOK) {
    if ($accountType === "normal") {
        header("location: ../index.php?success=normalAcc");
        die();
    } else if ($accountType === "researcher") {
        header("location: ../index.php?success=researcherAcc");
        die();
    } else {
        header("location: ../index.php?error=unknown");
        die();
    }
} else {
    header("location: ../index.php?error=unknown");
    die();
}