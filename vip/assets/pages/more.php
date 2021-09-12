   <!-- contents -->
       <style type="text/css">
           .overlay {
          width: 100%;
  position:absolute;
top: 60px;
  z-index: 4200px;
  color: #ffffff;
  font-weight: bold;

   -webkit-text-stroke: 0.5px #000000;
  padding: 10px;
  
}

.overlay2 {
 display: none;;
position:relative;
top:0px;
  left:70%;
  right: 10px;
  z-index: 1200;
  background-color: #000000;
  color: #ffffff;
  padding: 10px;
  
}

       </style>

     
 <div class="main_content content-expand">
            <div class="main_content_inner">
 <div uk-grid>
                    <div class="uk-width-2-3@m">

                        <div id="video-box" uk-sticky="top: 400 ;media : @s"
                            cls-active="video-resized uk-animation-slide-right;">
                            <span class="icon-feather-x btn-box-close"
                                uk-toggle="target: #video-box ; cls: video-resized-hedden uk-animation-slide-left"></span>
                                <?php
$stop=0;
if(isset($_GET['vid'])){
$vid=$_GET['vid'];
$aid=$_GET['aid'];
}else{
?>
<script type="text/javascript">alert("Invalid Video ID");
   setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>';
         }, 500);
</script>
<?php
exit;
}



////get the cost of the video and if the user has the amount in wallet act

$qry=mysqli_query($db,"SELECT * FROM tbl_vip_videos where video_id='$vid' "); 
$rw = mysqli_fetch_array($qry,MYSQLI_ASSOC); 

 $video_amount=$rw['video_amount'];

 $qery=mysqli_query($db,"SELECT * FROM tbl_users where userid='$userid' "); 
$rew = mysqli_fetch_array($qery,MYSQLI_ASSOC); 

 $credit=$rew['credit'];

///check if the credit is greater than or equal to the cost of the video

 

 if($credit<$video_amount){
  ?>
<script type="text/javascript">alert("You have insufficient credit to watch this video. Kindly fund your wallet.");
   setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>/index.php?p=fundwallet';
         }, 500);
</script>
  <?php
  exit; //// stop all action
  ///prompt user and redirect to payment page
 }

//// check if the video is stored in myvideos else charge the person
$sqls=mysqli_query($db,"SELECT * from tbl_vip_watched  where video_id='$vid' and userid='$userid'"); 
$num=mysqli_num_rows($sqls);

//// allow the user to give permission to deduct from wallet
if(isset($_GET['donow'])){
$userid=$_COOKIE['userid'];
$sql=mysqli_query($db,"UPDATE tbl_vip_videos set views=views+1 where video_id='$vid' ");  



if($num=='0'){
if($credit>=$video_amount){
  ///deduct the cost of the video and give value to customer
   $qery=mysqli_query($db,"UPDATE tbl_users set  credit=credit-$video_amount where userid='$userid' "); 
   echo "<div class='uk-alert-success fade in' uk-alert>N ".$video_amount." has been removed from your wallet</div>";
 }else{
  ////be double sure the person has credit
  ?>
<script type="text/javascript">alert("You have insufficient credit to watch this video. Kindly fund your wallet.");
   setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>/index.php?p=fundwallet';
         }, 500);
</script>
  <?php
  exit; //// stop all action
  ///prompt user and redirect to payment page

 }
 //// put the video in the watched list
 $i=mysqli_query($db,"INSERT into tbl_vip_watched set video_id='$vid', actor_id='$aid',userid='$userid' "); 
}



} ///// request for permission ends here

///$query=mysqli_query($db,"SELECT * FROM tbl_vip_videos INNER JOIN tbl_users
    ///ON tbl_vip_videos.actor_id = tbl_users.userid  where video_id='$vid' "); 

$query=mysqli_query($db,"SELECT * FROM tbl_vip_videos where video_id='$vid' "); 

$row = mysqli_fetch_array($query,MYSQLI_ASSOC); 

 $vcat=$row['vcat'];
$membership=$_COOKIE['membership'];
 if($vcat!='basic' && $membership=='basic'){
  $stop=1;
 }

