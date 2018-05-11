<?php
$reseacherdropdown = $_POST['reseacherdropdown'];

require('dbConn.php');

$sql = "SELECT firstname,lastname,nic,dob,occupation,mobile,email,propic,resorg,rescert FROM userdetails JOIN researcher ON userdetails.userid=researcher.userid WHERE userid='$reseacherdropdown' ";
if ($result = mysqli_query($conn, $sql)) {

    $row = mysqli_fetch_array($result);

    ?>
    <table>
        <tr>
            <td>First Name</td>
            <td><input type="text" name="firstname" value="<?php echo $row['firstname'] ?>" required></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type="text" name="lastname" required value="<?php echo $row['lastname'] ?>"></td>
        </tr>

        <tr>
            <td>NIC</td>
            <td><input type="text" name="nic" value="<?php echo $row['nic'] ?>"></td>
        </tr>
        <tr>
            <td>Bate of Birth</td>
            <td><input type="text" name="dob" value="<?php echo $row['dob'] ?>"></td>
        </tr>
        <tr>
            <td>Occupation</td>
            <td><input type="text" name="occupation" value="<?php echo $row['occupation'] ?>"></td>
        </tr>
        <tr>
            <td>Mobile</td>
            <td><input type="text" name="mobile" required value="<?php echo $row['mobile'] ?>"></td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td><input type="text" name="email" required value="<?php echo $row['email'] ?>"></td>
        </tr>
        <tr>
            <td>Profile Picture</td>
            <td><input type="text" name="propic" value="<?php echo $row['propic'] ?>"></td>
        </tr>
        <tr>
            <td>Organization</td>
            <td><input type="text" name="resorg" value="<?php echo $row['resorg'] ?>"></td>
        </tr>
        <tr>
            <td>Certificate</td>
            <td><input type="text" name="rescert" value="<?php echo $row['rescert'] ?>"></td>
        </tr>
    </table>
<?php
} else {
    echo "Error: " . mysqli_error($conn);
}
?>