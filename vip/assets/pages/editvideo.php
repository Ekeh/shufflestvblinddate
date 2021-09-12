     <form class="uk-child-width-1-1 uk-grid-small" uk-grid method="POST" action="" enctype="multipart/form-data">

           <input type="hidden" name="vcat" value="basic">
     <?php
     $query=mysqli_query($db,"SELECT * FROM tbl_vip_videos INNER JOIN tbl_users
    ON tbl_vip_videos.actor_id = tbl_users.userid  where tbl_vip_videos.video_id='$postid'");      
          

while($row=mysqli_fetch_array($query))
  { 
$vid_amount=$row['video_amount'];
$vid_title=$row['vid_title'];
$vid_desc=$row['vid_desc'];
$image=$row['coverimage'];
$video=$row['video'];


  }
  ?>

                 <div class="uk-form-group">
                  <label for="author">Select Video Amount </label>
        <input type="number" name="vid_amount"  value="<?php echo $vid_amount; ?>" class="uk-input">
         
                </div> 

<input type="hidden" name="postid" value="<?php echo $postid; ?>">
               <div class="uk-form-group">
                  <label for="fname"> Video Title</label>
                  <input type="text" class="uk-input" id="vid_title" name="vid_title" placeholder="Enter Video Title " value="<?php echo $vid_title; ?>" required >
                </div> 

                <div class="uk-form-group">
                  <label for="fname"> Video Description</label>
                  <Textarea class="uk-input" id="vid_desc" name="vid_desc" placeholder="Enter Video Description " rows='10' required ><?php echo $vid_desc; ?></Textarea>
                </div> 

 <div class="uk-form-group">
                  <label for="video">Video Cover Image (.jpg,.png,.gif)</label> <br>
                  <input type="file" id="image" name="image"  class="button primary"><br><span class='small'>1280px by 720px</span><br>
  <img src="<?php echo SITE_URL; ?>/uploads/vipvideoimages/<?php echo $image; ?>" alt='<?php echo $row['vid_title']; ?>' width='200px' height='auto'> 
                  <!--<p class="help-block">Example block-level help text here.</p>-->
             </div>
              
                 <div class="uk-form-group">
                  <label for="video">Video (.mp4,.3gp,.avi,.wmv)</label> <br>
                  <input type="file" id="video" name="video"  class="button info"  >
                  <br>
              <video id="video" src="<?php echo SITE_URL; ?>/uploads/vipvideos/<?php echo $video; ?>"  controls="controls" preload="none" width="250px" height="190px"></video>

                  <!--<p class="help-block">Example block-level help text here.</p>-->
             </div>


              <div class="box-footer">
                <button type="submit" class="button success" name="editusernow">Submit</button><br><br>
              </div>