if($stop=='1'){

/*
?>

     <div class="embed-video">
                             <h3  style="color: #ffffff">You must upgrade to watch this video. Kindly upgrade now.<br> <a href='<?php echo SITE_VIP; ?>/?k=premium' class="button warning" ><i class="uil-wallet"></i> Click here</a></h3>

                               <div>
                                <a href="<?php echo PATH_VIP; ?>?p=more&vid=<?php echo $vid; ?>" class="video-post video-post-list">
                                    <!-- Blog Post Thumbnail -->
                                    <div class="video-post-large">
                                        <span class="video-post-count"><?php echo $vcat; ?></span>
                                       <!-- <span class="video-post-time">23:00</span>-->
                                        <span class="play-btn-trigger"></span>

                                         <img src="<?php echo SITE_URL; ?>/uploads/vipvideoimages/<?php echo $img; ?>" alt='<?php echo $tit; ?>'> 

                                    </div>
                                </a>

                            </div>
                            </div>
                                <div class="video-info-title">
                                <h1> <?php echo $tit; ?></h1>
                            </div>
                    

                       
                      

                            <hr class="mt-0 mb-2">
</div>


                        <?php
                      */
                        ///// do nothing

}


//// allow the user to give permission to deduct from wallet
if(isset($_GET['donow']) || $num!=0){

     
 
 $mainvid=$row['video'];
   ?> 
<div class="embed-video" align="center">
<!--
<div class="overlay" align="center" >
    <h2 style="color: #ffffff; text-transform: lowercase;s">This video is <br>being viewed by <br> <?php echo $_COOKIE['phone']; ?> </h2> </div>-->
  <video id="video1" uk-video="automute: false" allowfullscreen uk-responsive controls controlslist="nodownload" >
    <source src="<?php echo SITE_URL; ?>/uploads/vipvideos/<?php echo $mainvid; ?>" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>

  


</div> 
<div class="video-info mt-3">
<!-- video title -->
<div class="video-info-title">
<h1> <?php echo $row['vid_title']; ?></h1>
</div>
<div class="uk-flex uk-flex-between">
                                <div class="video-info-details">
                                  <span><?php echo $row['views']; ?> views </span>
                                </div>
                            </div>


                            <div class="uk-flex uk-flex-between uk-flex-middle" uk-grid>
                                <div class="user-details-card uk-width-expand">
                                    <a href="single-channal.html" class="uk-flex">
                                      <!--  <div class="user-details-card-avatar">
                                            <img src="assets/images/avatars/avatar-2.jpg" alt="">
                                        </div> -->
                                        <div class="user-details-card-name">
                                          <?php echo $row['username']; ?><span> <!--Published on <?php  $dat=explode(" ",$row['date']); 
                                          echo $dat[0];?>--></span>
                                        </div>
                                    </a>
                                </div></div><div class="uk-width-auto uk-flex">


                                   <!-- <div class="btn-subscribe">
                                        <a href="#" class="button danger"> <i class="icon-feather-plus"></i>
                                            subscribe </a>
                                        <span class="subs-amount">1200</span>
                                    </div>
                                -->

                                </div>
                            </div>
<?php
}else{
  ///// if permission has not been asked, do this

  echo  "<div class='uk-alert-success fade in' uk-alert>N ".$video_amount." will be deducted from your account <br><a href='".SITE_VIP."/index.php?p=more&vid=".$vid."&donow=1&aid=".$aid."' class='button warning'>OK</a></div>";
}
  ?>



                                

                            <hr class="mt-0 mb-2">


                           <!-- <h2> About</h2>
                            <p><?php echo $row['vid_desc']; ?></p>
-->


                            <div class="about-ch-sec mb-lg-6">
                                <div class="abt-rw">
                                <!--    <h4>Category :  <?php echo $row['vcat']; ?> </h4>
                                  --> 
                                </div>
                                <!--<div class="abt-rw">
                                    <h4>About : </h4>
                                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                        fugiat nulla pariatur </p>
                                </div>
                                <div class="abt-rw tgs">
                                    <h4>Tags : </h4>
                                    <ul>
                                        <li><a href="#" title="">#Education</a></li>
                                        <li><a href="#" title="">#Programming </a></li>
                                        <li><a href="#" title="">#Design</a></li>
                                        <li><a href="#" title="">#Courses</a></li>
                                    </ul>
                                </div>-->
                          
