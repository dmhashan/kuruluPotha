<?php
require('classes.php');

session_start();

$postID=$_POST["postid"];
$postComment=$_POST["comment"];

$newComment= new comment;
$newComment->createComment($postID,$postComment);

?>