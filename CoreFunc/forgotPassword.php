<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>Forgot Password</title>
        <link rel="stylesheet" href="css/SignUp.css">
        <script src="js/forgotpw.js"></script>
    </head>
    <body>
        <br/><br/>
        <br/><br/>
        <br/><br/>
        <?php
        if (!isset($_GET['stepOne'])) {
            $id = $_GET['x'];
            $temppw = $_GET['y'];
            require '../CommonFiles/dbConn.php';
            $presql = "SELECT * FROM login WHERE userid=" . $id . " AND randpw='" . $temppw . "'";
            $preresult = mysqli_query($conn, $presql);
            if ($prerow = mysqli_fetch_assoc($preresult)) {
                $sql = "SELECT * FROM userdetails WHERE userid=" . $id;
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                ?>
                <form id = "msform" action = "php/unemailload.php" method = "POST">
                    <fieldset>
                        <h2 class = "fs-title">Setup New Password</h2>
                        <h3 class = "fs-subtitle" id="finalerror">Final Step</h3>
                        <div>
                            <img src="../img/user/img-<?php echo $row['userid']; ?>.jpg" style="width: 100px; height: 100px; border: 2px solid #69aa6f ;border-radius: 50%">
                            <p style="border-bottom: 2px solid #69aa6f; margin-top: 10px; margin-bottom: 20px"><?php echo $row['firstname'] . " " . $row['lastname']; ?></p>
                            <input type = "hidden" value="<?php echo $row['userid']; ?>" name = "id"/>
                            <input id="pw1" placeholder="New Password" type = "password" name = "newpw"/>
                            <input id="pw2" placeholder="Confirm New Password" type = "password" name = "conpw"/>
                            <br>
                            <input class="action-button" type = "button" onclick="subform()" value = "Confirm"/>
                            <input id="submitbttn" type = "submit" style="display: none"/>
                        </div>
                    </fieldset>
                </form>
                <?php
            } else {
                header("Location: ../index.php?error=expired");
                die();
            }
        } else {
            ?>
            <form id = "msform" action = "php/unemailload.php" method = "POST">
                <fieldset>
                    <h2 class = "fs-title">Forgot Password</h2>
                    <h3 class = "fs-subtitle">Step No 01</h3>
                    <div id = "userdetails">
                        <img src = "../img/user/propic.png" style = "width: 100px; height: 100px; border: 2px solid #69aa6f ;border-radius: 50%">
                        <p style = "border-bottom: 2px solid #69aa6f; margin-top: 10px">Enter your username or email address</p>
                        <input id = "unoremail" style = "text-align: center" type = "text" name = "username" value = "" onfocusout = "checkunemail()"/>
                        <input id = "subbutton" type = "button" value = "Confirm" disabled = "disabled"/>
                    </div>
                </fieldset>
            </form>
            <?php
        }
        ?>
    </body>
</html>
