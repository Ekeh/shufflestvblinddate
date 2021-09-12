<?php
$code=$_GET['c'];
if($code=='qwertyqwerty'){
require_once('inc/db.php');

$query=mysqli_query($db,"SELECT * FROM tbl_requests order by postid desc");  
$cnt=1;
while($row=mysqli_fetch_array($query))
	{

$postid=$row['postid'];

if(file_exists("uploads/videos/".$postid.".mp4")){

$newaddress="https://shufflestv.com/uploads/videos/".$postid.".mp4";
$chk = mysqli_query($db,"UPDATE  tbl_requests  set video='$newaddress' where postid='$postid'"); 

       
if($chk){echo $cnt."-". $postid. "-link has been added <br>";}else{echo $cnt."-failed <br>";}
}else{echo $cnt."-". $postid. "-Does not exist <br>";}

$cnt++;
}
}else{
    echo "Wrong location";
}
?>