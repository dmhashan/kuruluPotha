<?php
//// default sql;
require '../../CommonFiles/dbConn.php';
$default_sql = "SELECT * FROM birddetails LIMIT 9;";

//// firsttime loading sql ////
if (isset($_GET['fistLoad'])) {
    $loadsql = $default_sql;
}
//// check search key available with filters and out sql ////
else if (isset($_GET['searchKey'])) {
    $searchKey = strtoupper($_GET['searchKey']);
    $engCheck = $_GET['engCheck'];
    $sciCheck = $_GET['sciCheck'];
    $sinCheck = $_GET['sinCheck'];

    //eng//sci//sin//
    if ($engCheck === "true" && $sciCheck === "true" && $sinCheck === "true") {
        $loadsql = "SELECT * FROM birddetails WHERE upper(commonname) REGEXP '[[:<:]]" . $searchKey . "[[:>:]]' OR upper(scientificname) REGEXP '[[:<:]]" . $searchKey . "[[:>:]]' OR sinhalaname REGEXP '[[:<:]]" . $_GET['searchKey'] . "[[:>:]]' OR upper(othername) REGEXP '[[:<:]]" . $searchKey . "[[:>:]]' ";
    }
    //eng//sci//
    else if ($engCheck === "true" && $sciCheck === "true") {
        $loadsql = "SELECT * FROM birddetails WHERE upper(commonname) REGEXP '[[:<:]]" . $searchKey . "[[:>:]]' OR upper(scientificname) REGEXP '[[:<:]]" . $searchKey . "[[:>:]]' OR upper(othername) REGEXP '[[:<:]]" . $searchKey . "[[:>:]]' ";
    }
    //sci//sin//
    else if ($sciCheck === "true" && $sinCheck === "true") {
        $loadsql = "SELECT * FROM birddetails WHERE upper(scientificname) REGEXP '[[:<:]]" . $searchKey . "[[:>:]]' OR sinhalaname REGEXP '[[:<:]]" . $_GET['searchKey'] . "[[:>:]]' OR upper(othername) REGEXP '[[:<:]]" . $searchKey . "[[:>:]]' ";
    }
    //eng//sin//
    else if ($engCheck === "true" && $sinCheck === "true") {
        $loadsql = "SELECT * FROM birddetails WHERE upper(commonname) REGEXP '[[:<:]]" . $searchKey . "[[:>:]]' OR sinhalaname REGEXP '[[:<:]]" . $_GET['searchKey'] . "[[:>:]]' OR upper(othername) REGEXP '[[:<:]]" . $searchKey . "[[:>:]]' ";
    }
    //eng//
    else if ($engCheck === "true") {
        $loadsql = "SELECT * FROM birddetails WHERE upper(commonname) REGEXP '[[:<:]]" . $searchKey . "[[:>:]]' OR upper(othername) REGEXP '[[:<:]]" . $searchKey . "[[:>:]]' ";
    }
    //sci//
    else if ($sciCheck === "true") {
        $loadsql = "SELECT * FROM birddetails WHERE upper(scientificname) REGEXP '[[:<:]]" . $searchKey . "[[:>:]]' OR upper(othername) REGEXP '[[:<:]]" . $searchKey . "[[:>:]]' ";
    }
    //sin//
    else if ($sinCheck === "true") {
        $loadsql = "SELECT * FROM birddetails WHERE sinhalaname REGEXP '[[:<:]]" . $_GET['searchKey'] . "[[:>:]]'";
    }
}
//// bird identify index is available ////
else if (isset($_GET['birdSize']) || isset($_GET['birdShape']) || isset($_GET['birdColor']) || isset($_GET['birdLocation'])) {

    $index_available = 0;
    $canPassValidation = false;
    $temp_sql = "SELECT * FROM birddetails WHERE ";

    if ($_GET['birdSize'] !== "0") {
        if ($_GET['birdSize'] === "1") {
            $temp_sql = $temp_sql . sqlStringBuild($index_available, "size BETWEEN '0' AND '33' ");
        } else if ($_GET['birdSize'] === "2") {
            $temp_sql = $temp_sql . sqlStringBuild($index_available, "size BETWEEN '22' AND '66' ");
        } else if ($_GET['birdSize'] === "3") {
            $temp_sql = $temp_sql . sqlStringBuild($index_available, "size BETWEEN '55' AND '500' ");
        }
        $index_available++;
    }

    if ($_GET['birdShape'] !== "0") {
        $temp_sql = $temp_sql . sqlStringBuild($index_available, " shapeid = " . (string) $_GET['birdShape']);
        $index_available++;
    }

    if ($_GET['birdColor'] !== "") {
        $temp_sql = $temp_sql . sqlStringBuild($index_available, " birdid IN ( SELECT birdid FROM birdcolor WHERE colorid IN (" . (string) $_GET['birdColor'] . ") ) ");
        $index_available++;
    }

    if ($_GET['birdLocation'] !== "0") {
        $temp_sql = $temp_sql . sqlStringBuild($index_available, " birdid IN ( SELECT birdid FROM blss WHERE locationid = " . (string) $_GET['birdLocation'] . " ) ");
        $index_available++;
    }

    if ($index_available > 0) {
        $loadsql = $temp_sql;
    } else {
        $loadsql = $default_sql;
        ?>
        <div class="alert alert-warning">
            <strong>Please </strong>Select a valid filter.
        </div>
        <?php
    }
} else if (isset($_GET['describeText'])) {
    $idArray = array();
//userinputs
    $describeText = strtoupper($_GET['describeText']);
    $words = str_word_count($describeText, 1);
    $words = array_unique($words);
    $common_word = str_word_count(strtoupper("the be of and a in to it to for I that you he on with do at by not this but from they his that she or which as we an say will would can if their go what there all get her make who as out up see know time take them some could so him year into its then think my come than more about now your me no other give just should these people also well any only new very when may way look like use her such how because when as"), 1);
    $final_input = array_diff($words, $common_word);
    $input_count = count($final_input);
    //print_r($final_input);
//database
    $alldescript = "SELECT birdid,details FROM birddetails ORDER BY birdid";
    $alldescriptresult = mysqli_query($conn, $alldescript);

    if (mysqli_num_rows($alldescriptresult) > 0) {
        while ($loadalldescript = mysqli_fetch_assoc($alldescriptresult)) {
            $str = strtoupper($loadalldescript['details']);
            $current_des = str_word_count($str, 1);
            /* $matching = array_combine($final_input, array_map(function($w) USE (&$str) {
              return
              preg_match_all('/\b' . preg_quote($w, '/') . '\b/i', $str);
              }, $final_input)); */
            $matching = array_intersect($final_input, $current_des);
            $match_count = count($matching);
            //print_r($matching);
            $avg = ($match_count / $input_count) * 100;
            if ($avg >= 50) {
                //array_push($idArray, $avg . ' => ' . $loadalldescript['birdid']);
                //$idArray[$loadalldescript['birdid']] = $avg;

                array_push($idArray, array('id' => $loadalldescript['birdid'], 'cost' => $avg));
            }
        }
    }
    //echo '<br>unsorted<br>';
    //print_r($idArray);
    $idArray = subval_sort($idArray, 'cost');
    //echo '<br>sorted<br>';
    //print_r($idArray);
    $count = 0;
    $sqlInString = "";
    foreach ($idArray as $x => $y) {
        if ($count === 0) {
            $sqlInString = (string) $y['id'];
        } else {
            $sqlInString = $sqlInString . ' , ' . (string) $y['id'];
        }
        $count++;
        if ($count > 8) {
            break;
        }
    }
    //print_r($sqlInString);
    $loadsql = "SELECT * FROM birddetails WHERE birdid IN (" . $sqlInString . ")";
//// If get didn't work show this error ////
} else {
    $loadsql = $default_sql;
    ?>
    <div class="alert alert-warning">
        <strong>Try Again!</strong> Filters are not valid.
    </div>
    <?php
}

