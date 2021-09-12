 <!-- contents -->
        <div class="main_content">

            <div class="main_content_inner">


                
                <!-- find channals  header -->

                <div class="section-header mt-5">
                    <div>
                            <h3>  History </h3>
                          
                        </div>
                 
                </div>

                <!-- find channals -->
                <div class="uk-child-width-1-4@m uk-grid" style="padding: 10px">
                    <?php
    $userid=$_COOKIE['userid'];
$query=mysqli_query($db,"SELECT * FROM tbl_vip_videos INNER JOIN tbl_vip_watched
    ON tbl_vip_videos.video_id = tbl_vip_watched.video_id where userid='$userid'   order by tbl_vip_watched.video_id desc   limit 48 ");      
      while($row=mysqli_fetch_array($query))
  {

      ?>

                    <div style="padding-bottom: 20px" >
                                                         <?php 
$membership=$_COOKIE['membership'];
$cat=$row['vcat']; 

?> 
         <a href="<?php echo PATH_VIP; ?>?p=more&vid=<?php echo $row['video_id']; ?>&aid=<?php echo $row['actor_id']; ?>" class="video-post">
                              <div class="video-post-thumbnail">
                             <span class="play-btn-trigger"></span>

 <img src="<?php echo SITE_URL; ?>/uploads/vipvideoimages/<?php echo $row["coverimage"]; ?>" alt='<?php echo $row['vid_title']; ?>'>   </div>
</a>
                        <div class="uk-grid-small" uk-grid>
                        
                            <div class="uk-width-expand"  style="padding: 5px">
                                <!--<h4 class="mb-2 uk-text-truncate"><?php echo $row["vid_title"]; ?></h4>-->
                                <p class="uk-text-small">
                               <?php  if($cat=='basic'){?> <span class="video-post-time"> N<?php echo $row['video_amount']; ?><?php////echo strtoupper($cat); ?></span>  <?php }else{ ?> 
                                        <span class="video-post-time" style="background-color: red">N<?php echo $row['video_amount']; ?> <?php ////echo strtoupper($cat); ?></span> <?php } ?>
                                   <!-- <span> 15 Video per week</span>-->
                                </p>
                            </div>
                           
                        </div>

                    </div>

                    <?php 

                }

                ?>
                   

                    </div>
 <br><br>

                

                </div>



            