<input type="button" value="x Close" onclick="firstLoad()" style="float: right"/>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commonname = $_POST['commonname'];
    $scientificname = $_POST['scientificname'];
    $sinhalaname = $_POST['sinhalaname'];
    $othername = $_POST['othername'];
    $details = $_POST['details'];
    $size = $_POST['size'];
    $shape = $_POST['shape'];
    $redlist = $_POST['redlist'];
    $colors = $_POST['colors_array'];
    if (isset($_POST['resident'])) {
        $resident = $_POST['resident'];
    }
    if (isset($_POST['endemic'])) {
        $endemic = $_POST['endemic'];
    }
    if (isset($_POST['migrant'])) {
        $migrant = $_POST['migrant'];
    }

    /*
      echo $commonname;
      echo $scientificname;
      echo $sinhalaname;
      echo $othername;
      echo $details;
      echo $size;
      echo $shape;
      echo $redlist;
      echo $colors[0];
      echo $location[0];
      echo $resident[0];
      echo $migrant[0];
      echo $endemic[0];
     */

    require '../../CommonFiles/dbConn.php';
    $sql_bird = "INSERT INTO birddetails (details, commonname, scientificname, sinhalaname, othername, size, shapeid, redlistid) VALUES ('$details','$commonname','$scientificname','$sinhalaname','$othername','$size','$shape','$redlist')";
    mysqli_query($conn, $sql_bird);
    if (mysqli_insert_id($conn) > 0) {
        $birdid = mysqli_insert_id($conn);
        foreach ($colors as &$color_value) {
            $sql_color = "INSERT INTO birdcolor (birdid,colorid) VALUES ('$birdid','$color_value')";
            $result_color = mysqli_query($conn, $sql_color);
        }
        if (isset($resident)) {
            foreach ($resident as &$resident_value) {
                $sql_color = "INSERT INTO blss (birdid,locationid,seasonid,status) VALUES ('$birdid','$resident_value','1','2')";
                $result_color = mysqli_query($conn, $sql_color);
            }
        }

        if (isset($endemic)) {
            foreach ($endemic as &$endemic_value) {
                $sql_color = "INSERT INTO blss (birdid,locationid,seasonid,status) VALUES ('$birdid','$endemic_value','1','1')";
                $result_color = mysqli_query($conn, $sql_color);
            }
        }

        if (isset($migrant)) {
            foreach ($migrant as &$migrant_value) {
                $sql_color = "INSERT INTO blss (birdid,locationid,seasonid,status) VALUES ('$birdid','$migrant_value','1','3')";
                $result_color = mysqli_query($conn, $sql_color);
            }
        }

        ////////////////////
        $target_dir = "../../img/birds/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $target_file = $target_dir.$birdid.'-1.png';
        $uploadOk = 1;
// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                //echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                echo 'Successfully saved';
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        ///////////////////
        echo 'Successfully saved';
    } else {
        echo 'birddetails table insertion error';
    }
}
    