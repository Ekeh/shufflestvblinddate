<?php
require_once("db.php");


$postid=mysqli_real_escape_string($db,$_GET['postid']);
$userid=mysqli_real_escape_string($db,$_GET['userid']);
$code=mysqli_real_escape_string($db,$_GET['code']);

if($code=='88343a4758ad5bd50971e643e2f2b7de'){
    
$sql = mysqli_query($db,"INSERT into tbl_likes set postid='$postid',userid='$userid'");

$sql2 = mysqli_query($db,"SELECT * FROM tbl_likes where postid='$postid' and userid='$userid'");
$nums2=mysqli_num_rows($sql2);

$sql3 = mysqli_query($db,"SELECT * FROM tbl_likes where postid='$postid'");
$nums3=mysqli_num_rows($sql3);


	echo "$nums2:$nums3";

}else{
    
     header("Location: https://www.shufflestv.com/");  
}	


?>