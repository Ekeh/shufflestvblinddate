 <div class="main_content">

            <div class="main_content_inner">


                <!-- Slideshow -->
       <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1"
                    uk-slideshow="animation: push ;min-height: 200; max-height: 350 ;autoplay: t rue">

                    <ul class="uk-slideshow-items rounded">
                        <li>
                            <div class="uk-position-cover" uk-slideshow-parallax="scale: 1.2,1.2,1">
                                <img src="assets/images/banner/img3.jpg" alt="" uk-cover>
                            </div>
                            <div class="uk-position-cover"
                                uk-slideshow-parallax="opacity: 0,0,0.2; backgroundColor: #000,#000"></div>
                            <div class="uk-position-bottom-left bg-gradient-4 uk-width-1-1 p-4">
                                <div uk-slideshow-parallax="scale: 1,1,0.8">
                                    <h2 uk-slideshow-parallax="x: 200,0,0" > 
                                  <!--<br> <a href="<?php echo SITE_VIP; ?>/index.php?p=live" >   <span class="video-post-time" style="background-color: red;border-radius:10px;padding: 10px 20px 10px 20px; font-size: 18px"><i class="uil-play"></i> Watch Live  Videos</span></a>-->
                                    </h2>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-position-cover" uk-slideshow-parallax="scale: 1.2,1.2,1">
                                <img src="assets/images/banner/img2.jpg" alt="" uk-cover>
                            </div>
                            <div class="uk-position-cover"
                                uk-slideshow-parallax="opacity: 0,0,0.2; backgroundColor: #000,#000"></div>
                            <div class="uk-position-bottom uk-position-medium uk-transition-scale-down">
                                   <h2 uk-slideshow-parallax="x: 200,0,0" > 
                                <!--  <br> <a href="<?php echo SITE_VIP; ?>/index.php?p=live" >   <span class="video-post-time" style="background-color: red;border-radius:10px;padding: 10px 20px 10px 20px; font-size: 18px"><i class="uil-play"></i> Watch Live  Videos</span></a>-->
                                    </h2>
                            </div>
                        </li>
                    </ul>

                    <a class="uk-position-center-left-out uk-position-small uk-hidden-hover slidenav-prev" href="#"
                        uk-slideshow-item="previous"></a>
                    <a class="uk-position-center-right-out uk-position-small uk-hidden-hover slidenav-next" href="#"
                        uk-slideshow-item="next"></a>



                </div>



                <!-- Videos sliders 1 -->

                <div class="video-grid-slider mt-4" uk-slider="finite: true">

                    <div class="grid-slider-header">
                        <div>
                            <h3> Featured Videos </h3>
                          
                        </div>
                        <div class="grid-slider-header-link">

                            <div class="btn-arrow-slider">
                                <a href="#" class="btn-arrow-slides" uk-slider-item="previous">
                                    <span class="arrow-left"></span>
                                </a>
                                <a href="#" class="btn-arrow-slides" uk-slider-item="next">
                                    <span class="arrow-right"></span>
                                </a>
                            </div>

                        </div>
                    </div>

                    <ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-3@s uk-grid">
<?php
    
$query=mysqli_query($db,"SELECT * FROM tbl_vip_videos  INNER JOIN tbl_users ON tbl_vip_videos.actor_id=tbl_users.userid where tbl_vip_videos.xrating='0' order by rand()  limit 3 ");      
      while($row=mysqli_fetch_array($query))
  {

      ?>

<!--- starts here -->
                        <li>
                            <?php 
$membership=$_COOKIE['membership'];
$cat=$row['vcat']; 
?>
 <a href="<?php echo PATH_VIP; ?>?p=more&vid=<?php echo $row['video_id']; ?>&aid=<?php echo $row['actor_id']; ?>" class="video-post"> 
                                <!-- Blog Post Thumbnail -->
                                           <div class="video-post-thumbnail">
                                    <!--<span class="video-post-count"><?php echo $row['views']; ?></span>-->
                                    <?php  if($cat=='basic'){?> <span class="video-post-time">N<?php echo $row['video_amount']; ?> <?php ///echo strtoupper($cat); 
                                    ?></span>  <?php }else{ ?> 
                                        <span class="video-post-time" style="background-color: red"> N<?php echo $row['video_amount']; ?><?php ////echo strtoupper($cat); ?></span> <?php } ?>
                                    
                                    <span class="play-btn-trigger"></span>
                                    <!-- option menu -->
                                    <span class="btn-option">
                                        <i class="icon-feather-more-vertical"></i>
                                    </span>
                                 

                <img src="<?php echo SITE_URL; ?>/uploads/vipvideoimages/<?php echo $row["coverimage"]; ?>" alt='<?php echo $row['vid_title']; ?>'>

                                </div>
                            
                                <!-- Blog Post Content -->
                                <div class="video-post-content">
                                   <!-- <h3> <?php echo $row['vid_title']; ?></h3>-->
                                   <!--
                                     <img src="<?php echo SITE_URL; ?>/uploads/vipimages/<?php echo $row["photo"]; ?>" alt='<?php echo $row['username']; ?>'> -->

                            
                                    <span class="video-post-user"><?php echo $row['username']; ?></span>
                                   <span class="video-post-views"><?php echo $row["views"]; ?> views  </span>
                                   <!-- <span class="video-post-date"> 2 weeks ago </span>-->
                                </div>
                            </a>
                        </li>

                    <!-- Ends here -->
<?php } ?>
                    

                    </ul>
<!--<div align="left" style="padding:20px;" ><a href="<?php echo SITE_VIP; ?>?p=viewall" class='button' style="margin-left:50px">VIEW ALL</a></div>-->
                </div>


<div style="padding:10px; margin: 10px;">
 <a href="<?php echo SITE_VIP; ?>/index.php?p=live" class="btn-upgrade" style='border-radius:10px; background: red; color: white; font-weight: bold; padding:10px;'> <i class="uil-play"></i> Watch Live Videos - Click Here </a>

</div>
<div align="center">
               <div class="head_search" style="min-width: 70%; border-radius: 10px; background-color: #ffffff; padding: 5px; color: #000000;">
                <h4>Search for Video</h4>
                    <form method="post" action="<?php echo SITE_VIP; ?>/?p=search">
                        <div class="head_search_cont">
                            <input value="" type="text"  style="padding: 10px; width: 80%; border: none; margin-bottom: 10px;" 
                                placeholder="Search for Videos and more.." autocomplete="off" name="searchit"  required>
                           <input type="submit" name="search" value="Search">
                        </div>

                        


                    </form>
                </div>
            </div>
                </div>



            