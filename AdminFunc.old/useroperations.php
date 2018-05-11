<?php
if(isset($_POST['btn-adduser'])){
    //get inputs.
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $nic = $_POST['nic'];
    $dob = $_POST['dob'];
    $occupation = $_POST['occupation'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $propic = $_POST['propic'];
    $userid=$_POST['userdropdown'];

    //validation


    //db connection.
    require('dbConn.php');

    $sql = "INSERT INTO userdetails (firstname,lastname,nic,dob,occupation,mobile,email,propic) VALUES ('$firstname','$lastname','$nic','$dob','$occupation','$mobile','$email','$propic')";

    if (mysqli_query($conn, $sql)) {
        $last_id = $conn->insert_id;
        $sql = "INSERT INTO userdetails (firstname,lastname,nic,dob,occupation,mobile,email,propic) VALUES ('$firstname','$lastname','$nic','$dob','$occupation','$mobile','$email','$propic')";
        header('Location: user.php');
        die();

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

elseif(isset($_POST['btn-edituser'])) {
    //db connection.
    require('dbConn.php');

    //Get id from DB

    if (isset($_GET['firstname'])) {
        $dql = "SELECT * FROM userdetails WHERE firstname=" . $_GET['userdropdown'];
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
    $userid = $_POST['userdropdown'];

    $update = "UPDATE userdetails SET firstname='$firstname',lastname='$lastname',nic='$nic',dob='$dob',occupation='$occupation',mobile='$mobile',email='$email',propic='$propic' WHERE userid=" . $userid;
    $up = mysqli_query($conn, $update);

    //Msg box
    if (isset($sql)) {
        die("Error sql" . mysqli_connect_error());
    } else {
        echo("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully updated')
    window.location.href='user.php';
    </SCRIPT>");
    }
}

elseif(isset($_POST['btn-deleteuser'])){
    //db connection
    require('dbConn.php');

    $user_id = $_POST['userdropdown'];

    $delete="DELETE FROM userdetails WHERE userid=".$user_id;
    $result=mysqli_query($conn,$delete);

    if($result)
    {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully deleted')
    window.location.href='user.php';
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
    header('location: user.php');
}
?>