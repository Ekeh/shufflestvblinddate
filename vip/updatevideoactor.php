<?php

     include("../inc/db.php"); 

$query=mysqli_query($db,"SELECT * FROM  tbl_vip_watched group by video_id  ");      
      while($row=mysqli_fetch_array($query))
  {

$vid=$row['video_id'];
$q=mysqli_query($db,"SELECT * FROM tbl_vip_videos where video_id='$vid'");      
      while($rows=mysqli_fetch_array($q)){
$aid=$rows['actor_id'];
echo $aid;
echo "<br>";
$u=mysqli_query($db,"UPDATE tbl_vip_watched set  actor_id='$aid' where video_id='$vid'");      
echo "done ".$vid;
echo "<br>";
      }
}

?>
