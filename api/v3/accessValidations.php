<?php
header("Content-type: application/json");
$headers = apache_request_headers();
$code = $headers['Accesstoken'];
$deviceImei = $headers['Deviceimei'];
$userid = $headers['Userid'];
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
if(empty(intval($userid))){
    $result =  ["success" => false, "message" => "User token not sent.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}

//Todo: Validate IMEI number before allowing access
/*$deviceImei = mysqli_real_escape_string($db, $deviceImei);
$sqlImei = mysqli_query($db,"SELECT userid FROM tbl_users where device_imei = '$deviceImei' LIMIT 1");
$numCount = mysqli_num_rows($sqlImei);

if($numCount > 0){
    $row = mysqli_fetch_array($sqlImei, MYSQLI_ASSOC);
    if($row['userid'] != $userid){
        $result =  ["success" => false, "message" => "Your device is not allowed to access this account.", "data"=> null];
        mysqli_close($db);
        echo json_encode($result);
        exit();
    }
}else{
    $result =  ["success" => false, "message" => "Your device is not granted access to this account. Please logout and log back in.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}*/