</div>


                        </div>
                        <?php


?>
                    





                    </div>
                    <div class="uk-width-expand@m">

                        <div class="uk-flex uk-flex-middle uk-flex-between px-1 pb-3">
                            <p class="mb-0 uk-h5"> Upnext </p>

                            <label class="btn-switch">
                                <input type="checkbox">
                                <span class="btn-switch-slider" uk-toggle="target: #wrapper; cls: menu-small"></span>
                            </label>

                        </div>

                       
                        <div class="video-list-small uk-child-width-1-1@m uk-child-width-1-2@s" uk-grid>

 <!--- Starts here -->
 <?php 

 
 $query=mysqli_query($db,"SELECT * FROM tbl_vip_videos INNER JOIN tbl_users
    ON tbl_vip_videos.actor_id = tbl_users.userid  where  tbl_vip_videos.video_id!='$vid' and tbl_vip_videos.xrating='0' order by video_id desc  limit 10 ");      
      while($row=mysqli_fetch_array($query))
  { ?>

                            <div>
                                                        <?php 
$membership=$_COOKIE['membership'];
$cat=$row['vcat']; 

if($membership=='basic' and $cat!='basic'){?> 
  <a href="" onclick="alert('You must upgrade to premium to watch this video')" class="video-post video-post-list">   <?php }else{?>   
    <a href="<?php echo PATH_VIP; ?>?p=more&vid=<?php echo $row['video_id']; ?>&aid=<?php echo $row['actor_id']; ?>" class="video-post video-post-list"> <?php } ?>
                                    <!-- Blog Post Thumbnail -->
                                    <div class="video-post-thumbnail">
                                        <?php  

                                        if($cat=='basic'){?> 
                                          <span class="video-post-time">N<?php echo $row['video_amount']; ?> <?php 
                                          ////echo strtoupper($cat); ?>
                                            
                                          </span>  <?php }else{ ?> 
                                        <span class="video-post-time" style="background-color: red">N<?php echo $row['video_amount']; ?> <?php ////echo strtoupper($cat); ?></span> <?php } ?>
                                       <!-- <span class="video-post-time">23:00</span>-->
                                        <span class="play-btn-trigger"></span>

                                         <img src="<?php echo SITE_URL; ?>/uploads/vipvideoimages/<?php echo $row["coverimage"]; ?>" alt='<?php echo $row['vid_title']; ?>'> 

                                    </div>

                                    <!-- Blog Post Content -->
                                    <div class="video-post-content">
                                        <h3><?php echo $row['vid_title']; ?></h3>
                                  <!--     <img src="<?php echo SITE_URL; ?>/uploads/vipimages/<?php echo $row["photo"]; ?>" alt='<?php echo $row['uname']; ?>'>-->
                                        <span class="video-post-user"><?php echo $row['username']; ?></span>
                                          <!--<span class="video-post-views"><?php echo $row['views']; ?> views</span>
                                      <span class="video-post-date"> 2 weeks ago </span>-->
                                        <!-- option menu -->
                                        <span class="btn-option">
                                            <i class="icon-feather-more-vertical"></i>
                                        </span>
                                       <!-- <div class="dropdown-option-nav"
                                            uk-dropdown="pos: bottom-right ;mode : hover ;animation: uk-animation-slide-bottom-small">
                                            <ul>
                                                <li> <span> <i class="uil-history"></i> Watch Later</span> </li>
                                                <li> <span> <i class="uil-bookmark"></i> Add Bookmark</span> </li>
                                                <li> <span> <i class="uil-share-alt"></i> Share Your Friends</span>
                                                </li>
                                            </ul>
                                        </div> -->
                                    </div>
                                </a>
                            </div>

                        <?php } ?>
<!-- Ends here --->

                        </div>


                    </div>


                </div>
