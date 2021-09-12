 <!-- contents -->
        <div class="main_content">

            <div class="main_content_inner">


                
                <!-- find channals  header -->

                <div class="section-header mt-5">
                    <div>
                            <h3> Search Results </h3>
                            <?php
$searchit=$_POST['searchit'];
                            ?>
                          <span>Showing results for  -- ... <?php echo $searchit; ?></span>
                        </div>
                 
                </div>

                <!-- find channals -->
                <div class="uk-child-width-1-4@m uk-grid" style="padding: 10px">
                    <?php

                    if($searchit!=''){
    
$query=mysqli_query($db,"SELECT * FROM tbl_vip_videos INNER JOIN tbl_users
    ON tbl_vip_videos.actor_id = tbl_users.userid  where tbl_vip_videos.vid_title like '%$searchit%' OR tbl_vip_videos.vid_desc like '%$searchit%'  OR tbl_vip_videos.vcat like '%$searchit%' OR tbl_users.username like '%$searchit%' OR tbl_users.fname like '%$searchit%' OR tbl_users.phone like '%$searchit%' OR tbl_users.email like '%$searchit%' OR tbl_users.userid like '%$searchit%'    order by rand()  limit 16 ");      
      while($row=mysqli_fetch_array($query))
  {

      ?>

                    <div style="padding-bottom: 20px">
                                                  <?php 
$membership=$_COOKIE['membership'];
$cat=$row['vcat']; 

if($membership=='basic' and $cat!='basic'){?> <a href="" onclick="alert('You must upgrade to premium to watch this video')" class="video-post">   <?php }else{?> 
         <a href="<?php echo PATH_VIP; ?>?p=more&vid=<?php echo $row['video_id']; ?>&aid=<?php echo $row['actor_id']; ?>" class="video-post"> <?php } ?>
                              <div class="video-post-thumbnail">
                             <span class="play-btn-trigger"></span>

 <img src="<?php echo SITE_URL; ?>/uploads/vipvideoimages/<?php echo $row["coverimage"]; ?>" alt='<?php echo $row['vid_title']; ?>'>   </div>
</a>
                        <div class="uk-grid-small" uk-grid>
                        
                            <div class="uk-width-expand"  style="padding: 5px">
                               <h4 class="mb-2 uk-text-truncate"><?php echo $row["vid_title"]; ?></h4>
                                <p class="uk-text-small">
                                   <?php  if($cat=='basic'){?> <span class="video-post-time"> N<?php echo $row['video_amount']; ?><?php ///echo strtoupper($cat); ?></span>  <?php }else{ ?> 
                                        <span class="video-post-time" style="background-color: red">N<?php echo $row['video_amount']; ?> <?php ///echo strtoupper($cat); ?></span> <?php } ?>
                                   <!-- <span> 15 Video per week</span>-->
                                   <?php echo $row["username"]; ?>
                                </p>
                            </div>
                           
                        </div>

                    </div>

                    <?php 

                }


}else{ echo "<h3>Empty Search</h3>";}
                ?>
                   

                    </div>
 <br><br>
  
                

                </div>



            