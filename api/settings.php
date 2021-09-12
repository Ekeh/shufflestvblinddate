<?php
require_once("db.php");
require_once("constants.php");
$code=$_GET['code'];
//echo file_get_contents('php://input');
//exit();
header('Content-type: application/json');
if($code=='88343a4758ad5bd50971e643e2f2b7de'){
$query=mysqli_query($db,"SELECT * FROM tbl_settings");  
$num=mysqli_num_rows($query);
$rows = [];
if($num!='0')
{
  while($row=mysqli_fetch_assoc($query)){
      $rows[] = $row;
  }
$flag='{"success": true,"message" : "Successful", "data" : ' . json_encode($rows).'}';
 echo $flag;
 exit();
}else{
  $flag='{"success": false,"message" : "Item not found", "data" : null}';
    echo $flag;
    exit();
}


}else{
    $flag='{"success": false,"message" : "Unauthorized", "data": null}';
  echo $flag;  
}
?>