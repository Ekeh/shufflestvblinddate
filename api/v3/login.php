<?php
/**
 * User=> Fidelis
 * Date=> 18/10/2019
 * Time=> 05=>12
 */
require_once("db.php");
require_once("constants.php");
header("Content-type: application/json");
$headers = apache_request_headers();
$code = $headers['Accesstoken'];
$deviceImei = $headers['Deviceimei'];
$result = [];
if($code !== CONSTANTS_ACCESS_TOKEN){
    $result =  ["success" => false, "message" => "Unauthorized.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}
if(empty($deviceImei)){
    $result =  ["success" => false, "message" => "Phone unique id not sent.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}

$inputArray = json_decode(file_get_contents('php://input'), true);
if(empty($inputArray["email"]) || empty($inputArray["password"])){
    $result =  ["success" => false, "message" => "Email and password are required.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}

$stremail = mysqli_real_escape_string($db, $inputArray["email"]);
$strpassword = mysqli_real_escape_string($db, $inputArray["password"]);

$password = md5($strpassword);
$sql2 = mysqli_query($db,"SELECT * FROM tbl_users where email='$stremail' and password= '$password'");

$nums2=mysqli_num_rows($sql2);
      if($nums2 !== 0){
          $rows = mysqli_fetch_array($sql2, MYSQLI_ASSOC);

          //Todo: Flat

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
              mysqli_query($db,"UPDATE tbl_users SET shuffles_app='1' where userid='{$rows['userid']}' LIMIT 1");
              $result =  ["success" => true, "message" => "Login Successful",
              "data" => ["userid"=> $userid,"email"=> $stremail, "fname"=>$fname,
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
mysqli_close($db);
echo json_encode($result);

