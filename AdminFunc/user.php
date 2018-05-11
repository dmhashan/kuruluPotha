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
                    <h3>Normal User Details</h3>
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>UserID</th>
                                <th>Names</th>
                                <th>email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require '../CommonFiles/dbConn.php';
                            $sql_normal = "SELECT * FROM userdetails WHERE userid IN (SELECT userid FROM login WHERE usertype='normal')";
                            $result_normal = mysqli_query($conn, $sql_normal);
                            while ($row_normal = mysqli_fetch_assoc($result_normal)) {
                                ?>
                                <tr>
                                    <td><?php echo $row_normal['userid']; ?></td>
                                    <td><?php echo $row_normal['firstname'] . ' ' . $row_normal['lastname']; ?></td>
                                    <td><?php echo $row_normal['email']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <h3>Researcher Details</h3>
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>UserID</th>
                                <th>Names</th>
                                <th>email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require '../CommonFiles/dbConn.php';
                            $sql_research = "SELECT * FROM userdetails WHERE userid IN (SELECT userid FROM login WHERE usertype='researcher')";
                            $result_research = mysqli_query($conn, $sql_research);
                            while ($row_research = mysqli_fetch_assoc($result_research)) {
                                ?>
                                <tr>
                                    <td><?php echo $row_research['userid']; ?></td>
                                    <td><?php echo $row_research['firstname'] . ' ' . $row_research['lastname']; ?></td>
                                    <td><?php echo $row_research['email']; ?></td>
                                </tr>
                                <?php
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
