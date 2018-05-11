<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require '../../CommonFiles/dbConn.php';
    ?>
<input type="button" value="x Close" onclick="firstLoad()" style="float: right"/>
    <form action="php/addBirdSubmit.php" method="POST" enctype="multipart/form-data">
        <table border="0">
            <tbody>
                <tr>
                    <td>Common Name : </td>
                    <td><input type="text" name="commonname" value="" size="20" /></td>
                </tr>
                <tr>
                    <td>Scientific Name : </td>
                    <td><input type="text" name="scientificname" value="" size="20" /></td>
                </tr>
                <tr>
                    <td>Sinhala Name : </td>
                    <td><input type="text" name="sinhalaname" value="" size="20" /></td>
                </tr>
                <tr>
                    <td>Other Names : </td>
                    <td><input type="text" name="othername" value="" size="20" /></td>
                </tr>
                <tr>
                    <td>Photo : </td>
                    <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
                </tr>
                <tr>
                    <td>Details : </td>
                    <td><textarea name="details" rows="4" cols="20">
                        </textarea></td>
                </tr>
                <tr>
                    <td>Size : </td>
                    <td><input type="number" name="size" value="" size="5" /></td>
                </tr>
                <tr>
                    <td>Shape : </td>
                    <td>
                        <select name="shape">
                            <?php
                            $sqlshape = "SELECT * FROM shape";
                            $resultshape = mysqli_query($conn, $sqlshape);
                            while ($rowshape = mysqli_fetch_assoc($resultshape)) {
                                echo '<option value="' . $rowshape['shapeid'] . '" >' . $rowshape['shapename'] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Red List : </td>
                    <td>
                        <select name="redlist">
                            <?php
                            $sqlredlist = "SELECT * FROM redlist";
                            $resultredlist = mysqli_query($conn, $sqlredlist);
                            while ($rowredlsit = mysqli_fetch_assoc($resultredlist)) {
                                echo '<option value="' . $rowredlsit['redlistid'] . '" >' . $rowredlsit['category'] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Colors : </td>
                    <td>
                        <div name="colors">
                            <?php
                            $sqlcolor = "SELECT * FROM color";
                            $resultcolor = mysqli_query($conn, $sqlcolor);
                            while ($rowcolor = mysqli_fetch_assoc($resultcolor)) {
                                echo '<label style="background-color:' . $rowcolor['colorcode'] . ' " ><input type = "checkbox" name = "colors_array[]" value = "' . $rowcolor['colorid'] . '" />' . $rowcolor['colorname'] . '</label>';
                            }
                            ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">

                        <table class='table table-condensed' style="width: 80%">
                            <thead>
                                <tr>
                                    <th>Location</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <!--th>Season</th-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sqllocation = "SELECT * FROM location";
                                $resultlocation = mysqli_query($conn, $sqllocation);
                                while ($rowlocation = mysqli_fetch_assoc($resultlocation)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <label>
                                                <!--input type = "checkbox" name = "location[]" value = "<!--?php echo $rowlocation['locationid']; ?>" -->
                                                <?php echo $rowlocation['locationname']; ?>  
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type = "checkbox" name = "resident[]" value = "<?php echo $rowlocation['locationid']; ?>" />
                                                Resident 
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type = "checkbox" name = "migrant[]" value = "<?php echo $rowlocation['locationid']; ?>" />
                                                Endemic 
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type = "checkbox" name = "endemic[]" value = "<?php echo $rowlocation['locationid']; ?>" />
                                                Resident 
                                            </label>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" value="Save" />
    </form>
    <?php
}
?>