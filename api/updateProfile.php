<?php
/**
 * User=> Fidelis
 * Date=> 18/10/2019
 * Time=> 05=>12
 */

require_once("db.php");
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

//Todo: Data is sent in json format
$inputArray = json_decode(file_get_contents('php://input'), true);
//Todo: Validations
$requiredFields = '';
if(empty($inputArray["userid"])){
    $requiredFields = 'User id is required.'; 
}else if(empty($inputArray["fname"])){
    $requiredFields = 'First name is required.';
}else if(empty($inputArray["lname"])){
    $requiredFields = 'Last name is required.';
}else if(empty($inputArray["email"])){
    $requiredFields = 'Email is required.';
}else if(empty($inputArray["phone"])){
    $requiredFields = 'Phone number is required.';
}

//Todo: Check is validation failed
if(!empty($requiredFields)){
    $result =  ["success" => false, "message" => $requiredFields, "data"=> null];
    echo json_encode($result);
    exit();
}

$strfname=mysqli_real_escape_string($db,$inputArray['fname']);
$strlname=mysqli_real_escape_string($db,$inputArray['lname']);
$stremail=mysqli_real_escape_string($db,$inputArray['email']);
$strphone=mysqli_real_escape_string($db,$inputArray['phone']);
$userid=mysqli_real_escape_string($db,$inputArray['userid']);
    $sql1 = mysqli_query(
        $db,"UPDATE tbl_users set fname='$strfname',lname='$strlname', phone='$strphone',useripaddress='$useripaddress' WHERE userid=$userid "
    );
    if(mysqli_affected_rows($db) > 0){
        $result =  ["success" => true, "message" => "Your account was successfully updated.", "data"=> null];
        $sql2 = mysqli_query($db,"SELECT * FROM tbl_users where userid=$userid");

         $rows = mysqli_fetch_array($sql2, MYSQLI_ASSOC);
          $fname=$rows["fname"];
          $lname=$rows["lname"];
          $userphone=$rows["phone"];
          $useremail=$rows["email"];
          $userid=$rows["userid"];
          $actstatus=$rows["activation_status"];

          $result =  ["success" => true, "message" => "Profile update successful.",
              "data" => ["userid"=>$userid,"email"=> $stremail, "fname"=>$fname,
                  "lname"=> $lname, "phone"=> $userphone, "activation_status"=> $actstatus]];
echo json_encode($result);
exit();

  
        
    }else{
        $result =  ["success" => false, "message" => "Oops! Update Failed. Make sure there changes in the field and try again.", "data"=> null];
    }


echo json_encode($result);
exit();
?>