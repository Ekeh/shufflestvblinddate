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
$code = $headers['Accesstoken'];
$result = [];
if($code !== CONSTANTS_ACCESS_TOKEN){
    $result =  ["success" => false, "message" => "Unauthorized.", "data"=> null];
    echo json_encode($result);
    exit();
}

//Todo: Data is sent in json format
$inputArray = json_decode(file_get_contents('php://input'), true);
//Todo: Validations
$requiredFields = '';
if(empty($inputArray["fname"])){
    $requiredFields = 'First name is required.'; 
}else if(empty($inputArray["lname"])){
    $requiredFields = 'Last name is required.';
}else if(empty($inputArray["email"])){
    $requiredFields = 'Email is required.';
}else if(empty($inputArray["phone"])){
    $requiredFields = 'Phone number is required.';
}else if(empty($inputArray["password"])){
    $requiredFields = 'Password is required.';
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
$strpassword=mysqli_real_escape_string($db,$inputArray['password']);
$password=md5($strpassword);

$sql2 = mysqli_query($db,"SELECT * FROM tbl_users where email='$stremail' OR phone='$strphone'");
$nums2=mysqli_num_rows($sql2);

if($nums2!='0'){
    $rws = mysqli_fetch_array($sql2,MYSQLI_ASSOC);

    if($stremail==($rws['email'])){
        $result =  ["success" => false, "message" => "Oops! '$stremail' already taken. Please provide a different email to continue.", "data"=> null];
    }else{
        $result =  ["success" => false, "message" => "Oops! '$strphone' already taken. Please provide a different phone  number to continue.", "data"=> null];

    }


}else{
    $useripaddress=$_SERVER['REMOTE_ADDR'];
    $sql3 = mysqli_query(
        $db,"INSERT into tbl_users set email='$stremail', password='$password',fname='$strfname',lname='$strlname', phone='$strphone',useripaddress='$useripaddress',shuffles_app='1', activation_status = '1'"
    );
    if(mysqli_affected_rows($db) > 0){
        $result =  ["success" => true, "message" => "Your account was successfully created. Please continue to activate your account.", "data"=> null];
    }else{
        $result =  ["success" => false, "message" => "Oops! Registration Failed. Please try again later.", "data"=> null];
    }

}
echo json_encode($result);
exit();
?>