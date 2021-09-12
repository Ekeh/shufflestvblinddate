 <!-- contents -->
     <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5db54b841de87700125fca76&product=inline-share-buttons" async="async"></script>
        <div class="main_content">
    <div class="main_content_inner" align="center">
               <div class="uk-card-default  p-3 uk-width-1-1@m rounded" style="padding: 10px" 
 <div align="left">
 	<h3>Your referral ID is <?php echo $_COOKIE['userid']; ?> </h3>
 
<br><br>

<?php
$userid=$_COOKIE['userid'];
$chk = mysqli_query($db,"SELECT * FROM tbl_vip_watched  where actor_id='$userid'  ");
$nms=mysqli_num_rows($chk);
				?>	
						<h3>Those that have viewed your video - <?php echo $nms; ?></h3>
		
					
				
		
			
<table class="table" width="100%">
	<tr class="theader"><td>S/No</td><td>Video Title</td><td>Viewer</td><td>Date</td><td>Video Cost</td><td>Earnings</td></tr>

<?php
$cnt=1;
$userid=$_COOKIE['userid'];
$query=mysqli_query($db,"SELECT * FROM tbl_vip_videos INNER JOIN tbl_vip_watched
    ON tbl_vip_videos.video_id = tbl_vip_watched.video_id where tbl_vip_watched.actor_id='$userid'      order by rand()   ");      
      while($row=mysqli_fetch_array($query))
  {
    $vid_title=$row['vid_title'];
      $date=$row['date'];
     $viewer=$row['userid'];
      $video_amount=$row['video_amount'];
if($video_amount!='0'){
      $commission=($video_amount*80)/100;
}else{$commission=0;}
     ?>
<tr><td><?php echo $cnt; ?></td><td><?php echo $vid_title; ?></td><td><?php echo $viewer; ?></td><td><?php echo $date; ?></td><td><?php echo $video_amount; ?></td><td><?php echo $commission; ?></td></tr>

     <?php

$cnt++;
}

?>


</table>

 </div>

                    </div>
 <br><br>
  
                
</div>
                </div>



            