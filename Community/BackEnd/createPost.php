<?php
require('classes.php');

session_start();

$stText = $_POST["text"];
$postBird = $_POST["bird"];
$postPhoto = substr($_POST["photo"], 22);
$postLocation= $_POST["location"];

$newPost = new post;
$newPost->createPost($stText, $postPhoto, $postBird, $postLocation);

?>

<ul id="" class="comments-list" style="width:98%;">
    <li>
        <div class="comment-main-level">
            <!-- Avatar -->
            <div class="comment-avatar"><img
                    src="<?php echo($curPost->getUserPhoto()) ?>"
                    alt="Avatar"></div>
            <!-- Contenedor del Comentario -->
            <div class="comment-box">
                <div class="comment-head">
                    <h6 class="comment-name by-author"><a
                            href="http://creaticode.com/blog"><?php echo($curPost->getUserName()) ?></a>
                    </h6>
                    <span
                        style="padding-top:8px;"><?php echo($curPost->getTime() . ' | ' . $curPost->getDate()); ?></span>

                    <a class="resp disabled"
                       style="color:red; font-weight:bold; padding-top:5px;"
                       id="<?php echo('dncount' . $curPost->getPostID()); ?>"><?php echo($curPost->getDislikes()); ?></a>
                    <a class="fa fa-thumbs-down fa-2x resp  <?php echo($curResp->getDislikeStatus()); ?>"
                       data-toggle="tooltip" title="thumbs-down"
                       style="color:<?php echo($curResp->getDislikeColor()); ?>"
                       id="<?php echo('dn' . $curPost->getPostID()); ?>"></a>
                    <a class="fa fa-thumbs-up fa-2x resp <?php echo($curResp->getLikeStatus()); ?>"
                       data-toggle="tooltip" title="thumbs-up"
                       style="color:<?php echo($curResp->getLikeColor()); ?>"
                       id="<?php echo('up' . $curPost->getPostID()); ?>"></a>
                    <a class="resp disabled"
                       style="color:green;  font-weight:bold; padding-top:5px;"
                       id="<?php echo('upcount' . $curPost->getPostID()); ?>"><?php echo($curPost->getLikes()); ?></a>


                </div>
                <div class="comment-content">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="<?php echo($curPost->getPhoto()) ?>" width="100%">
                        </div>
                        <div class="col-md-5">
                            <?php echo($curPost->getText()) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- post-comments -->
        <ul class="comments-list reply-list">


            <li id="com-box-<?php echo($curPost->getPostID()); ?>">
                <!--Add a Comment-->
                <!--Avatar -->
                <div class="comment-avatar"><img
                        src="<?php echo($curPost->getUserPhoto()) ?>"
                        alt=""></div>
                <div class="comment-box">
                    <div class="comment-head">
                        <span style="padding-bottom:10px;"> Add a Comment </span>
                        <input style="margin-bottom:10px !important;" type="text"
                               class="form-control"
                               id="<?php echo('comment' . $curPost->getPostID()) ?>">
                        <button type="button" name="btnComment"
                                class="btn btn-primary btn-md btnComment"
                                id="<?php echo($curPost->getPostID()); ?>"
                                style="float:right;"
                                onclick="postComment($('#<?php echo('comment' . $curPost->getPostID()); ?>').val(),'<?php echo($curPost->getPostID()); ?>',this);">
                            <span class="glyphicon glyphicon-share"
                                  style="color:white; padding-top:2px; padding-right:5px;"></span>Post
                        </button>
                    </div>
                </div>
            </li>
        </ul>
    </li>
</ul>

