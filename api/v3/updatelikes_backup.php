<?php
require_once("db.php");
require_once("constants.php");
require_once("accessValidations.php"); //Todo: The access of the user is validated in this file.
header("Content-type: application/json");
$accountBalance = 0;
$isPayForLikeEnabled = '0';
$likedUserBefore = false;
$likeAmount = 0;
$requestArray = json_decode(file_get_contents('php://input'), true);
if(empty($requestArray["postid"]) || empty($requestArray["userid"])){
    $result =  ["success" => false, "message" => "Required data was not sent.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}
$postid = mysqli_real_escape_string($db, $requestArray["postid"]);
$userid = mysqli_real_escape_string($db, $requestArray["userid"]);


$sql = mysqli_query($db,"SELECT postid FROM tbl_likes where postid='$postid' and userid='$userid'");
if(mysqli_num_rows($sql) > 0){
    $likedUserBefore = true;
    if(!checkUserAccountBalanceLikingEnabled($db, $userid)){
        $result =  ["success" => false, "message" => "You have submitted your like for this video before. You can only like a video once.", "data"=> null];
        mysqli_close($db);
        echo json_encode($result);
        exit();
    }
}

$sql = mysqli_query($db,"INSERT into tbl_likes (postid, userid) VALUES($postid,$userid)");
if(mysqli_affected_rows($db) > 0){
if($likedUserBefore && $isPayForLikeEnabled == PAY_FOR_LIKES_ENABLED){
    $accountBalance -= $likeAmount;
    $creditSql = mysqli_query($db,"UPDATE tbl_users SET credit='$accountBalance' where userid='$userid'");      
}
$sql2 = mysqli_query($db,"SELECT postid FROM tbl_likes where postid='$postid' and userid='$userid'");
$nums2 = mysqli_num_rows($sql2);

$sql3 = mysqli_query($db,"SELECT postid FROM tbl_likes where postid='$postid'");
$nums3 = mysqli_num_rows($sql3);

 $result =  ["success" => true, "message" => "Your like was successfully saved. Thank you.", "data"=> ["user_likes_for_contestant" => $nums2, "totla_contest_likes" => $nums3 ]];
 mysqli_close($db);
    echo json_encode($result);
    exit();
}else{
    $result =  ["success" => false, "message" => "Error occurred while completing your request.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}

function checkUserAccountBalanceLikingEnabled($db, $userId){
//TODO: Pay for likes enabled
global $accountBalance;
global $isPayForLikeEnabled;
global $likeAmount;
$queryLike = mysqli_query($db, sprintf("SELECT value FROM tbl_settings WHERE name = '%s' LIMIT 1", PAY_FOR_LIKES));
$rowLike = mysqli_fetch_assoc($queryLike);
$isPayForLikeEnabled = $rowLike['value'];

if($isPayForLikeEnabled == PAY_FOR_LIKES_ENABLED){
$creditSql = mysqli_query($db,"SELECT credit FROM tbl_users where userid='$userId'");
$resultCredit = mysqli_fetch_assoc($creditSql);
$accountBalance = doubleval($resultCredit['credit']);

$likeAmountSql = mysqli_query($db, sprintf("SELECT value FROM tbl_settings where name='%s'", LIKE_AMOUNT));
$result = mysqli_fetch_assoc($likeAmountSql);
$likeAmount = doubleval($result['value']);

if($accountBalance < $likeAmount){
    $result =  ["success" => false, "message" => "Insufficient balance. Please add fund to your wallet to complete your like.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}
return true;
}
return false;
}