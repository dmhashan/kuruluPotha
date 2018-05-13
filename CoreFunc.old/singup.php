<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>Setting Up a BirdLife Account </title>
        <link rel="stylesheet" href="../css/sweetalert.css">
        <link rel="stylesheet" href="../css/SignUp.css">
        <link rel="stylesheet" href="../css/jquery-ui.css">
        <script src="../js/jquery.min.js1.11.3.js"></script>
        <script src="../js/jQueryv3.2.0.min.js"></script>
        <script src="../js/jquery-ui.min.js"></script>
    </head>

    <body onload="hhdPageLoad()">
        <!--Again Check get methord, email & username validation-->
        <?php
        if ($_SERVER["REQUEST_METHOD"] != "GET") {
            header("location: ../index.php?error=signupGet");
            die();
        }
        $preFname = ucwords(strtolower($_GET["preFname"]));
        $preLname = ucwords(strtolower($_GET["preLname"]));
        $preEmail = $_GET["preEmail"];
        $preUsername = $_GET["preUsername"];
        $prePassword = $_GET["prePassword"];

        require '../CommonFiles/dbConn.php';
        $sql_email = "SELECT * FROM userdetails WHERE email='$preEmail';";
        $result_email = mysqli_query($conn, $sql_email);
        if (mysqli_num_rows($result_email) > 0) {
            header("location: ../index.php?error=emailExit");
            die();
        }
        $sql_un = "SELECT * FROM login WHERE uname='$preUsername';";
        $result_un = mysqli_query($conn, $sql_un);
        if (mysqli_num_rows($result_un) > 0) {
            header("location: ../index.php?error=usernameExit");
            die();
        }
        ?>

        <!--Hidden Area-->
        <div id = "stepTwo" style = "display: none"></div>


        <br/><br/>
        <div class = "banner">Setting Up a BirdLife Account</div>
        <br/><br/>

        <!--multistep form -->
        <form id = "msform" action="singup_submit.php" method="POST" enctype="multipart/form-data">
            <!--progressbar -->
            <ul id = "progressbar">
                <li class = "active">Account Setup</li>
                <li>Account Type</li>
                <li>Social Profiles</li>

            </ul>
            <!--fieldsets -->
            <fieldset>
                <h2 class = "fs-title">Create your account</h2>
                <h3 class = "fs-subtitle" id="stepOneError">Confirm your deatils</h3>
                <input type = "text" name = "fname" id = "fname" placeholder = "First Name *" value = "<?php echo $preFname; ?>"/>
                <input type = "text" name = "lname" id = "lname" placeholder = "Last Name *" value = "<?php echo $preLname; ?>"/>
                <input disabled="disabled" type = "email" value = "<?php echo $preEmail; ?>"/>
                <input disabled="disabled" type = "text" value = "<?php echo $preUsername; ?>"/>
                <input type = "hidden" name = "email" id = "email" value = "<?php echo $preEmail; ?>"/>
                <input type = "hidden" name = "username" id = "username" value = "<?php echo $preUsername; ?>"/>
                <input type = "password" name = "password" id = "password" placeholder = "Confirm Password *"/>
                <input type = "button" class = "nextCheck action-button" name = "next" value = "Next" onclick = "stepOne()"/>
                <input type = "hidden" id = "nextOne" name = "next" class = "next action-button" value = "HiddenNext"/>
            </fieldset>
            <fieldset>
                <h2 class = "fs-title">Select account type</h2>
                <h3 class = "fs-subtitle" id="stepTwoError">You can register as normal user and reasearcher</h3>
                <select id = "accountSelect" name="accountSelect">
                    <option value="0" disabled>Select your Account Type</option>
                    <option value="normal" onclick = "javascript:clickNormal();">Normal User</option>
                    <option value="researcher" onclick = "javascript:clickResearcher();">Researcher</option>
                </select>
                <div id = "normalUserDiv" style = "display:none">
                    <input type = "text" name = "nic" id = "nic" placeholder = "NIC No" style="width: 49%; display: inline-block"/>
                    <input type = "date" id = "datepicker" name = "gplus" placeholder = "Birthday" style="width: 49%; display: inline-block" />
                    <input type = "text" name = "occupation" id = "occupation" placeholder = "Occupation" />
                    <input type = "text" name = "number" id = "number" placeholder = "Contact Number" />
                    
                </div>
                <div id = "researcherDiv" style = "display:none">
                    <input type = "text" name = "resid" id = "resid" placeholder = "Researcher ID*" style="width: 49%; display: inline-block"/>
                    <input type = "text" name = "resorg" id = "resorg" placeholder = "Organization*" style="width: 49%; display: inline-block"/>
                    <label style="font-size: 100%; color:gray ; font-family: montserrat; float: left">
                        Browse a certified document for researcher registration<input type="file" name="fileToUpload" id="fileToUpload">
                    </label>
                </div>
                <input type = "button" name = "previous" class = "previous action-button" value = "Previous" />
                <input type = "button" name = "next" class = "nextTwo action-button" value = "Next" onclick="stepTwo()"/>
                <input type = "hidden" id = "nextTwo" name = "next" class = "next action-button" value = "Next"/>
            </fieldset>

            <fieldset>
                <h2 class = "fs-title">Profile Picture</h2>
                <h3 class = "fs-subtitle">Upload your face here</h3>
                <center>
                    <div class="hhdcontainer" onclick="imageUploadClick()">
                        <img id="image_upload_preview" src="../img/user/propic.png" alt="your image" style="height: 220px; width: 220px; object-fit: cover"/>
                        <div class="overlay">
                            <div class="text" id="proPicId">Browse Profile Picture</div>
                        </div>
                    </div>
                </center>
                <input style="display: none" type="file" onchange="loadFile(event)" name="imageToUpload" id="imageToUpload" accept="image/*">

                <input type = "button" name = "previous" class = "previous action-button" value = "Previous" />
                <input type = "button" class = "nextTwo action-button" name="Submit" value="Submit" onclick="signUpSubmit()"/>
            </fieldset>
        </form>
        <script src = "../js/jquery.easing.min.js" type = "text/javascript"></script>
        <script src="../js/SignUp.js"></script>
        <script src="../js/sweetalert.min.js"></script>

    </body>
</html>
