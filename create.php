<?php
require_once('inc/db.php');

///$query=mysqli_query($db,"SELECT * FROM tbl_requests");  
$s=$_GET['s'];
$d=$_GET['d'];
if($s!=''){
    $query=mysqli_query($db,"SELECT * FROM tbl_requests where postid >= $s");   
 
}elseif($d!=''){
$query=mysqli_query($db,"SELECT * FROM tbl_requests where postid = $d");  
}else{
 $query=mysqli_query($db,"SELECT * FROM tbl_requests where postid > 790");   
    
}
$cnt=1;
while($row=mysqli_fetch_array($query))
	{

$postid=$row['postid'];

if(file_exists("uploads/videos/".$postid.".mp4")){
$time = 1;
$video = 'uploads/videos/'.$postid.'.mp4';
$image = 'uploads/thumbs/'.$postid.'.png';
$ffmpeg = 'usr/bin/ffmpeg/ffmpeg';

$interval = 1; 
$size = '320x240';  
//ffmpeg command  
$cmd = "$ffmpeg -i $video -deinterlace -an -ss $interval -f mjpeg -t 1 -r 1 -y -s $size $image 2>&1";


$chk=exec($cmd);
       
if($chk){
    if(!file_exists("uploads/thumbs/".$postid.".png")){
        echo $cnt."-". $postid. "-Creation Failed <br>";
        }else{echo $cnt."-". $postid. "-Thumbnail has been added <br>";}
    
}else{echo $cnt."-failed <br>";}
}else{echo $cnt."-". $postid. "-Does not exist <br>";}

$cnt++;
}

?>