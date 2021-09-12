<?php

require_once("db.php");


$strfname=mysqli_real_escape_string($db,$_POST['username']);
$strlname=mysqli_real_escape_string($db,$_POST['lname']);
$stremail=mysqli_real_escape_string($db,$_POST['email']);
$strphone=mysqli_real_escape_string($db,$_POST['phone']);
$strpassword=mysqli_real_escape_string($db,$_POST['password']);



$password=md5($strpassword);


$sql2 = mysqli_query($db,"SELECT * FROM tbl_users where email='$stremail' OR phone='$strphone'");
$nums2=mysqli_num_rows($sql2);


if($nums2!='0'){
  $rws = mysqli_fetch_array($sql2,MYSQLI_ASSOC); 
    
    if($stremail==($rws['email'])){
   echo "failed:".$stremail." Already exists:".$idz.":".$stremail.":".$fn." ".$ln.":".$fn.":".$ln.":".$strphone."";
    }else{
  echo "failed:".$strphone." Already exists:".$idz.":".$stremail.":".$fn." ".$ln.":".$fn.":".$ln.":".$strphone."";
    }
  

}else{



$useripaddress=$_SERVER['REMOTE_ADDR'];
$sql3 = mysqli_query(
    $db,"INSERT into tbl_users set email='$stremail', password='$password',fname='$strfname',lname='$strlname', phone='$strphone',useripaddress='$useripaddress',shuffles_app='1',activation_status='1'"); 
    
    
           if($sql3){


$sql4 = mysqli_query($db,"SELECT * FROM tbl_users where email='$stremail' and password='$password'");
$rows = mysqli_fetch_array($sql4,MYSQLI_ASSOC); 
$idz=$rows['userid'];
$fn=$rows['fname'];
$ln=$rows['lname'];
$phone=$rows['phone'];
$credit=$rows['credit'];
echo "success: Registration Successful, you will be logged in:".$idz.":".$stremail.":".$fn." ".$ln.":".$fn.":".$ln.":".$phone.":".$credit." units";
           }else{
echo "failed: Registration Failed:".$idz.":".$stremail.":".$fn." ".$ln.":".$fn.":".$ln.":".$phone."";               
           }





}
/*

echo "success: Registration Completed:12:test@we.com:Peter Okolie:Peter:Okolie:+2348066164453";
*/
?>