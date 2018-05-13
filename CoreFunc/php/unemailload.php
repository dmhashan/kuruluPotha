<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $unoremail = $_GET['unoremail'];
    //echo $unoremail;
    require '../../CommonFiles/dbConn.php';
    $sql = "SELECT * FROM userdetails WHERE email='$unoremail' OR userid IN (SELECT userid FROM login WHERE uname='$unoremail')";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        ?>
        <img src="../img/user/img-<?php echo $row['userid']; ?>.jpg" style="width: 100px; height: 100px; border: 2px solid #69aa6f ;border-radius: 50%">
        <p style="border-bottom: 2px solid #69aa6f; margin-top: 10px"><?php echo $row['firstname'] . " " . $row['lastname']; ?></p>
        <input type="hidden" name="userid" value="<?php echo $row['userid']; ?>" />
        <input type="hidden" name="useremail" value="<?php echo $row['email']; ?>" />
        <input style="width: 180px" id="subbutton" class="action-button" type = "submit" value = "Is this your account?"/>
        <input style="background-color: #880000" id="subbutton" class="action-button" type = "button" value = "No" onclick="window.location.reload()"/>
        <?php
    } else {
        ?>
        <img src="../img/user/propic.png" style="width: 100px; height: 100px; border: 2px solid #69aa6f ;border-radius: 50%">
        <p style="border-bottom: 2px solid #69aa6f; margin-top: 10px">Enter your username or email address</p>
        <input id="unoremail" style="text-align: center" type="text" name="username" value="" onfocusout="checkunemail()"/>
        <input id="subbutton" type = "button" value = "We can't find your account" disabled="disabled"/>
        <?php
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['userid']) && isset($_POST['useremail'])) {
        $userid = $_POST['userid'];
        $useremail = $_POST['useremail'];
        $temppw = generateRandomString();
        require '../../CommonFiles/dbConn.php';
        $sql = "UPDATE login SET randpw = '$temppw' WHERE userid=" . $userid;
        mysqli_query($conn, $sql);

        require_once('./tool/PHPMailer-master/PHPMailerAutoload.php');
        $mail = new PHPMailer;
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "kurulupotha@gmail.com";
        $mail->Password = "CST140014";
        $mail->SetFrom("admin@kurulupotha.com");
        $mail->FromName = "Kurulu Potha";

//To address and name
        $mail->addAddress($useremail);
        //$mail->addAddress($useremail);
        $mail->addReplyTo("kurulupotha@gmail.com", "Reply");
        $mail->isHTML(true);
        $mail->Subject = "Reset Your Password";
        $mail->Body = "Dear Customer, <br><br>We received a request to reset your password for your Kurulu Potha E-Guidance System account, We're here to help!<br>Simply click on this link follow instructions, <br><br><a href='http://localhost/KuruluPotha/CoreFunc/forgotPassword.php?x=" . $userid . "&y=" . $temppw . "'>here is the link</a> <br><br>If you didn't ask to change your password, don't worry! Your password is still safe and you can delete this email.<br>Kurulu Potha<br>Sri Lankan largest E-Guidance system for Avitourism";

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo 'Successfull';
            header("Location: ../../index.php?check=mail");
        }
    } else if (isset($_POST['id']) && isset($_POST['conpw'])) {
        $id = $_POST['id'];
        $pw = $_POST['conpw'];
        require '../../CommonFiles/dbConn.php';
        $sql = "UPDATE login SET randpw = '', pword='" . $pw . "' WHERE userid=" . $id;
        mysqli_query($conn, $sql);
        header("Location: ../../index.php?success=pwchange");
        die();
    } else {
        header("Location: ../../index.php?error=unknown");
        die();
    }
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>


