<?php

/**
 * Created by PhpStorm.
 * User: imesh
 * Date: 2017-04-20
 * Time: 10:09 AM
 */
class post
{
    private $postID;
    private $userID;
    private $text;
    private $photo;
    private $likes;
    private $dislikes;
    private $date;
    private $time;
    private $birdid;
    private $birdname;
    private $username;
    private $userphoto;
    private $location;


    /*    function __construct($userID,$text,$photo,$date,$time,$bird) {
            //$this->postID = ;
            $this->userID = $_SESSION["userid"];
            $this->text = $status;
            $this->photo = $photo;
            $this->date = $date;
            $this->time = $time;
            $this->bird = $bird;
        }*/


    function setUserID($userID)
    {
        $this->userID = $userID;
    }

    function setText($text)
    {
        $this->text = $text;
    }

    function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    function setLikes($likes)
    {
        $this->likes = $likes;
    }

    function setDislikes($dislikes)
    {
        $this->dislikes = $dislikes;
    }

    function setDate($date)
    {
        $this->date = $date;
    }

    function setTime($time)
    {
        $this->time = $time;
    }

    function setBirdID($birdid)
    {
        $this->birdid = $birdid;
    }

    function setPostLocation($location)
    {
        $this->location = $location;
    }

    function getPostID()
    {
        return $this->postID;
    }

    function getUserID()
    {
        return $this->userID;
    }

    function getText()
    {
        return $this->text;
    }

    function getPhoto()
    {
        return $this->photo;
    }

    function getLikes()
    {
        return $this->likes;
    }

    function getDislikes()
    {
        return $this->dislikes;
    }

    function getDate()
    {
        return $this->date;
    }

    function getTime()
    {
        return $this->time;
    }

    function getBirdID()
    {
        return $this->birdid;
    }

    function getBirdName()
    {
        return $this->birdname;
    }

    function getUsername()
    {
        return $this->username;
    }

    function getUserPhoto()
    {
        return $this->userphoto;
    }

    function getPostLocation()
    {
        return $this->location;
    }

