<?php
file_put_contents("../images/birds/".uniqid().".jpg",base64_decode($_POST["data"]));