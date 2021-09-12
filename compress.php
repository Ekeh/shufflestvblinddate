<?php
require_once('inc/db.php');
///$query=mysqli_query($db,"SELECT * FROM tbl_requests");  


$query=mysqli_query($db,"SELECT * FROM tbl_requests where postid ='698' ");  
$cnt=1;
while($row=mysqli_fetch_array($query))
	{

$postid=$row['postid'];

if(file_exists("uploads/videos/".$postid.".mp4")){
$time = 3;
$infile= 'uploads/videos/'.$postid.'.mp4';
$outfile = 'uploads/thumbs/'.$postid.'.mp4';
$ffmpeg = 'usr/bin/ffmpeg/ffmpeg';


$interval = 0; 
$size = '320x240';  
//ffmpeg command  
$cmd = "$ffmpeg -i $infile  $outfile 2>&1";


//ffmpeg command  
///$cmd = "$ffmpeg -i $infile -vcodec h264 -acodec aac $outfile";

$chk=exec($cmd);
       
if($chk){echo $cnt."-". $postid. "-compressed  <br>";}else{echo $cnt."-failed - ".$postid."<br>";}
}else{echo $cnt."-". $postid. "-Does not exist <br>";}

$cnt++;
}

?>