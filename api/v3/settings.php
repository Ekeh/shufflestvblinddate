<?php
require_once("db.php");
require_once("constants.php");
require_once("accessValidations.php"); //Todo: The access of the user is validated in this file.
header("Content-type: application/json");

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