function subval_sort($a, $subkey) {
    foreach ($a as $k => $v) {
        $b[$k] = strtolower($v[$subkey]);
    }
    arsort($b);
    foreach ($b as $key => $val) {
        $c[] = $a[$key];
    }
    return $c;
}

function sqlStringBuild($x, $y) {
    if ($x > 0) {
        return " && " . $y;
    } else {
        return $y;
    }
}

//// bird loading html with php ////
$loadresult = mysqli_query($conn, $loadsql);
//echo $loadsql;
if (mysqli_num_rows($loadresult) > 0) {
    echo '<ul class="cd-gallery">';
    while ($loadrow = mysqli_fetch_assoc($loadresult)) {
        $local_id = $loadrow['birdid'];
        $local_name = $loadrow['commonname'];
        $local_sin = $loadrow['sinhalaname'];
        ?>
        <!--Box--><?php echo "<li onclick='birddetailsjs($local_id,\"$local_name\",\"$local_sin\")'>"; ?>
        <?php echo "<a onclick='birddetailsjs($local_id,\"$local_name\",\"$local_sin\")'>"; ?>
        <ul class="cd-item-wrapper">
            <li class="selected">
                <img src="../img/birds/<?php echo $local_id; ?>-1.png" alt="Preview image">
            </li>
            <!--
                                <li class="move-right" data-sale="true">
                                    <img src="../img/birds/<!--?php echo $local_id; ?>-2.png" alt="Preview image">
                                </li>
            
                                <li>
                                    <img src="../img/birds/<!--?php echo $local_id; ?>-3.png" alt="Preview image">
                                </li>
            -->
        </ul> <!-- cd-item-wrapper -->
        </a>

        <div class="cd-item-info">
            <b>
                <?php echo "<a onclick='birddetailsjs($local_id,\"$local_name\",\"$local_sin\")'>"; ?>
                <?php echo $local_name; ?><br/>
                (<?php echo $local_sin; ?>)
                </a>
            </b>
        </div> <!-- cd-item-info -->
        </li>
        <?php
    }
    echo '</ul>';
} else {
    ?>
    <div class="alert alert-warning">
        <strong>Sorry!</strong> No result defined for search.
    </div>
    <?php
    $loadresult = mysqli_query($conn, $default_sql);
    if (mysqli_num_rows($loadresult) > 0) {
        echo '<ul class="cd-gallery">';
        while ($loadrow = mysqli_fetch_assoc($loadresult)) {
            $local_id = $loadrow['birdid'];
            $local_name = $loadrow['commonname'];
            $local_sin = $loadrow['sinhalaname'];
            ?>
            <!--Box--><?php echo "<li onclick='birddetailsjs($local_id,\"$local_name\",\"$local_sin\")'>"; ?>
            <?php echo "<a onclick='birddetailsjs($local_id,\"$local_name\",\"$local_sin\")'>"; ?>
            <ul class="cd-item-wrapper">
                <li class="selected">
                    <img src="../img/birds/<?php echo $local_id; ?>-1.png" alt="Preview image">
                </li>
                <!--
                                    <li class="move-right" data-sale="true">
                                        <img src="../img/birds/<!--?php echo $local_id; ?>-2.png" alt="Preview image">
                                    </li>
                
                                    <li>
                                        <img src="../img/birds/<!--?php echo $local_id; ?>-3.png" alt="Preview image">
                                    </li>
                -->
            </ul> <!-- cd-item-wrapper -->
            </a>

            <div class="cd-item-info">
                <b>
                    <?php echo "<a onclick='birddetailsjs($local_id,\"$local_name\",\"$local_sin\")'>"; ?>
                    <?php echo $local_name; ?><br/>
                    (<?php echo $local_sin; ?>)
                    </a>
                </b>
            </div> <!-- cd-item-info -->
            </li>
            <?php
        }
        echo '</ul>';
    }
}
?>
