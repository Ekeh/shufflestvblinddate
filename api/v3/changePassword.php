<?php
/**
 * User=> Fidelis
 * Date=> 18/10/2019
 * Time=> 05=>12
 */

require_once("db.php");
require_once("constants.php");
require_once("accessValidations.php"); //Todo: The access of the user is validated in this file.
header("Content-type: application/json");


$query=mysqli_query($db,"SELECT * FROM tbl_channels order by name asc ");
$num=mysqli_num_rows($query);
$cnt=1;
if($num !== '0')
{
    $data = [];
    while($row=mysqli_fetch_array($query, MYSQLI_ASSOC))
    {
        $data[] = $row;

    }
    $result =  ["success" => true, "message" => "Channels fetched successfully.", "data"=> $data];
}else{
    $result =  ["success" => true, "message" => "No channels found.", "data"=> []];
}


//Todo: Data is sent in json format
$inputArray = json_decode(file_get_contents('php://input'), true);
//Todo: Validations
$requiredFields = '';
if(empty($inputArray["userid"])){
    $requiredFields = 'User id is required.';
}else if(empty($inputArray["currentPassword"])){
    $requiredFields = 'Current password is required.';
}else if(empty($inputArray["newPassword"])){
    $requiredFields = 'New password is required.';
}

//Todo: Check is validation failed
if(!empty($requiredFields)){
    $result =  ["success" => false, "message" => $requiredFields, "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}

$currentPassword = md5(mysqli_real_escape_string($db,$inputArray['currentPassword']));
$newPassword = md5(mysqli_real_escape_string($db,$inputArray['newPassword']));
$userid=mysqli_real_escape_string($db, $inputArray['userid']);

   $sql2 = mysqli_query($db,"SELECT userid, password FROM tbl_users where userid=$userid and password = '$currentPassword'");
  $nums=mysqli_num_rows($sql2);
   if($nums === 0){
        $result =  ["success" => false, "message" => "Current password does not match your password.", "data"=> null];
        mysqli_close($db);
        echo json_encode($result);
        exit();
   }else{

       $rws = mysqli_fetch_array($sql2,MYSQLI_ASSOC);
       if($newPassword === $rws["password"]){
         $result =  ["success" => false, "message" => "Please enter a password different from your current password.", "data"=> null];
         mysqli_close($db);
        echo json_encode($result);
        exit();
       }else{
         $sql1 = mysqli_query(
        $db,"UPDATE tbl_users set password='$newPassword' WHERE userid=$userid LIMIT 1"
    );
    if(mysqli_affected_rows($db) > 0){
          $result =  ["success" => true, "message" => "Password updated successfully.",
              "data" => null];
              mysqli_close($db);
        echo json_encode($result);
        exit();
   }else{
       $result =  ["success" => false, "message" => "No changes where made to your password. Make you it is not your previous password.",
              "data" => null];
              mysqli_close($db);
        echo json_encode($result);
        exit();
   }
       }


   }



?>
