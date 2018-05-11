<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/birds.js"></script>
    </head>
    <body onload="firstLoad()">

        <div class="jumbotron text-center">
            <img src="../img/hhdmenu/bl_logo.png" style="width: 250px; float: left; margin-left: 60px; "/>
            <h2>Kurulu Potha System Administrator Panel</h2>
            <p>Sri Lankan Largest Web Apllication For Avitourism</p> 
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <h3>Main Menu</h3>
                    <a href="notification.php"><p>Notification</p></a>
                    <a href="birds.php"><p>Birds</p></a>
                    <a href="user.php"><p>Account</p></a>
                </div>
                <div class="col-sm-10">
                    <h3>Bird Details</h3>
                    <p style="background-color:silver ; padding: 5px">
                        <input type="text" onkeypress="birdSearch()" name="search_key" placeholder="Search Birds..." id="bird_search_key" size="50" />
                        <input onclick="birdSearch()" type="button" value="Search" />
                        <input onclick="addBird()" type="button" value="Add a bird" style="float: right"/>
                    </p>
                    <div id="birdNames">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>BirdID</th>
                                    <th>Names</th>
                                    <th>Show</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require '../CommonFiles/dbConn.php';
                                $sql_bird_details = "SELECT * FROM birddetails LIMIT 100";
                                $result_bird_details = mysqli_query($conn, $sql_bird_details);
                                if (mysqli_num_rows($result_bird_details) > 0) {
                                    while ($row_bird_details = mysqli_fetch_assoc($result_bird_details)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row_bird_details['birdid']; ?></td>
                                            <td><?php echo $row_bird_details['commonname'] . ', ' . $row_bird_details['sinhalaname'] . ', ' . $row_bird_details['scientificname'] . ', ' . $row_bird_details['othername']; ?></td>
                                            <td><a onclick="showbird(<?php echo $row_bird_details['birdid']; ?>)">Show</a></td>
                                            <td><a onclick="editbird(<?php echo $row_bird_details['birdid']; ?>)">Edit</a></td>
                                            <td><a onclick="deletebird(<?php echo $row_bird_details['birdid']; ?>)">Delete</a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                                </div>
                                </div>

                                </div>
                                </div>

                                </body>
                                </html>
