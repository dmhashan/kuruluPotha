<?php
if (isset($_POST['btn-addbird'])) {
    # btn-addbird was clicked
    //db connection.
    require('dbConn.php');

    //get inputs.
    $commonname = $_POST['commonname'];
    $sinhalaname = $_POST['sinhalaname'];
    $scientificname = $_POST['scientificname'];
    $othername = $_POST['othername'];
    $size = $_POST['size'];
    $shapeid = $_POST['shapeid'];
    $details = $_POST['details'];
    $redlistid = $_POST['redlistid'];

    $sql = "INSERT INTO birddetails (commonname,sinhalaname,scientificname,othername,size,shapeid,details,redlistid) VALUES ('$commonname','$sinhalaname','$scientificname','$othername','$size','$shapeid','$details','$redlistid')";

    if (mysqli_query($conn, $sql)) {
        $last_id = $conn->insert_id;
        $sql = "INSERT INTO birddetails(commonname,sinhalaname,scientificname,othername,size,shapeid,details,redlistid) VALUES('$commonname','$sinhalaname','$scientificname','$othername','$size','$shapeid','$details','$redlistid')";

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    if($sql)
    {
        echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Succesfully Added')
                                             window.location.href='bird.php';
               </SCRIPT>");
    }
    else
    {
        echo "Mysql Error";
    }
    mysqli_close($conn);

}

elseif (isset($_POST['btn-editbird'])) {
    # btn-editbird was clicked
    //db connection.
    require('dbConn.php');

    //Get id from DB

    if(isset($_GET['commonname'])){
        $dql="SELECT * FROM birddetails WHERE commonname=".$_GET['birddropdown'];
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result);
    }
    //Update Data
    if(isset($_POST['btn-editbird'])){
        $commonname = $_POST['commonname'];
        $sinhalaname = $_POST['sinhalaname'];
        $scientificname = $_POST['scientificname'];
        $othername = $_POST['othername'];
        $size = $_POST['size'];
        $shapeid = $_POST['shapeid'];
        $details = $_POST['details'];
        $redlistid = $_POST['redlistid'];
        $bird_id = $_POST['birddropdown'];

        $update="UPDATE birddetails SET commonname='$commonname',sinhalaname='$sinhalaname',scientificname='$scientificname',othername='$othername',size='$size',shapeid='$shapeid',details='$details',redlistid='$redlistid' WHERE birdid=".$bird_id;
        $up=mysqli_query($conn,$update);
        if(isset($sql)){
            die("Error sql".mysqli_connect_error());
        }
        else
        {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully updated')
    window.location.href='bird.php';
    </SCRIPT>");
        }
    }

}

elseif(isset($_POST['btn-deletebird'])){
    //db connection
    require('dbConn.php');

    $bird_id = $_POST['birddropdown'];

    $delete="DELETE FROM birddetails WHERE birdid=".$bird_id;
    $result=mysqli_query($conn,$delete);

    if($result)
    {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully deleted')
    window.location.href='bird.php';
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
    header('location: bird.php');
}
?>