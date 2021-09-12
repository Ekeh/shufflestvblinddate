<?php
require_once("db.php");
require_once("constants.php");
header("Content-type: application/json");

/*<Force users to update app>*/
    /*$result =  ["success" => false, "message" => "Please update your app. This version is no longer supported.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();*/
/*</ End of Force users to update app>*/



$headers = apache_request_headers();
$code = $headers['Accesstoken'];
$result = [];
if($code !== CONSTANTS_ACCESS_TOKEN){
    $result =  ["success" => false, "message" => "Unauthorized.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}
$requestArray = json_decode(file_get_contents('php://input'), true);
if(empty($requestArray["postid"]) || empty($requestArray["userid"])){
    $result =  ["success" => false, "message" => "Required data was not sent.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}
$postid=mysqli_real_escape_string($db, $requestArray["postid"]);
$userid=mysqli_real_escape_string($db, $requestArray["userid"]);

$sql = mysqli_query($db,"SELECT postid FROM tbl_likes where postid='$postid' and userid='$userid'");
if(mysqli_num_rows($sql) > 0){
    $result =  ["success" => false, "message" => "You have submitted your like for this video before. You can only like a video once.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}

$sql = mysqli_query($db,"INSERT into tbl_likes (postid, userid) VALUES($postid,$userid)");

if(mysqli_affected_rows($db) > 0){
  $sql2 = mysqli_query($db,"SELECT postid FROM tbl_likes where postid='$postid' and userid='$userid'");
$nums2 = mysqli_num_rows($sql2);

$sql3 = mysqli_query($db,"SELECT postid FROM tbl_likes where postid='$postid'");
$nums3=mysqli_num_rows($sql3);

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



?>
