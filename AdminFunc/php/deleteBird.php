<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require '../../CommonFiles/dbConn.php';
    $sql_main = "SELECT * FROM birddetails WHERE birdid=" . $_GET['birdid'];
    $result_main = mysqli_query($conn, $sql_main);
    if ($row_main = mysqli_fetch_assoc($result_main)) {
        ?>
        <form action="php/deleteBird.php" method="POST">
            <input type="hidden" name="birdid" value="<?php echo $_GET['birdid']; ?>" />
            <?php
            echo 'Do you want to delete ' . $row_main['commonname'] . ' (' . $row_main['sinhalaname'] . ') bird ?';
        }
    }
    ?>
    <input type="submit" value="Yes" />
</form>
<input type="button" value="No" onclick="firstLoad()" />

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $birdid = $_POST['birdid'];
    require '../../CommonFiles/dbConn.php';
    $sql1 = "DELETE FROM birddetails WHERE birdid=" . $birdid;
    $sql2 = "DELETE FROM birdcolor WHERE birdid=" . $birdid;
    $sql3 = "DELETE FROM blss WHERE birdid=" . $birdid;
    mysqli_query($conn, $sql2);
    mysqli_query($conn, $sql3);
    mysqli_query($conn, $sql1);
    echo 'Delete successfully';
}
?>