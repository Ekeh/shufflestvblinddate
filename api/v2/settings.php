<?php
require_once("db.php");
require_once("constants.php");
header("Content-type: application/json");
$headers = apache_request_headers();
$code = $headers['Accesstoken'];
$result = [];
if($code == CONSTANTS_ACCESS_TOKEN){
$query=mysqli_query($db,"SELECT * FROM tbl_settings");  
$num=mysqli_num_rows($query);
$rows = [];
if($num != '0')
{
  while($row=mysqli_fetch_assoc($query)){
      $rows[] = $row;
  }
  $flag='{"success": true,"message" : "Successful", "data" : ' . json_encode($rows).'}';
 mysqli_close($db);
 echo $flag;
 exit();
}else{
  $flag='{"success": false,"message" : "Item not found", "data" : null}';
   mysqli_close($db);
   echo $flag;
    exit();
}
}else{
    $flag='{"success": false,"message" : "Unauthorized", "data": null}';
  mysqli_close($db);
   echo $flag;  
}
?>