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
    <font color="#00ff00"><b>Admin Dashboard / Bird</b></font>


</div>
<br>

<div class="col-2 menu">
    <ul>
        <a href="main.php">
            <li>Main</li>
        </a>
        <li>Bird</li>
        <a href="reseacher.php">
            <li>Reseacher</li>
        </a>
        <a href="User.php">
            <li>User</li>
        </a>
    </ul>
</div>
<form action="birdoperations.php" method="post">
    <div class="col-5">
<table>
    <tr>
        <select id="select_bird" name="birddropdown">
        <?php
        //db connection
        require('dbConn.php');

        //query
        $sql="SELECT * FROM birddetails";
        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_array($result)) {
            echo "<option value='".$row['birdid']."'>".$row['commonname']."</option>";
        }
        echo "</select>";
        ?>
        </select>
    </tr>
    <div id="bird_data">
        <!--Load data here-->
    </div>
<tr>

        <td></td>
        <td>
            <div class="button">
            <button type="submit" name="btn-addbird" style="margin-left:10px;">Add</button>
            <button type="submit" name="btn-editbird" style="margin-left:10px;">Edit</button>
            <button type="submit" name="btn-deletebird" style="margin-left:10px;">Delete</button>
            <button type="submit" name="btn-clear" style="margin-left:10px;">clear</button>
            </div>
        </td>

</tr>
</table>
</form>
</div>
<script>
    $(document).ready(function(){

        $("#bird_data").load("birddropdown.php",{"birddropdown":""});

        $("#select_bird").change(function(){
            $.ajax({
                type: 'post',
                url: 'birddropdown.php',
                data:{
                    birddropdown:$("#select_bird").find(":selected").val()
                },
                success:function(response){
                    document.getElementById("bird_data").innerHTML=response
                }
            })
        })
    });
</script>




</body>
</html>

