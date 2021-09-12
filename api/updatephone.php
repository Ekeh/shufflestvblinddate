<?php
require_once("db.php");


$strid=mysqli_real_escape_string($db,$_POST['strid']);
$strphone=mysqli_real_escape_string($db,$_POST['strphone']);


if($strid!=''){

$sql3 = mysqli_query(
    $db,"UPDATE tbl_users set phone='$strphone',activation_status='1' where userid='$strid'"); 
	
if($sql3){

echo "success:".$strphone."";
}else{
    
 echo "failed:".$strphone."";   
}
}

?>