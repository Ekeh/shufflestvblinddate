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

//Todo: Data is sent in json format
$inputArray = json_decode(file_get_contents('php://input'), true);
//Todo: Validations
$requiredFields = '';
if(empty($inputArray["userid"])){
    $requiredFields = 'User id is required.';
}

//Todo: Check is validation failed
if(!empty($requiredFields)){
    $result =  ["success" => false, "message" => $requiredFields, "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}

$userid = $inputArray["userid"];
$rows = [];
$sql2 = mysqli_query($db,"SELECT * FROM tbl_users where userid=$userid");
$profile = null;
$nums2 = mysqli_num_rows($sql2);
      if($nums2 !== 0){
          $profile = mysqli_fetch_array($sql2, MYSQLI_ASSOC);
          $fname=$profile["fname"];
          $lname=$profile["lname"];
          $userphone=$profile["phone"];
          $useremail=$profile["email"];
          $userid=$profile["userid"];
          $credit=$profile["credit"];
          $actstatus=$profile["activation_status"];
          $rows['user'] = ["userid"=>$userid,"email"=> $useremail, "fname"=>$fname,
                  "lname"=> $lname, "phone"=> $userphone, "activation_status"=> $actstatus,"credit"=> $credit];
      }

$query=mysqli_query($db,"SELECT * FROM tbl_settings");
$num=mysqli_num_rows($query);
$settings = [];
if($num!='0')
{
  while($row=mysqli_fetch_assoc($query)){
      $settings[] = $row;
  }
$rows['settings'] = $settings;
}

 $result =  ["success" => true, "message" => "Profile details successfully refreshed.",
              "data" => $rows];
mysqli_close($db);
echo json_encode($result);
exit();
?>
