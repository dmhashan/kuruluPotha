<?php
/**
 * Created by PhpStorm.
 * User: imesh
 * Date: 2017-05-06
 * Time: 6:49 PM
 */
require('classes.php');

$birds = json_decode($_POST['lChkBirds']);


$locations = new locSuggest;
$locIDs = $locations->getLocSuggest($birds);

echo(json_encode($locIDs));

?>