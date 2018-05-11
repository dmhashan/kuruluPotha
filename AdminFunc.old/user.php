<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Source/adminMenu.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <title>Administrator</title>
</head>
<body>
<div>
    <table>
        <tr>
            <td><img src="source/logo.png" alt="logo" style="width:170px;height:140px;"></td>
            <td><h1>Bird Watching</h1></td>
        </tr>
    </table>
    <font color="#00ff00"><b>Admin Dashboard / User</b></font>

</div>
<br>

<div class="col-2 menu">
    <ul>
        <a href="main.php"><li>Main</li></a>
        <a href="bird.php"><li>Bird</li></a>
        <a href="reseacher.php"><li>Reseacher</li></a>
        <li>User</li>
    </ul>
</div>
<form action="useroperations.php" method="post" >
<div class="col-5">
    <table>
        <tr>
            <select id="select_user" name="userdropdown">
                <?php
                //db connection
                require('dbConn.php');

                //query
                $sql="SELECT * FROM userdetails";
                $result=mysqli_query($conn,$sql);

                while($row=mysqli_fetch_array($result)) {
                    echo "<option value='".$row['userid']."'>".$row['firstname']."</option>";
                }
                echo "</select>";
                ?>
            </select>
        </tr>

        <div id="user_data">
            <!--Load data here-->
        </div>

        <tr>
            <td></td>
            <div class="button">
                <td>
                    <button type="submit" name="btn-adduser">Add</button>
                    <button type="submit" name="btn-edituser">Edit</button>
                    <button type="submit" name="btn-deleteuser">Delete</button>
                    <button type="submit" name="btn-clear">Clear</button>
                </td>
            </div>
        </tr>
    </table>
</div>
</form>
<script>
    $(document).ready(function(){

        $("#user_data").load("userdropdown.php",{"userdropdown":""});

        $("#select_user").change(function(){
            $.ajax({
                type: 'post',
                url: 'userdropdown.php',
                data:{
                    userdropdown:$("#select_user").find(":selected").val()
                },
                success:function(response){
                    document.getElementById("user_data").innerHTML=response
                }
            })
        })
    });
</script>
</body>
</html>