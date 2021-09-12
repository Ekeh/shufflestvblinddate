<?php
/**
 * Created by IntelliJ IDEA.
 * User: Fidelis
 * Date: 12/11/2019
 * Time: 12:54
 */
require_once("db.php");
require_once("constants.php");
require_once("accessValidations.php"); //Todo: The access of the user is validated in this file.
header("Content-type: application/json");


$requestArray = json_decode(file_get_contents('php://input'), true);
if(empty($requestArray["userId"]) || empty($requestArray["contestantId"])){
    $result =  ["success" => false, "message" => "Required data was not sent.", "data"=> null];
    mysqli_close($db);
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
    mysqli_close($db);
    echo json_encode($result);
    exit();
}

$voteSql = mysqli_query($db,"INSERT into tbl_votes (contestantid, userid) VALUES($contestantId, $userId)");
if(mysqli_affected_rows($db) > 0){
 $accountBalance -= $voteAmount;
 ///$creditSql = mysqli_query($db,"UPDATE tbl_users SET credit='$accountBalance' where userid='$userId'");
if(mysqli_affected_rows($db) > 0) {
   /* $voteCountSql = mysqli_query($db, "SELECT COUNT(contestantid) totalVotes FROM `tbl_votes` where contestantid = $contestantId");
    $result = mysqli_fetch_assoc($voteCountSql);
    $totalVotes = $result['totalVotes'];
    */
////// end the comment here
/*
    $contestantSql = mysqli_query($db, "UPDATE `tbl_selection` SET `vote`= vote + 1  WHERE selection_id=$contestantId");
    if (mysqli_affected_rows($db) > 0) {
        $result = ["success" => true, "message" => "Your vote was successfully completed. Thank you.", "data" => null];
        mysqli_close($db);
        echo json_encode($result);
        exit();
    }else{
    $result =  ["success" => false, "message" => "Error occurred while completing your request.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}
*/
//// comment this when you want to go live

 $result = ["success" => false, "message" => "Voting has ended for the week.", "data" => null];
  echo json_encode($result);
    exit();
}else{
    $result =  ["success" => false, "message" => "Error occurred while completing your request.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}
}else{
    $result =  ["success" => false, "message" => "Error occurred while completing your request.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}



?>
