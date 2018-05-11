<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require '../../CommonFiles/dbConn.php';
    $sql_main = "SELECT * FROM birddetails WHERE birdid=" . $_GET['birdid'];
    $result_main = mysqli_query($conn, $sql_main);
    if ($row_main = mysqli_fetch_assoc($result_main)) {
        ?>
        <input type="button" value="x Close" onclick="firstLoad()" style="float: right"/>
        <table border="0">
                <tbody>
                    <tr>
                        <td>Common Name : </td>
                        <td><?php echo $row_main['commonname']; ?></td>
                    </tr>
                    <tr>
                        <td>Scientific Name : </td>
                        <td><?php echo $row_main['scientificname']; ?></td>
                    </tr>
                    <tr>
                        <td>Sinhala Name : </td>
                        <td><?php echo $row_main['sinhalaname']; ?></td>
                    </tr>
                    <tr>
                        <td>Other Names : </td>
                        <td><?php echo $row_main['othername']; ?></td>
                    </tr>
                    <tr>
                        <td>Details : </td>
                        <td><?php echo $row_main['details']; ?></td>
                    </tr>
                    <tr>
                        <td>Size : </td>
                        <td><?php echo $row_main['size']; ?></td>
                    </tr>
                    <tr>
                        <td>Shape : </td>
                        <td>
                            <?php
                            $sql_shape = "SELECT * FROM shape WHERE shapeid=" . $row_main['shapeid'];
                            $result_shape = mysqli_query($conn, $sql_shape);
                            if ($row_shape = mysqli_fetch_assoc($result_shape)) {
                                echo $row_shape['shapename'];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Red List : </td>
                        <td>
                            <?php
                            $sql_redlist = "SELECT * FROM redlist WHERE redlistid='" . $row_main['redlistid'] . "'";
                            $result_redlist = mysqli_query($conn, $sql_redlist);
                            if ($row_redlist = mysqli_fetch_assoc($result_redlist)) {
                                echo $row_redlist['category'];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Colors : </td>
                        <td>
                            <div name="colors">
                                <?php
                                $sql_color = "SELECT * FROM color WHERE colorid IN (SELECT colorid FROM birdcolor WHERE birdid=" . $_GET['birdid'] . ")";
                                $result_color = mysqli_query($conn, $sql_color);
                                while ($row_color = mysqli_fetch_assoc($result_color)) {
                                    echo '<div style="float: left; height: 10px; width: 10px; background-color: ' . $row_color['colorcode'] . '"></div>';
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Location : </td>>
                        <td>
                            <?php
                            echo 'Endemic : ';
                            $sql_location = "SELECT * FROM location WHERE locationid IN (SELECT locationid FROM blss WHERE status=1 AND birdid=" . $_GET['birdid'] . ")";
                            $result_location = mysqli_query($conn, $sql_location);
                            while ($row_location = mysqli_fetch_assoc($result_location)) {
                                echo $row_location['locationname'] . ', ';
                            }
                            echo '<br>Resident : ';
                            $sql_location = "SELECT * FROM location WHERE locationid IN (SELECT locationid FROM blss WHERE status=2 AND birdid=" . $_GET['birdid'] . ")";
                            $result_location = mysqli_query($conn, $sql_location);
                            while ($row_location = mysqli_fetch_assoc($result_location)) {
                                echo $row_location['locationname'] . ', ';
                            }
                            echo '<br>Migrant : ';
                            $sql_location = "SELECT * FROM location WHERE locationid IN (SELECT locationid FROM blss WHERE status=3 AND birdid=" . $_GET['birdid'] . ")";
                            $result_location = mysqli_query($conn, $sql_location);
                            while ($row_location = mysqli_fetch_assoc($result_location)) {
                                echo $row_location['locationname'] . ', ';
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        <input type="button" value="Edit" onclick="editbird(<?php echo $_GET['birdid']; ?>)"/><input onclick="deletebird(<?php echo $_GET['birdid']; ?>)" type="button" value="Delete" />
        <?php
    }
}
?>