<!doctype html>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="CoreFunc/css/reset.css"> <!-- CSS reset -->
        <link rel="stylesheet" href="CoreFunc/css/style.css"> <!-- Resource style -->
        <link rel="stylesheet" href="CoreFunc/css/login.css"> <!-- Resource login -->
        <link rel="stylesheet" href="CoreFunc/css/hhdpopup.css"> <!-- Resource popup -->

        <script src="CoreFunc/js/jQueryv3.2.0.min.js"></script>
        <link rel="stylesheet" href="CoreFunc/css/error.css">
        <script src="CoreFunc/js/error.js"></script> <!-- error -->
        <script src="CoreFunc/js/modernizr.js"></script> <!-- Modernizr -->

        <title>BirdLife - Sri Lanka</title>

    </head>
    <body onload="countLoad()">
        <?php
        session_start();
        $_SESSION["currenturl"] = $_SERVER['REQUEST_URI'];
        if (isset($_SESSION["userid"])) {
            $userid = $_SESSION["userid"];
            $uname = $_SESSION["uname"];
            $userImage = "img/user/img-" . $userid . ".jpg";
        }
        ?>

        <header class="cd-main-header">
            <a class="cd-logo" href="index.php"><img src="img/hhdmenu/bl_logo.png" alt="Logo"></a>

            <ul class="cd-header-buttons">
                <div class="tooltip"><li><a class="cd-search-trigger" href="" <?php
                        if (isset($_SESSION["userid"])) {
                            echo 'style="background-image:url(' . $userImage . ') "';
                        }
                        ?> >UserName</a></li>
                        <?php
                        if (isset($_SESSION["userid"])) {
                            ?>
                        <span class="tooltiptext"><?php echo $uname; ?></span>
                        <?php
                    } else {
                        ?><span class="tooltiptext">Login</span><?php
                    }
                    ?>
                </div>
                <li><a class="cd-nav-trigger" href="#cd-primary-nav" >Menu<span></span></a></li>

            </ul> <!-- cd-header-buttons -->
        </header>

        <!--after menu-->
        <main class="cd-main-content">
            <?php
            if (!isset($_SESSION["userid"])) {
                ?>
                <!--login and signup part-->
                <section class="cd-hero">
                    <div class="cd-hero-content">
                        <!--login and signup floating part-->

                        <section class="hhd">
                            <table border="0">
                                <tbody>
                                <div class="form" align="right">

                                    <ul class="tab-group">
                                        <li class="tab active"><a href="#signup">Sign Up</a></li>
                                        <li class="tab"><a href="#login">Log In</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div id="signup">   
                                            <h1 id="error">Sign Up for Free</h1>

                                            <form id="preSignUp">
                                                <div class="top-row">
                                                    <div class="field-wrap">
                                                        <label id="labelFname">
                                                            First Name<span class="req">*</span>
                                                        </label>
                                                        <input type="text" name="preFname" id="preFname"/>
                                                    </div>

                                                    <div class="field-wrap">
                                                        <label id="labelLname">
                                                            Last Name<span class="req">*</span>
                                                        </label>
                                                        <input type="text" name="preLname" id="preLname"/>
                                                    </div>
                                                </div>

                                                <div class="field-wrap">
                                                    <label id="labelEmail">
                                                        Email Address<span class="req">*</span>
                                                    </label>
                                                    <input type="text" name="preEmail" id="preEmail"/>
                                                    <span style="display: none" id="email_status"></span>
                                                </div>

                                                <div class="field-wrap">
                                                    <label id="labelUsername">
                                                        Set a Username<span class="req">*</span>
                                                    </label>
                                                    <input type="text" name="preUsername" id="preUsername">
                                                    <span style="display: none" id="un_status"></span>
                                                </div>

                                                <div class="field-wrap">
                                                    <label id="labelPassword">
                                                        Set a Password<span class="req">*</span>
                                                    </label>
                                                    <input type="password" name="prePassword" id="prePassword">
                                                </div>
                                                <input type="button" value="Get Started" class="button button-block" onclick="preSubmit()"/>

                                            </form>
                                        </div>

                                        <div id="login">   
                                            <h1>Welcome Back!</h1>

                                            <form action="CommonFiles/login.php" method="post">

                                                <div class="field-wrap">
                                                    <label>
                                                        Username<span class="req">*</span>
                                                    </label>
                                                    <input type="text" required autocomplete="off" name="username"/>
                                                </div>

                                                <div class="field-wrap">
                                                    <label>
                                                        Password<span class="req">*</span>
                                                    </label>
                                                    <input type="password"required autocomplete="off" name="password"/>
                                                </div>

                                                <p class="forgot"><a href="CoreFunc/forgotPassword.php?stepOne=go">Forgot Password?</a></p>

                                                <button class="button button-block"/>Log In</button>
                                            </form>
                                        </div>
                                    </div><!-- tab-content -->
                                </div> <!-- /form -->
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section> <!-- .cd-hero -->
            <?php } ?>

            <script src='CoreFunc/js/jquery-3.1.1.min.js'></script>
            <script src="CoreFunc/js/login.js"></script>
            <center>
                <!-- body -->
                <div style="width: 80%">
                    <img src="img/hhdmenu/bl_logo.png">
                    <p style="border-bottom: 2px solid #006600; font-size: 36px; color: #006600">Contact us</p>
                    <p style="margin-top: 10px; font-size: 24px">email - <a href="https://mail.google.com/">kurulupotha@gmail.com</a></p>
                </div>
                <?php
                if (isset($_SESSION["userid"])) {
                    ?>
                    <div style="width: 80%; margin-top: 50px; background: silver">
                        <table border="0">

                            <tbody>
                                <tr>
                                    <td style="float: left">
                                        <img src="img/index/37ff319a28d6a651a6fa7a95bacaa58b.png" style="width: 400px; padding-top: 20px">
                                    </td>
                                    <td style="float: left">
                                        <br><br>
                                        <h1 style="float: top; font-size: 36px">Send me your feedback</h1>
                                        <br>
                                        <form action="CoreFunc/php/feedback.php" method="POST">
                                            <input type="hidden" name="userid" value="<?php echo $_SESSION["userid"]; ?>" />
                                            <textarea name="feedback" rows="8" cols="60">
                                            </textarea>
                                            <br><br>
                                            <input type="submit" value="Send" style="float: right; width: 100px; height:40px; background: #006600"/>
                                        </form>
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                        <br><br>
                    </div>
                    <?php
                }
                ?>

            </center>
        </main>
        <!--Script for hide menu items-->
        <script>
                                                function hideall() {
                                                    $('.cd-overlay').removeClass('is-visible');//green overlay only
                                                    $('.cd-nav-trigger').removeClass('nav-is-visible');//other mobile components
                                                    $('.cd-main-header').removeClass('nav-is-visible');
                                                    $('.cd-primary-nav').removeClass('nav-is-visible');
                                                    $('.has-children ul').addClass('is-hidden');
                                                    $('.has-children a').removeClass('selected');
                                                    $('.moves-out').removeClass('moves-out');
                                                    $('.cd-main-content').removeClass('nav-is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
                                                        $('body').removeClass('overflow-hidden');
                                                    });
                                                }
        </script>

        <div class="cd-overlay"></div>

        <nav class="cd-nav">
            <ul id="cd-primary-nav" class="cd-primary-nav is-fixed">
                <li class="has-children">
                    <a>About</a>
                    <ul class="cd-nav-icons is-hidden">
                        <li class="go-back"><a href="#0">Menu</a></li>
                        <li>
                            <a class="cd-nav-item item-1" onclick="hideall()" href="index.php#des">
                                <h3>What is Kurulu Potha?</h3>
                                <p>Sri Lankan Largest Birdering Web Application</p>

                            </a>
                        </li>

                        <li>
                            <a class="cd-nav-item item-2" onclick="hideall()" href="index.php#pro">
                                <h3>What we provide?</h3>
                                <p>We are providing smart way to enjoy bird watching</p>
                            </a>
                        </li>

                        <li>
                            <a class="cd-nav-item item-3" onclick="hideall()" href="index.php#who">
                                <h3>Who can join with us?</h3>
                                <p>Join with us for not only study, For enjoy nature</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-children">

                    <a>Avitourism</a>
                    <ul class="cd-nav-icons is-hidden">
                        <li class="go-back"><a href="#0">Menu</a></li>
                        <li>
                            <a class="cd-nav-item item-4" onclick="hideall()" href="avitourism.php#avi">
                                <h3>What is avitourism?</h3>
                                <p>Avitourism is not only study</p>
                            </a>
                        </li>

                        <li>
                            <a class="cd-nav-item item-5" onclick="hideall()" href="avitourism.php#sl">
                                <h3>Why it is important for Sri Lanka?</h3>
                                <p>Sri Lanka is the best place for bird watchers</p>
                            </a>
                        </li>

                        <li>
                            <a class="cd-nav-item item-6" onclick="hideall()" href="avitourism.php#tip">
                                <h3>Birding Instruction & Tips</h3>
                                <p>Positive minds live positive lives</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="has-children">
                    <a>Features</a>
                    <ul class="cd-nav-icons is-hidden">
                        <li class="go-back"><a href="#0">Menu</a></li>
                        <li class="see-all"><a href="">Key to Entries</a></li>
                        <li>
                            <a class="cd-nav-item item-7" onclick="hideall()" href="CoreFunc/features.php?slide=1">
                                <h3>Bird Search by name</h3>
                                <p>You Know My Name, Click me, Search me</p>
                            </a>
                        </li>

                        <li>
                            <a class="cd-nav-item item-8" onclick="hideall()" href="CoreFunc/features.php?slide=2">
                                <h3>Identify birds</h3>
                                <p>Don't worry about my name, Select my attributes</p>
                            </a>
                        </li>
                        <?php
                        if (isset($_SESSION["userid"])) {
                            ?>
                            <li>
                                <a class="cd-nav-item item-9" onclick="hideall()" href="CoreFunc/features.php?slide=4">
                                    <h3>Get location suggestions</h3>
                                    <p>We will suggest you the places</p>
                                </a>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li>
                                <a class="cd-nav-item item-10" onclick="hideall()" href="CoreFunc/features.php?slide=3">
                                    <h3>Describe about bird</h3>
                                    <p>Say us, which characteristics you saw</p>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>

                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul> <!-- primary-nav -->
        </nav> <!-- cd-nav -->

        <?php
        if (isset($_SESSION["userid"])) {
            ?>
            <div id="cd-search" class="cd-search">
                <input type="submit" value="View Wall" />
                <input type="submit" value="View Profile" />
                <form action="CoreFunc/checkList.php" method="POST"><input type="submit" value="View Check List" /></form>
                <form action="CommonFiles/logout.php" method="POST"><input type="submit" value="Logout" /></form>
            </div>

        <?php } else { ?>
            <div id="cd-search" class="cd-search">
                <form action="CommonFiles/login.php" method="POST">
                    <input placeholder="User Name" type="text" required autocomplete="off" name="username"/>
                    <input placeholder="Password" type="password" required autocomplete="off" name="password"/>
                    <input type="submit" value="Login" />
                </form>
            </div>
        <?php } ?>
        <script src="CoreFunc/js/main.js"></script> <!-- Resource jQuery -->

        <!-- Scolling Code -->
        <script src="CoreFuncjs/scrolling_jquery.js"></script>
        <script>
                                // Select all links with hashes
                                $('a[href*="#"]')
                                        // Remove links that don't actually link to anything
                                        .not('[href="#"]')
                                        .not('[href="#0"]')
                                        .click(function (event) {
                                            // On-page links
                                            if (
                                                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                                                    &&
                                                    location.hostname == this.hostname
                                                    ) {
                                                // Figure out element to scroll to
                                                var target = $(this.hash);
                                                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                                                // Does a scroll target exist?
                                                if (target.length) {
                                                    // Only prevent default if animation is actually gonna happen
                                                    event.preventDefault();
                                                    $('html, body').animate({
                                                        scrollTop: target.offset().top
                                                    }, 1000, function () {
                                                        // Callback after animation
                                                        // Must change focus!
                                                        var $target = $(target);
                                                        $target.focus();
                                                        if ($target.is(":focus")) { // Checking if the target was focused
                                                            return false;
                                                        } else {
                                                            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                                            $target.focus(); // Set focus again
                                                        }
                                                        ;
                                                    });
                                                }
                                            }
                                        });
                                //# sourceURL=pen.js
        </script>
        <!--error-->
        <?php
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                $msg = "";
                if ($error === "signupGet") {
                    $msg = "Try again, Signup Data Transfer Error";
                } else if ($error === "emailExit") {
                    $msg = "Try again, Email already exists";
                } else if ($error === "usernameExit") {
                    $msg = "Try again, Username already exists";
                } else if ($error === "logagain") {
                    $msg = "You are not login with the system";
                } else if ($error === "invalidunpw") {
                    $msg = "Invalid username or password";
                } else if ($error === "unknown") {
                    $msg = "Try again, Unknown error";
                } else if ($error === "expired") {
                    $msg = "Link has been expired";
                } else {
                    $msg = "Try again, Unknown error";
                }
                ?>
                <div class="msgoverlay" id="msgoverlay" onclick="msgclose()"> 
                    <br>
                    <div class="notify errorbox" style="background-image: url('img/msgBox/error.png')">
                        <p><?php echo $msg; ?></p>
                        <p style="border: 0px; font-size: 15px" id="countdiv" > </p>
                    </div>        
                </div>
                <?php
            } else if (isset($_GET['success'])) {
                $succ = $_GET['success'];
                if ($succ === "pwchange") {
                    $msg = "Password change has been done successfully!";
                } else {
                    $msg = "successfully done the work!";
                }
                ?>
                <div class="msgoverlay" id="msgoverlay" onclick="msgclose()"> 
                    <br>
                    <div class="notify errorbox" style="background-image: url('img/msgBox/check.png')">
                        <p><?php echo $msg; ?></p>
                        <p style="border: 0px; font-size: 15px" id="countdiv" > </p>
                    </div>        
                </div>
                <?php
            } else if (isset($_GET['check'])) {
                $check = $_GET['check'];
                if ($check === "mail") {
                    $msg = "Reset information will be send into your email, check it.";
                } else {
                    $msg = "Check the changes you done.";
                }
                ?>
                <div class="msgoverlay" id="msgoverlay" onclick="msgclose()"> 
                    <br>
                    <div class="notify errorbox" style="background-image: url('img/msgBox/check.png')">
                        <p><?php echo $msg; ?></p>
                        <p style="border: 0px; font-size: 15px" id="countdiv" > </p>
                    </div>        
                </div>
                <?php
            }
        }
        ?>
    </body>
</html>