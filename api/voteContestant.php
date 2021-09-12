<?php
/**
 * Created by IntelliJ IDEA.
 * User: Fidelis
 * Date: 12/11/2019
 * Time: 12:54
 */
require_once("db.php");
require_once("constants.php");

header("Content-type: application/json");

/*<Force users to update app>*/
    $result =  ["success" => false, "message" => "Please update your app. This version is no longer supported.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
/*</ End of Force users to update app>*/



$headers = apache_request_headers();
$code = $headers['Authorization'];
$result = [];
if($code !=='88343a4758ad5bd50971e643e2f2b7de'){
    $result =  ["success" => false, "message" => "Unauthorized.", "data"=> null];
    echo json_encode($result);
    exit();
}
$requestArray = json_decode(file_get_contents('php://input'), true);
if(empty($requestArray["userId"]) || empty($requestArray["contestantId"])){
    $result =  ["success" => false, "message" => "Required data was not sent.", "data"=> null];
    echo json_encode($result);
    exit();
}
$contestantId=mysqli_real_escape_string($db, $requestArray["contestantId"]);
$userId=mysqli_real_escape_string($db, $requestArray["userId"]);

$creditSql = mysqli_query($db,"SELECT credit FROM tbl_users where userid='$userId'");
$result = mysqli_fetch_assoc($creditSql);
$accountBalance = doubleval($result['credit']);


$voteAmountKey = VOTING_AMOUNT;
$voteAmountSql = mysqli_query($db,"SELECT value FROM tbl_settings where name='$voteAmountKey'");
$result = mysqli_fetch_assoc($voteAmountSql);
$voteAmount = doubleval($result['value']);

if($accountBalance < $voteAmount){
    $result =  ["success" => false, "message" => "Insufficient balance. Please add fund to your wallet to complete your vote.", "data"=> null];
    echo json_encode($result);
    exit();
}

$voteSql = mysqli_query($db,"INSERT into tbl_votes (contestantid, userid) VALUES($contestantId, $userId)");
if(mysqli_affected_rows($db) > 0){
 $accountBalance -= $voteAmount;
 $creditSql = mysqli_query($db,"UPDATE tbl_users SET credit='$accountBalance' where userid='$userId'");
if(mysqli_affected_rows($db) > 0) {
    $voteCountSql = mysqli_query($db, "SELECT COUNT(contestantid) totalVotes FROM `tbl_votes` where contestantid = $contestantId");
    $result = mysqli_fetch_assoc($voteCountSql);
    $totalVotes = $result['totalVotes'];
    
    $contestantSql = mysqli_query($db, "UPDATE `tbl_contestants` SET `votes`= '$totalVotes'  WHERE conid=$contestantId");
    if (mysqli_affected_rows($db) > 0) {
        $result = ["success" => true, "message" => "Your vote was successfully completed. Thank you.", "data" => null];
        echo json_encode($result);
        exit();
    }
}
}else{
    $result =  ["success" => false, "message" => "Error occurred while completing your request.", "data"=> null];
    echo json_encode($result);
    exit();
}



?>
