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
                    <h3>System Notification</h3>
                    <span class="label label-success">Researcher Approval</span>
                    <span class="label label-success">Feedback</span>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
