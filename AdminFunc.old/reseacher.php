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
    <font color="#00ff00"><b>Admin Dashboard / Reseacher</b></font>
</div>
<br>

<div class="col-2 menu">
    <ul>
        <a href="main.php"><li>Main</li></a>
        <a href="bird.php"><li>Bird</li></a>
        <li>Reseacher</li>
        <a href="User.php"><li>User</li></a>
    </ul>
</div>
<form action="reseacheroperation.php" method="post">
<div class="col-5">
    <table>
        <tr>
            <select id="select_reseacher" name="reseacherdropdown">
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
        <div id="reseacher_data">
            <!--Load data here-->
        </div>
        <tr>
            <div class="button">
                <td>
                    <button type="submit" name="btn-addreseacher">Add</button>
                    <button type="submit" name="btn-editreseacher">Edit</button>
                    <button type="submit" name="btn-deletereseacher">Delete</button>
                    <button type="submit" name="btn-clear">Clear</button>
                </td>
            </div>
        </tr>
    </table>
</div>
</form>
<script>
    $(document).ready(function(){

        $("#reseacher_data").load("reseacherdropdown.php",{"reseacherdropdown":""});

        $("#select_reseacher").change(function(){
            $.ajax({
                type: 'post',
                url: 'reseacherdropdown.php',
                data:{
                    reseacherdropdown:$("#select_reseacher").find(":selected").val()
                },
                success:function(response){
                    document.getElementById("reseacher_data").innerHTML=response
                }
            })
        })
    });
</script>

</body>
</html>