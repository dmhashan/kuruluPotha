<!doctype html>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
        <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
        <link rel="stylesheet" href="css/birddetails.css"> <!-- birddetails -->

        <style>
            .checkList {
                border-collapse: collapse;
                width: 95%;

            }

            .checkList th, .checkList td {
                text-align: left;
                padding: 10px;
                vertical-align: middle;
            }

            .checkList tr:nth-child(even){background-color: #f2f2f2}

            .checkList th {
                background-color: #4CAF50;
                color: white;
            }
        </style>

        <script src="js/modernizr.js"></script> <!-- Modernizr -->
        <script src="js/feature.js"></script>

        <title>BirdLife - Sri Lanka</title>
    </head>
    <body onload="displayBirds()">
        <?php
        session_start();
        $_SESSION["currenturl"] = $_SERVER['REQUEST_URI'];
        if (isset($_SESSION["userid"])) {
            $userid = $_SESSION["userid"];
            $uname = $_SESSION["uname"];
            $userImage = "../img/user/img-" . $userid . ".jpg";
        } else {
            header("location: ../CommonFiles/logout.php");
            die();
        }
        ?>

        <header class="cd-main-header">
            <a class="cd-logo" href="../index.php"><img src="../img/hhdmenu/bl_logo.png" alt="Logo"></a>

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
            <center>
                <div style="height: 5vh"></div>
                <form action="php/checkListPrint.php" method="POST">
                    <table class="checkList">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Details</th>
                                <th>Shape/Size</th>
                                <th>The Red List Index</th>
                                <th>Location Map</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require('../CommonFiles/dbConn.php');
                            $sql = "SELECT * FROM birddetails WHERE birdid IN (SELECT birdid FROM checklist WHERE userid = " . $userid . ") ORDER BY commonname";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                $count = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><input id="checkbox" onclick="checkClick()" type="checkbox" name="selectedBirdsId[]" value="<?php echo $row['birdid']; ?>" checked="checked" /> <?php echo $count; ?></td>
                                        <td><img style="width: 100px; height: 100px; object-fit: contain" src="../img/birds/<?php echo $row['birdid']; ?>-1.png" ></td>
                                        <td><?php echo $row['commonname'] . "<br>" . $row['sinhalaname'] . "<br>" . $row['scientificname'] . "<br>" . $row['othername']; ?></td>
                                        <td><?php echo $row['details']; ?></td>
                                        <td><?php echo $row['shapeid'] . " / " . $row['size']; ?></td>
                                        <td><?php echo $row['redlistid']; ?></td>
                                        <td><?php echo 'Location'; ?></td>
                                    </tr>
                                    <?php
                                    $count++;
                                }
                            } else {
                                $empty_bird = TRUE;
                                ?>
                                <tr>
                                    <td colspan="6"> <center>Empty Check List Iteams</center> </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                        <script>
                            function checkClick() {
                                var checkbox = document.getElementsByName('selectedBirdsId[]');
                                var ln = 0;
                                for (var i = 0; i < checkbox.length; i++) {
                                    if (checkbox[i].checked)
                                        ln++
                                }
                                if (ln < 1) {
                                    document.getElementById('checkbox').checked = true;
                                }
                            }
                        </script>
                    </table>
                    <?php
                    if (isset($empty_bird)) {
                        if ($empty_bird) {
                            echo '<input disabled="disabled" type = "submit" value = "Print Check List" />';
                        } else {
                            echo '<input type = "submit" value = "Print Check List" />';
                        }
                    } else {
                        echo '<input type = "submit" value = "Print Check List" />';
                    }
                    ?>

                </form>
            </center>
        </main>
        <script src='js/jquery-3.1.1.min.js'></script>
        <!--Script for hide menu items-->
        <div class="cd-overlay"></div>

        <nav class="cd-nav">
            <ul id="cd-primary-nav" class="cd-primary-nav is-fixed">
                <li class="has-children">
                    <a>About</a>
                    <ul class="cd-nav-icons is-hidden">
                        <li class="go-back"><a href="#0">Menu</a></li>
                        <li>
                            <a class="cd-nav-item item-1" onclick="hideall()" href="../index.php#des">
                                <h3>What is Kurulu Potha?</h3>
                                <p>Sri Lankan Largest Birdering Web Application</p>

                            </a>
                        </li>

                        <li>
                            <a class="cd-nav-item item-2" onclick="hideall()" href="../index.php#pro">
                                <h3>What we provide?</h3>
                                <p>We are providing smart way to enjoy bird watching</p>
                            </a>
                        </li>

                        <li>
                            <a class="cd-nav-item item-3" onclick="hideall()" href="../index.php#who">
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
                            <a class="cd-nav-item item-4" onclick="hideall()" href="../avitourism.php#avi">
                                <h3>What is avitourism?</h3>
                                <p>Avitourism is not only study</p>
                            </a>
                        </li>

                        <li>
                            <a class="cd-nav-item item-5" onclick="hideall()" href="../avitourism.php#sl">
                                <h3>Why it is important for Sri Lanka?</h3>
                                <p>Sri Lanka is the best place for bird watchers</p>
                            </a>
                        </li>

                        <li>
                            <a class="cd-nav-item item-6" onclick="hideall()" href="../avitourism.php#tip">
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
                            <a class="cd-nav-item item-7" onclick="hideall()" href="features.php?slide=1">
                                <h3>Bird Search by name</h3>
                                <p>You Know My Name, Click me, Search me</p>
                            </a>
                        </li>

                        <li>
                            <a class="cd-nav-item item-8" onclick="hideall()" href="features.php?slide=2">
                                <h3>Identify birds</h3>
                                <p>Don't worry about my name, Select my attributes</p>
                            </a>
                        </li>
                        <?php
                        if (isset($_SESSION["userid"])) {
                            ?>
                            <li>
                                <a class="cd-nav-item item-9" onclick="hideall()" href="features.php?slide=4">
                                    <h3>Get location suggestions</h3>
                                    <p>We will suggest you the places</p>
                                </a>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li>
                                <a class="cd-nav-item item-10" onclick="hideall()" href="features.php?slide=3">
                                    <h3>Describe about bird</h3>
                                    <p>Say us, which characteristics you saw</p>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>

                <li><a href="../about.php">About Us</a></li>
                <li><a href="../contact.php">Contact Us</a></li>
            </ul> <!-- primary-nav -->
        </nav> <!-- cd-nav -->


        <?php
        if (isset($_SESSION["userid"])) {
            ?>
            <div id="cd-search" class="cd-search">
                <input type="submit" value="View Wall" />
                <input type="submit" value="View Profile" />
                <form action="checkList.php" method="POST"><input type="submit" value="View Check List" /></form>
                <form action="../CommonFiles/logout.php" method="POST"><input type="submit" value="Logout" /></form>
            </div>

        <?php } else { ?>
            <div id="cd-search" class="cd-search">
                <form action="../CommonFiles/login.php" method="POST">
                    <input type="text" placeholder="User Name" required autocomplete="off" name="username"/>
                    <input type="password" placeholder="Password" required autocomplete="off" name="password"/>
                    <input type="submit" value="Login" />
                </form>
            </div>
        <?php } ?>

        <script src="js/main.js"></script> <!-- Resource jQuery -->
        <script src="js/birddetails.js"></script>

        <script>
                                function gup(name)
                                {
                                    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
                                    var regexS = "[\\?&]" + name + "=([^&#]*)";
                                    var regex = new RegExp(regexS);
                                    var results = regex.exec(window.location.href);
                                    if (results == null)
                                        return "";
                                    else
                                        return results[1];
                                }
        </script>
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

    </body>
</html>