<?php

if(!isset($_COOKIE['userid'])){
?>
<script type="text/javascript">
alert("You Must Login to view this page");
 setTimeout(function(){
            window.location.href = 'https://shufflestv.com/index.php?p=login';
         }, 1000);
</script>
<?php
  exit;
} ?>
<style>
li {

 display: inline;
}

.scrolling img{
  border-radius:5px;
}

.scrolling{
    width:100%;
    overflow-x: scroll;
    overflow-y: hidden;
    white-space: nowrap;
}



</style>
<?php
$d='';
?>
<div class="main-panel" >
        <div class="">
          <div class="row ">
  
            <div class="col-lg-12"> 
            <h2>Roomies Highlights</h2>
<div class="row">
            <div class="col-lg-12">
     <div align="center" style="padding: 15px; padding-left: 20px"> <br clear="all">
   <?php if(!isset($_COOKIE['userid']))
     {
?><a href="<?php echo SITE_URL; ?>/register.php" class="btn btn-primary" style="background-color: red">Register / Login</a>
<?php }else{
  ?><a href="<?php echo SITE_URL; ?>/index.php?p=livestream" class="btn btn-primary" style="background-color: red">Watch LiveStream</a>
<?php
} ?>
</div>
<?php
$userid=$_COOKIE['userid'];
include('inc/subscriptionform_chk.php');

$sql = mysqli_query($db,"SELECT * FROM tbl_livestreaming where client_id='$userid'");
$nums=mysqli_num_rows($sql);
$row = mysqli_fetch_array($sql,MYSQLI_ASSOC); 
   $stop_time=$row['stop_time'];

$sql4 = mysqli_query($db,"SELECT * FROM tbl_users where userid='$userid'");
$rows = mysqli_fetch_array($sql4,MYSQLI_ASSOC); 
   $credit=$rows['credit'];

$nowtime=time();



?>



              <div class=" " >
                  
                <div class="card-body" >
       
                       <div id="video-gallery" align="left" >
                               <br>
                  
<?php           



if(isset($_GET['d'])){
$d=$_GET['d'];
$query=mysqli_query($db,"SELECT * FROM tbl_highlights WHERE video_id='$d' and showit='1'");
}else{
$query=mysqli_query($db,"SELECT * FROM tbl_highlights where showit='1' and video_class='roomies' order by video_id desc limit 1");
}

while($r=mysqli_fetch_array($query))
  {

 $vid_title=$r['vid_title'];
 $video=$r['video'];
  $video_id=$r['video_id'];
   $video_url=$r['video_url'];

           ?>
  <div class="" style="padding: 5px;" > 
   <div style=" text-align: left;"><?php echo $r['vid_title']; ?></div>

   <?php
   if($video_url!=''){ ?>
<div class="" align="">
<?php echo $video_url; ?>
</div>
<?php 
   }else{
 ?>
<div class="" align="">
  <video id="video1" width="480" height="320"   preload="auto" autoplay    playsinline allowfullscreen uk-responsive controls controlslist="nodownload" >
    <source src="<?php echo SITE_URL; ?>/uploads/highlights/<?php echo $video; ?>" type="video/mp4" >
    Your browser does not support HTML5 video.
  </video>
</div> 




    <?php

}

echo "</div>";

  }

                ?>
<br>
<h5>Previous Highlights</h5>
<?php           
   $cnt=1;

$q=mysqli_query($db,"SELECT * FROM tbl_highlights WHERE video_id!='$video_id' and  showit='1' and video_class='roomies'  order by video_id desc");  
while($rq=mysqli_fetch_array($q))
  {

 $vid_title=$rq['vid_title'];
 $video_id=$rq['video_id'];
            ?>

   <a href='index.php?p=roomies-highlight&d=<?php echo $video_id; ?>'><div style="padding: 5px; border-bottom: dotted 1px #cccccc;" ><?php echo $vid_title; ?></div></a>

    <?php
    $cnt++;
  }

echo "   <div style='padding: 5px;' ><h6 style='color:#ffffff'> R18 Highlights<a href='https://api.whatsapp.com/send/?phone=2348035729461&text=Hi%2C+I+would+love+to+make+an+enquiry+R18.&app_absent=0' target='_blank'> Click Here</a></h6>
</div>";





                ?>

          


        


</div>
          </div>
        </div>
<br clear="all">
</div>
</div>