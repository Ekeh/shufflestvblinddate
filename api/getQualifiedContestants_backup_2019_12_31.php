<?php
require_once("db.php");
require_once("constants.php");
$headers = apache_request_headers();
$code = $headers['Authorization'];

//echo file_get_contents('php://input');
//exit();
header('Content-type: application/json');
if($code=='88343a4758ad5bd50971e643e2f2b7de'){
   // sprintf('This is a %s test string', FOO);
$query=mysqli_query($db, sprintf("SELECT value FROM tbl_settings WHERE name = '%s' LIMIT 1", SHOW_VOTING_NAVIGATION));  
$row=mysqli_fetch_assoc($query);
if($row['value'] == VOTING_ENABLED){
$query=mysqli_query($db,"SELECT * FROM tbl_contestants where status='2'");  
$num=mysqli_num_rows($query);
if($num!='0')
{
    $flag = [];
while($row=mysqli_fetch_assoc($query))
{
    $flag[]=$row;
}
}else{
  $flag='{"success": false,"message" : "No contestant found","items" : ' . json_encode([]).'}';
    echo $flag;
    exit();
}

//echo json_encode($flag);
$flag='{"success": true,"message" : "Contestants fetched successfully.","data" : ' . json_encode($flag).'}';
echo $flag;
mysqli_close($db);

}else{
    $errorType = ERROR_TYPE_VOTING_NOT_STARTED;
 $flag="{\"success\": false,\"message\" : \"Voting is not started. Qualified contestants are only visible when voting has started.\", \"data\": null, \"error_type\": $errorType }";
  echo $flag; 
}
}else{
     $errorType = ERROR_TYPE_UNAUTHORIZED;
 $flag="{\"success\": false,\"message\" : \"Unauthorized\", \"error_type\": $errorType}";
  echo $flag;   
}
?>