    function createPost($text, $photo, $bird, $location)
    {
        if ($_POST["text"]) {

            $this->userID = $_SESSION["userid"];
            $this->date = date("Y/m/d");
            $this->time = date("h:i:sa");
            $this->text = $text; //read post text
            //$this->photo=$photo;
            $this->bird = $bird;
            $this->location = $location;

            //db connection.
            require('../../CommonFiles/dbConn.php');

            $sql = "INSERT INTO post (postid,userid,text,postphoto,postlikes,postdislikes,postdate,posttime,postbirdid, postlocation) VALUES (NULL, '$this->userID','$this->text','none','0','0','$this->date','$this->time','$this->bird','$this->location')";

            if (mysqli_query($conn, $sql)) {
                echo("Post Successful.");
                $lastID = mysqli_insert_id($conn);
                echo($lastID . '----' . $photo);

                $imageData = base64_decode($photo);
                //echo($imageData);
                $source = imagecreatefromstring($imageData);
                $rotate = imagerotate($source, 0, 0); // if want to rotate the image
                $imageSave = imagejpeg($rotate, '../images/birds/' . $lastID . '.jpg', 100);
                echo $imageSave;
                imagedestroy($source);

                //die();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
    }

    function loadPost($postID)
    {

        //db connection.
        require('../CommonFiles/dbConn.php');

        $sql = "SELECT post.postid, post.userid, post.text, post.postbirdid, post.postlikes, post.postdislikes, post.postdate, post.posttime, post.postlocation,
                userdetails.userid, userdetails.firstname, userdetails.lastname,
                birddetails.birdid, birddetails.commonname,
                location.locationid, location.locationname
                FROM post, userdetails, birddetails, location
                WHERE post.userid = userdetails.userid AND post.postbirdid=birddetails.birdid AND post.postlocation=location.locationid AND post.postid='$postID';";
        if ($resultCurPost = mysqli_query($conn, $sql)) {
            $rowCurPost = mysqli_fetch_array($resultCurPost);
            //echo($rowCurPost['text']);

            $this->postID = $rowCurPost['postid'];
            $this->userID = $rowCurPost['userid'];
            $this->username = $rowCurPost['firstname'] . ' ' . $rowCurPost['lastname'];
            $this->userphoto = "../img/user/img-" . $rowCurPost['userid'] . ".jpg";
            $this->birdid = $rowCurPost['postbirdid'];
            $this->birdname = $rowCurPost['commonname'];
            $this->text = $rowCurPost['text'];
            $this->photo = 'images/birds/' . $rowCurPost['postid'] . '.jpg';
            $this->likes = $rowCurPost['postlikes'];
            $this->dislikes = $rowCurPost['postdislikes'];
            $this->date = $rowCurPost['postdate'];
            $this->time = $rowCurPost['posttime'];
            $this->location = $rowCurPost['locationname'];

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);

    }
}

class comment
{
    private $PCID;
    private $postID;
    private $userID;
    private $userName;
    private $userPhoto;
    private $comment;
    private $date;
    private $time;


    function setPostID($postID)
    {
        $this->postID = $postID;
    }

    function setUserID($userID)
    {
        $this->userID = $userID;
    }

    function setUserName($userName)
    {
        $this->userID = $userName;
    }

    function setUserPhoto($userPhoto)
    {
        $this->userID = $userPhoto;
    }

    function setComment($comment)
    {
        $this->comment = $comment;
    }

    function setDate($date)
    {
        $this->date = $date;
    }

    function setTime($time)
    {
        $this->time = $time;
    }


    function getPostID()
    {
        return $this->postID;
    }

    function getUserID()
    {
        return $this->userID;
    }

    function getUsername()
    {
        return $this->username;
    }

    function getUserPhoto()
    {
        return $this->userphoto;
    }

    function getComment()
    {
        return $this->comment;
    }

    function getDate()
    {
        return $this->date;
    }

    function getTime()
    {
        return $this->time;
    }


    function createComment($postID, $comment)
    {
        if ($_POST["comment"]) {

            $this->postID = $postID;
            $this->userID = $_SESSION["userid"];
            $this->comment = $comment;
            $this->date = date("Y/m/d");
            $this->time = date("h:i:sa");

            //db connection.
            require('../../CommonFiles/dbConn.php');

            $sql = "INSERT INTO postcomment (pcid,postid,userid,comment,commentdate,commenttime) VALUES (NULL, '$this->postID','$this->userID','$this->comment','$this->date','$this->time')";

            if (mysqli_query($conn, $sql)) {
                echo("Comment Successful.");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
    }

    function loadComment($PCID)
    {

        //db connection.
        require('../CommonFiles/dbConn.php');

        $sql = "SELECT postComment.pcid, postComment.postid, postComment.userid, postComment.comment, postComment.commentdate, postComment.commenttime,
                userdetails.userid, userdetails.firstname, userdetails.lastname,
                post.postid
                FROM postComment, userdetails, post
                WHERE postComment.postid = post.postid AND userdetails.userid=postComment.userid AND postComment.pcid='$PCID';";

        if ($resultCurComment = mysqli_query($conn, $sql)) {
            $rowCurComment = mysqli_fetch_array($resultCurComment);
            //echo($rowCurPost['text']);

            $this->PCID = $rowCurComment['pcid'];
            $this->postID = $rowCurComment['postid'];
            $this->userID = $rowCurComment['userid'];
            $this->username = $rowCurComment['firstname'] . ' ' . $rowCurComment['lastname'];
            $this->userphoto = "../img/user/img-" . $rowCurComment['userid'] . ".jpg";
            $this->comment = $rowCurComment['comment'];
            $this->date = $rowCurComment['commentdate'];
            $this->time = $rowCurComment['commenttime'];

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);

    }
}


class response
{

    private $respID;
    private $postID;
    private $userID;
    private $respType;
    private $date;
    private $time;
    private $likeColor = 'gray';
    private $dislikeColor = 'gray';
    private $likeStatus;
    private $dislikeStatus;


    function setRespID($respID)
    {
        $this->respID = $respID;
    }

    function setPostID($respID)
    {
        $this->postID = $postID;
    }

    function setUserID($userID)
    {
        $this->userID = $userID;
    }

    function setRespType($respType)
    {
        $this->respType = $respType;
    }

    function setDate($date)
    {
        $this->date = $date;
    }

    function setTime($time)
    {
        $this->time = $time;
    }


    function getRespID()
    {
        return $this->respID;
    }

    function getPostID()
    {
        return $this->postID;
    }

    function getUserID()
    {
        return $this->userID;
    }

    function getRespType()
    {
        return $this->respType;
    }

    function getDate()
    {
        return $this->date;
    }

    function getTime()
    {
        return $this->time;
    }

    function getLikeColor()
    {
        return $this->likeColor;
    }

    function getDislikeColor()
    {
        return $this->dislikeColor;
    }

    function getLikeStatus()
    {
        return $this->likeStatus;
    }

    function getDislikeStatus()
    {
        return $this->dislikeStatus;
    }


    function processResponse($postID, $respType)
    {

        $this->postID = $postID;
        $this->userID = $_SESSION["userid"];
        $this->respType = $respType;
        $this->date = date("Y/m/d");
        $this->time = date("h:i:sa");

        //db connection.
        require('../../CommonFiles/dbConn.php');

        //ALTER TABLE postresponse ADD UNIQUE KEY foo (bar1, bar2);
        $sql = "INSERT INTO postresponse( respid, postid, userid, type , date, time )
                    VALUES (NULL , '$this->postID', '$this->userID', '$this->respType', '$this->date', '$this->time')
                    ON DUPLICATE KEY UPDATE type='dl'";

        if (mysqli_query($conn, $sql)) {
            mysqli_query($conn, "DELETE FROM postresponse WHERE type='dl';");

            if ($this->respType == 'up') {
                $resultLikes = mysqli_query($conn, "SELECT count(*) AS likes from postresponse WHERE type='up' AND postid='$this->postID';");
                $rowLikes = mysqli_fetch_array($resultLikes);
                $totLikes = $rowLikes['likes'];
                mysqli_query($conn, "UPDATE post SET postlikes='$totLikes' WHERE postid='$this->postID';");

            } else if ($this->respType == 'dn') {
                $resultDislikes = mysqli_query($conn, "SELECT count(*) AS dislikes from postresponse WHERE type='dn' AND postid='$this->postID';");
                $rowDislikes = mysqli_fetch_array($resultDislikes);
                $totDislikes = $rowDislikes['dislikes'];
                mysqli_query($conn, "UPDATE post SET postdislikes='$totDislikes' WHERE postid='$this->postID';");

            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);

    }


    function loadResponse($postID)
    {

        $this->postID = $postID;
        $this->userID = $_SESSION["userid"];

        //db connection.
        require('../CommonFiles/dbConn.php');

        $sqlResp = "SELECT postid, userid, type FROM postresponse WHERE postid='$this->postID' AND userid='$this->userID';";

        if ($resultResp = mysqli_query($conn, $sqlResp)) {
            $rowResp = mysqli_fetch_array($resultResp);

            if ($rowResp['type'] == 'up') {
                $this->likeColor = 'green';
                $this->dislikeColor = 'gray';
                $this->likeStatus = '';
                $this->dislikeStatus = 'disabled';
            } elseif ($rowResp['type'] == 'dn') {
                $this->likeColor = 'gray';
                $this->dislikeColor = 'red';
                $this->likeStatus = 'disabled';
                $this->dislikeStatus = '';
            }
        } else {
            $this->likeColor = 'gray';
            $this->dislikeColor = 'gray';
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}


class spottedBird
{

    private $sbID;
    private $userID;
    private $birdID;
    private $date;
    private $time;
    private $location;
    private $season;

    function setsbID($sbID)
    {
        $this->sbID = $sbID;
    }


    function setUserID($userID)
    {
        $this->userID = $userID;
    }

    function setBirdID($birdID)
    {
        $this->birdID = $birdIDe;
    }

    function setDate($date)
    {
        $this->date = $date;
    }

    function setTime($time)
    {
        $this->time = $time;
    }

    function setLocation($location)
    {
        $this->location = $location;
    }


    function getsbID($sbID)
    {
        return $this->sbID;
    }

    function getUserID($userID)
    {
        return $this->userID;
    }

    function getBirdID($birdID)
    {
        return $this->birdID;
    }

    function getDate($date)
    {
        return $this->date;
    }

    function getTime($time)
    {
        return $this->time;
    }

    function getLocation($location)
    {
        return $this->location;
    }


    function addBird($birdID, $locationID, $photo)
    {

        $this->birdID = $birdID;
        $this->userID = $_SESSION["userid"];
        $this->date = date("Y/m/d");
        $this->time = date("h:i:sa");
        $this->location = $locationID;

        //db connection.
        require('../../CommonFiles/dbConn.php');

        $sql = "INSERT INTO spottedbirdlist( sbid, userid, birdid , spotteddate, spottedtime, spottedlocationid )
                    VALUES (NULL , '$this->userID', '$this->birdID', '$this->date', '$this->time', '$this->location')";

        if (mysqli_query($conn, $sql)) {
            echo("Added.");
            $lastID = mysqli_insert_id($conn);

            $imageData = base64_decode($photo);
            $source = imagecreatefromstring($imageData);
            $rotate = imagerotate($source, 0, 0); // if want to rotate the image
            $imageSave = imagejpeg($rotate, '../images/spotted-birds/' . $lastID . '.jpg', 100);
            imagedestroy($source);

            $season = 0;
            if (date('m') >= 5 || date('m') <= 8) {
                $season = 1;
            } else {
                $season = 2;
            }
            $sql = "SELECT birdid, spotteddate, spottedlocationid FROM spottedbirdlist WHERE birdid='$this->birdID' AND spottedlocationid='$this->location' GROUP BY spotteddate;";
            $count = mysqli_num_rows(mysqli_query($conn, $sql));

            echo("Count: " . $count);
            if ($count == 10) {
                $sql = "INSERT INTO blss( birdid,locationid,seasonid,status)VALUES ('$this->birdID' , '$this->location', '$this->season', '0')";

                if (mysqli_query($conn, $sql)) {
                    echo('Added to blss');
                } else {
                    echo "Error adding to blss table: " . $sql . "<br>" . mysqli_error($conn);
                }
            }

        } else {
            echo "Error adding to spottedbirdlist table: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

}


class bird
{

    private $bID;
    private $details;
    private $commName;
    private $sciName;
    private $sinName;
    private $othName;
    private $size;
    private $shapeID;
    private $shapeName;
    private $rlID;
    private $rlCat;


    public function getShapeName()
    {
        return $this->shapeName;
    }

    public function setShapeName($shapeName)
    {
        $this->shapeName = $shapeName;
    }

    public function getRlCat()
    {
        return $this->rlCat;
    }

    public function setRlCat($rlCat)
    {
        $this->rlCat = $rlCat;
    }

    public function getBID()
    {
        return $this->bID;
    }

    public function setBID($bID)
    {
        $this->bID = $bID;
    }

    public function getCommName()
    {
        return $this->commName;
    }

    public function setCommName($commName)
    {
        $this->commName = $commName;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function setDetails($details)
    {
        $this->details = $details;
    }

    public function getOthName()
    {
        return $this->othName;
    }

    public function setOthName($othName)
    {
        $this->othName = $othName;
    }


    public function getRlID()
    {
        return $this->rlID;
    }

    public function setRlID($rlID)
    {
        $this->rlID = $rlID;
    }

    public function getSciName()
    {
        return $this->sciName;
    }

    public function setSciName($sciName)
    {
        $this->sciName = $sciName;
    }

    public function getShapeID()
    {
        return $this->shapeID;
    }

    public function setShapeID($shapeID)
    {
        $this->shapeID = $shapeID;
    }

    public function getSinName()
    {
        return $this->sinName;
    }

    public function setSinName($sinName)
    {
        $this->sinName = $sinName;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    function loadBird($bid)
    {

        //db connection.
        require('../CommonFiles/dbConn.php');

        $sql = "SELECT birdid,details,commonname,scientificname,sinhalaname,othername,size,shapeid,redlistid,
                (SELECT shapename from shape WHERE birddetails.shapeid=shape.shapeid) AS shapename,
                (SELECT category from redlist WHERE birddetails.redlistid=redlist.redlistid) AS rlcategory FROM birddetails WHERE birdid='$bid';";

        if ($resultBird = mysqli_query($conn, $sql)) {

            $rowBird = mysqli_fetch_array($resultBird);

            $this->bID = $rowBird['birdid'];
            $this->details = $rowBird['details'];
            $this->commName = $rowBird['commonname'];
            $this->sciName = $rowBird['scientificname'];
            $this->sinName = $rowBird['sinhalaname'];
            $this->othName = $rowBird['othername'];
            $this->size = $rowBird['size'];
            $this->shapeID = $rowBird['shapeid'];
            $this->shapeName = $rowBird['shapename'];
            $this->rlID = $rowBird['redlistid'];
            $this->rlCat = $rowBird['rlcategory'];

        } else {
            echo "Error: " . $sql . " < br>" . mysqli_error($conn);
        }

        mysqli_close($conn);

    }


}

class locSuggest
{

    private $bID;
    private $locIDs = array();
    private $seasonID;
    private $status;
    private $birds = array();


    public function getBID()
    {
        return $this->bID;
    }

    public function setBID($bID)
    {
        $this->bID = $bID;
    }

    public function getBirds()
    {
        return $this->birds;
    }

    public function setBirds($birds)
    {
        $this->birds = $birds;
    }

    public function getLocID()
    {
        return $this->locID;
    }

    public function setLocID($locID)
    {
        $this->locID = $locID;
    }

    public function getSeasonID()
    {
        return $this->seasonID;
    }

    public function setSeasonID($seasonID)
    {
        $this->seasonID = $seasonID;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getLocSuggest($birds)
    {
        //db connection.
        require('../../CommonFiles/dbConn.php');

        $birdcount = 0;
        $tmpbirds = array();

        foreach ($birds as $bird) {
            array_push($tmpbirds, $bird);
            $birdcount += 1;
        }

        $season = 0;
        if (date('m') >= 5 || date('m') <= 8) {
            $season = 1;
        } else {
            $season = 2;
        }

        //echo(implode($tmpbirds));

        $sql = "SELECT birdid,locationid,seasonid, COUNT(1) AS rpt_count FROM blss WHERE birdid IN (" . implode(',', $tmpbirds) . ") AND seasonid='$season' GROUP BY locationid";


        if ($result = mysqli_query($conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                if ($birdcount == $row['rpt_count']) {
                    array_push($this->locIDs, $row['locationid']);
                }
            }

        } else {
            echo "Error: " . $sql . " < br>" . mysqli_error($conn);
        }
        return $this->locIDs;
        mysqli_close($conn);
    }


}



