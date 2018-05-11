<?php
/**
 * Created by PhpStorm.
 * User: imesh
 * Date: 2017-04-27
 * Time: 12:34 PM
 */

session_start();
if (!(isset($_SESSION["userid"]))) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>BirdLife | Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="../js/jquery.nicescroll.min.js"></script>
    <script src="../js/c_photoUpload.js"></script>
    <link rel="stylesheet" href="../css/c_custStyle.css">
    <link rel="stylesheet" href="../css/c_photoUpload.css">
    <link rel="stylesheet" href="../css/c_postArea.css">
    <link rel="stylesheet" href="../css/c_loader.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
</head>
<?php
require('../CommonFiles/dbConn.php'); //db connection.
require('BackEnd/classes.php');

$userid = $_SESSION["userid"];
$uname = $_SESSION["uname"];
$usertype = $_SESSION["usertype"];
$userImage = "../img/user/img-" . $userid . ".jpg";


//query.
$sqlUser = "SELECT * FROM userdetails WHERE userid='$userid';";


$resultUser = mysqli_query($conn, $sqlUser);

$rowUser = mysqli_fetch_array($resultUser);

$uFullName = ($rowUser['firstname'] . ' ' . $rowUser['lastname']);
?>

<body>
<input type="hidden" id="postNo" value="2">
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" style="height:80px;">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img class="navbar-brand" style="height:90%; padding:0 0 0 25px;" src="../img/hhdmenu/bl_logo.png">
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


            <ul class="nav navbar-nav navbar-right">
                <li><a href="../index.php" data-toggle="tooltip" title="Go Birding!"
                       style="padding:15px 20px 0 0 !important;"><img src="images/birding.png"></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false" style="padding:5px 0 0 0 !important;"><img
                            class="img-responsive img-circle" style="height:70px;" src="<?php echo $userImage ?>"></a>
                    <ul class="dropdown-menu">
                        <li><a href="../CoreFunc/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<div class="container">
<div class="row profile">
<div class="col-md-3">
    <div class="row">
        <div class="col-md-12">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="<?php echo $userImage ?>" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        <?php echo($rowUser['firstname'] . ' ' . $rowUser['lastname']); ?>
                    </div>
                    <div class="profile-usertitle-job">
                        <?php echo($rowUser['occupation']); ?>
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <!--  <button type="button" class="btn btn-success btn-sm">Follow</button>
                      <button type="button" class="btn btn-danger btn-sm">Message</button> -->
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li>
                            <a href="userMain.php">
                                <i class="glyphicon glyphicon-home"></i>
                                News Feed </a>
                        </li>
                        <li class="active">
                            <a href="">
                                <i class="glyphicon glyphicon-user"></i>
                                Account Settings </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <i class="glyphicon glyphicon-ok"></i>
                                Check List </a>
                        </li>
                        <li>
                            <a href="locSuggest.php">
                                <i class="glyphicon glyphicon-flag"></i>
                                Location Suggestions </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
    </div>
</div>
<div class="col-md-9">


