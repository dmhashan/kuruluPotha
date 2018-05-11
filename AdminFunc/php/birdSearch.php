<table class="table table-condensed">
    <thead>
        <tr>
            <th>BirdID</th>
            <th>Names</th>
            <th>Show</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $search_key = strtoupper($_GET['searchkey']);
            require '../../CommonFiles/dbConn.php';
            $sql_bird_details = "SELECT * FROM birddetails WHERE upper(commonname) LIKE '%" . $search_key . "%' OR upper(scientificname) LIKE '%" . $search_key . "%' OR sinhalaname LIKE '%" . $_GET['searchkey'] . "%' OR upper(othername) LIKE '%" . $search_key . "%' ";
            $result_bird_details = mysqli_query($conn, $sql_bird_details);
            if (mysqli_num_rows($result_bird_details) > 0) {
                while ($row_bird_details = mysqli_fetch_assoc($result_bird_details)) {
                    ?>
                    <tr>
                        <td><?php echo $row_bird_details['birdid']; ?></td>
                        <td><?php echo $row_bird_details['commonname'] . ', ' . $row_bird_details['sinhalaname'] . ', ' . $row_bird_details['scientificname'] . ', ' . $row_bird_details['othername']; ?></td>
                        <td><a onclick="showbird(<?php echo $row_bird_details['birdid']; ?>)">Show</a></td>
                        <td><a onclick="editbird(<?php echo $row_bird_details['birdid']; ?>)">Edit</a></td>
                        <td><a onclick="deletebird(<?php echo $row_bird_details['birdid']; ?>)">Delete</a></td>
                    </tr>
                    <?php
                }
            }
        }
        ?>
    </tbody>
</table>