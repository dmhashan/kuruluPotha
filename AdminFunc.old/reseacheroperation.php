<?php
if(isset($_POST['btn-addreseacher'])){
    //get inputs.
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $nic = $_POST['nic'];
    $dob = $_POST['dob'];
    $occupation = $_POST['occupation'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $propic = $_POST['propic'];
    $resorg=$_POST['resorg'];
    $rescert=$_POST['rescert'];
    $userid=$_POST['reseacherdropdown'];


    //validation


    //db connection.
    require('dbConn.php');


    //query
  $sql = "INSERT INTO userdetails (firstname,lastname,nic,dob,occupation,mobile,email,propic) VALUES ('$firstname','$lastname','$nic','$dob','$occupation','$mobile','$email','$propic')";
    if (mysqli_query($conn, $sql)) {
        $last_id = $conn->insert_id;
        $sql2="INSERT INTO researcher(userid,resorg,rescert) VALUES ('$last_id','$resorg','$rescert')";
        if(mysqli_query($conn,$sql2)){
                header('Location: reseacher.php');
                die();
            }
            else{
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }


    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

elseif(isset($_POST['btn-editreseacher'])) {
    //db connection.
    require('dbConn.php');

    //Get id from DB

    if (isset($_GET['firstname'])) {
        $dql = "SELECT * FROM userdetails WHERE firstname=" . $_GET['reseacherdropdown'];
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
    }

    //Update Data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $nic = $_POST['nic'];
    $dob = $_POST['dob'];
    $occupation = $_POST['occupation'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $propic = $_POST['propic'];
    $userid = $_POST['reseacherdropdown'];

    $update = "UPDATE userdetails SET firstname='$firstname',lastname='$lastname',nic='$nic',dob='$dob',occupation='$occupation',mobile='$mobile',email='$email',propic='$propic' WHERE userid=" . $userid;
    if(mysqli_query($conn, $update)){
        $last_id = $conn->insert_id;
        $sql2="UPDATE researcher SET userid='$last_id',resorg='$resorg',rescert='$rescert'";
        if(mysqli_query($conn,$sql2)){
            header('Location: reseacher.php');
            die();
        }
        else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }


    }

    //Msg box
    if (isset($sql)) {
        die("Error sql" . mysqli_connect_error());
    } else {
        echo("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully updated')
    window.location.href='reseacher.php';
    </SCRIPT>");
    }
}

elseif(isset($_POST['btn-deletereseacher'])){
    //db connection
    require('dbConn.php');

    $user_id = $_POST['reseacherdropdown'];

    $delete="DELETE FROM userdetails WHERE userid=".$user_id;
    $result=mysqli_query($conn,$delete);

    if($result)
    {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully deleted')
    window.location.href='reseacher.php';
    </SCRIPT>");
    }
    else
    {
        echo "Mysql Error";
    }
    mysqli_close($conn);
}

elseif(isset($_POST['btn-clear'])){
    ?>
    <script type="text/javascript">
        function clearDefault(a){if(a.defaultValue==a.value){a.value=""}};
    </script>
    <?php
    header('location: reseacher.php');
}
?>