<div class="row">
<div class="col-md-12">
<div id="form-container" class="profile-content news-feed">
<div class="well">
<div id="personalInfo">

    <h3>Edit Personal Information</h3>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <label for="fname" class="col-sm-4" style="padding-top:7px;">First
                    Name:</label>

                <div class="col-sm-8">
                    <input class="form-control" name="fname" id="fname" type="text"
                           value="<?php echo($rowUser['firstname']); ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <label for="lname" class="col-sm-4" style="padding-top:7px;">Last
                    Name:</label>

                <div class="col-sm-8">
                    <input class="form-control" name="lname" id="lname" type="text"
                           value="<?php echo($rowUser['lastname']); ?>">
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <label for="nic" class="col-sm-4"
                       style="padding-top:7px;">NIC:</label>

                <div class="col-sm-8">
                    <input class="form-control" name="nic" id="nic" type="text"
                           value="<?php echo($rowUser['nic']); ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <label for="occupation" class="col-sm-4"
                       style="padding-top:7px;">Occupation:</label>

                <div class="col-sm-8">
                    <input class="form-control" name="occupation" id="occupation" type="text"
                           value="<?php echo($rowUser['occupation']); ?>">
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <label for="email" class="col-sm-4" style="padding-top:7px;">E-Mail:</label>

                <div class="col-sm-8">
                    <input class="form-control" name="email" id="email" type="text"
                           value="<?php echo($rowUser['email']); ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <label for="mobile" class="col-sm-4" style="padding-top:7px;">Mobile No:</label>

                <div class="col-sm-8">
                    <input class="form-control" name="mobile" id="mobile" type="text"
                           value="<?php echo($rowUser['mobile']); ?>">
                </div>
            </div>
        </div>
    </div>
    <br>

    <div>
        <div class="row">
            <label for="byear" class="col-sm-4"
                   style="padding-top:7px;">Date of Birth:</label><br>
        </div>
        <div class="row">
            <div class="col-md-4">
                <select class="form-control" placeholder="Please Select..." name="byear" id="byear"
                        style="width:100%; float:left; margin-top:10px;">
                    <?php

                    $userBdate = DateTime::createFromFormat("Y-m-d", $rowUser['dob']);
                    $byear = $userBdate->format('Y');
                    $bmonth = $userBdate->format('m');
                    $bday = $userBdate->format('d');

                    $currentYear = date('Y');
                    foreach (range(1950, $currentYear) as $value) {
                        if ($byear == $value) {
                            $sel = 'selected';
                        } else {
                            $sel = '';
                        }
                        echo '<option value="' . $value . '" ' . $sel . '>' . $value . '</option > ';

                    }
                    ?>

                </select>
            </div>
            <div class="col-md-4">
                <select class="form-control" placeholder="Please Select..." name="bmonth" id="bmonth"
                        style="width:100%; float:left; margin-top:10px;">
                    <?php
                    foreach (range(1, 12) as $value) {
                        $month = date('F', mktime(0, 0, 0, $value, 10));

                        if ($bmonth == $value) {
                            $sel = 'selected';
                        } else {
                            $sel = '';
                        }

                        echo '<option value="' . $value . '" ' . $sel . '>' . $month . '</option > ';

                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-control" placeholder="Please Select..." name="bday" id="bday"
                        style="width:100%; float:left; margin-top:10px;">
                    <?php
                    foreach (range(1, 31) as $value) {
                        if ($bday == $value) {
                            $sel = 'selected';
                        } else {
                            $sel = '';
                        }
                        echo '<option value="' . $value . '" ' . $sel . '>' . $value . '</option > ';

                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <br>
</div>
<br>
<br>
<?php

if ($usertype == 'researcher') {

    ?>
    <div id="officialInfo">

        <h3> Official Information </h3>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <label for="offid" class="col-sm-4" style="padding-top:7px;"> Official ID:</label>

                    <div class="col-sm-8">
                        <input class="form-control" name="offid" id="offid" type="text">
                    </div>
                </div>
                <br>

                <div class="row">
                    <label for="org" class="col-sm-4" style="padding-top:7px;"> Organization:</label>

                    <div class="col-sm-8">
                        <input class="form-control" name="org" id="org" type="text">
                    </div>
                </div>
                <br>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="main-img-preview">
                        <img class="thumbnail img-preview"
                             src="<?php echo $userImage ?>"
                             title="Preview Image" style="max-height:255px;">
                    </div>
                    <div class="input-group">
                        <input id="fakeUploadLogo" class="form-control fake-shadow"
                               placeholder="Choose File" disabled="disabled" type="hidden">

                        <div class="input-group-btn">
                            <div class="fileUpload btn btn-success fake-shadow">
                                <span><i class="glyphicon glyphicon-upload"></i> Upload Image </span>
                                <input id="logo-id" name="logo" type="file"
                                       class="attachment_upload">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
<?php
}
?>
<div class="row">
    <button type="button" class="btn btn-danger" id="btnApply" style="float:right;">Apply Changes</button>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</body>

<script>


    $(document).ready(function () {
        $("#form-container").niceScroll();
        $('[data-toggle="tooltip"]').tooltip({'placement': 'bottom'});


        $("#btnApply").click(function () {


            var vFname = $("#fname").val();
            var vLname = $("#lname").val();
            var vNic = $("#nic").val();
            var vOccu = $("#occupation").val();
            var vEmail = $("#email").val();
            var vMobile = $("#mobile").val();
            var vByear = $("#byear").val();
            var vBmonth = $("#bmonth").val();
            var vBday = $("#bday").val();
            /*var vOffId = $("#").val();
             var vOrg = $("#").val();
             var vCert = $("#").val();*/


            if (vFname == '' || vLname == '' || vNic == '' || vOccu == '' || vEmail == '' || vMobile == '' || vByear == '' || vBmonth == '' || vBday == '') {
                alert('Please fill the required fields.');
            }
            else if (!validateForm(vFname, vLname, vNic, vOccu, vEmail, vMobile)) {
            }

            else {

                $.post("BackEnd/applyAccChanges.php", {
                    fname: vFname,
                    lname: vLname,
                    nic: vNic,
                    occupation: vOccu,
                    email: vEmail,
                    mobile: vMobile,
                    byear: vByear,
                    bmonth: vBmonth,
                    bday: vBday
                }, alert('changes applied'));
            }
        })

        //validating the inputs at client side.
        function validateForm(fname, lname, nic, occupation, email, mobile) {
            var emailFilter = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            var textFilter = /^([a-zA-Z])+$/;
            var idFilter= /^([0-9]){9}([Vv])$/;
            var mobileFilter= /^([0-9]){10}$/;

            if (!emailFilter.test(email)) {
                alert('invalid email');
                return false;
            }
            else if (!textFilter.test(fname)) {
                alert('invalid name');
                return false;
            }
            else if (!textFilter.test(lname)) {
                alert('invalid name');
                return false;
            }
            else if (!textFilter.test(occupation)) {
                alert('invalid occupation');
                return false;
            }
            else if (!idFilter.test(nic)) {
                alert('invalid id');
                return false;
            }
            else if (!mobileFilter.test(mobile)) {
                alert('invalid mobile number');
                return false;
            }
            return true;

        }
    });


</script>
</html>