<?php
/**
 * User=> Fidelis
 * Date=> 18/10/2019
 * Time=> 05=>12
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
$code = (!empty($headers['Authorization'])) ? $headers['Authorization'] : $headers['Accesstoken'];
$result = [];
if($code !== CONSTANTS_ACCESS_TOKEN){
    $result =  ["success" => false, "message" => "Unauthorized.", "data"=> null];
    echo json_encode($result);
    exit();
}
$searchArray = json_decode(file_get_contents('php://input'), true);
if(empty($searchArray["email"]) || empty($searchArray["password"])){
    $result =  ["success" => false, "message" => "Email and password are required.", "data"=> null];
    echo json_encode($result);
    exit();
}
$stremail=mysqli_real_escape_string($db, $searchArray["email"]);
$strpassword=mysqli_real_escape_string($db, $searchArray["password"]);

$password=md5($strpassword);
$sql2 = mysqli_query($db,"SELECT * FROM tbl_users where email='$stremail' and password= '$password'");

$nums2=mysqli_num_rows($sql2);
      if($nums2!== 0){
          $rows = mysqli_fetch_array($sql2, MYSQLI_ASSOC);
          $fname=$rows["fname"];
          $lname=$rows["lname"];
          $userphone=$rows["phone"];
          $useremail=$rows["email"];
          $userid=$rows["userid"];
          $credit=$rows["credit"];
          $actstatus=$rows["activation_status"];

          if($actstatus === "0") {
              $result =  ["success" => false, "message" => "Your account is not activated. You must verify your profile to continue", "data"=> null];
          } else{
              $update = mysqli_query($db,"UPDATE  tbl_users set shuffles_app='1' where userid='$uerid'");
          $result =  ["success" => true, "message" => "Login Successful",
              "data" => ["userid"=>$userid,"email"=> $stremail, "fname"=>$fname,
                  "lname"=> $lname, "phone"=> $userphone, "activation_status"=> $actstatus, "credit"=> $credit]];
         }

      }else{
          $sql1 = mysqli_query($db,"SELECT * FROM tbl_users where email='$stremail'");
            $nums=mysqli_num_rows($sql1);

            if($nums !== 0){
                $result =  ["success" => false, "message" => "Invalid password", "data" => null];
            }
            else
            {
                $result =  ["success" => false, "message" => "Email does not exist", "data" => null];
            }
}

echo json_encode($result);

?>