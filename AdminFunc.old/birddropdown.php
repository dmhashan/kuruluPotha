<?php
$birddropdown = $_POST['birddropdown'];

require('dbConn.php');

$sql = "SELECT * FROM birddetails WHERE birdid='$birddropdown'";
if ($result = mysqli_query($conn, $sql)) {

    $row = mysqli_fetch_array($result);

    ?>
    <table>
    <tr>
        <td>English Name</td>
        <td><input type="text" name="commonname" required value="<?php echo $row['commonname'] ?>"></td>
    </tr>

    <tr>
        <td>Sinhala Name</td>
        <td><input type="text" name="sinhalaname" required value="<?php echo $row['sinhalaname'] ?>"></td>
    </tr>

    <tr>
        <td>Scientific Name</td>
        <td><input type="text" name="scientificname" required value="<?php echo $row['scientificname'] ?>"></td>
    </tr>

    <tr>
        <td>Other Names</td>
        <td><input type="text" name="othername" value="<?php echo $row['othername'] ?>"></td>
    </tr>

    <tr>
        <td>Size</td>
        <td>
            <select name="size" value="<?php echo $row['size'] ?>">
                <option value="9">9</option>
                <option value="28">28</option>
                <option value="72">72</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Shape</td>
        <td>
            <select id="shapeid" name="shapeid">
                <?php
                //db connection
                require('dbConn.php');

                //query
                $sql="SELECT shapeid FROM shape";
                $result=mysqli_query($conn,$sql);

                while($row=mysqli_fetch_array($result)) {
                    echo "<option value='".$row['shapeid']."'>".$row['shapeid']."</option>";
                }
                echo "</select>";
                ?>
            </select>
        </td>
    </tr>
    <tr>
    </tr>
    <tr>
        <td>Details</td>
        <td><textarea rows="4" cols="20" name="details" value="<?php echo $row['details'] ?>"></textarea></td>
    </tr>
    <tr>
        <td>Red List Category</td>
        <td>
            <select id="redlistid" name="redlistid">
                <?php
                //db connection
                require('dbConn.php');

                //query
                $sql="SELECT redlistid FROM redlist";
                $result=mysqli_query($conn,$sql);

                while($row=mysqli_fetch_array($result)) {
                    echo "<option value='".$row['redlistid']."'>".$row['redlistid']."</option>";
                }
                echo "</select>";
                ?>
            </select>
        </td>
    </tr>
    </table>
<?php
} else {
    echo "Error: " . mysqli_error($conn);
}
?>