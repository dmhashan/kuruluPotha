<?php
echo 'adfa';
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $id = $_POST['userid'];
    $feedback = $_POST['feedback'];
    echo $id;
    echo $feedback;
    require '../../CommonFiles/dbConn.php';

    $sql = "INSERT INTO feedback "
            . "(userid,feedbacktext) "
            . "VALUES "
            . "('$id','$feedback');";
    
    echo $sql;
    mysqli_query($conn, $sql);
    $key = mysqli_insert_id($conn);
    if ($key > 0) {
        header("location: ../../index.php?success=1");
        die();
    } else {
        header("location: ../../index.php?error=1");
        die();
    }
}

?>