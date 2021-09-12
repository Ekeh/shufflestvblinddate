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

.play{

    position: relative;
      top: 80px;
      left: 120px;

}
</style>
<?php
$d='';
?>
<div class="main-panel" >
        <div class="">
          <div class="row ">
            <div class="col-lg-12"> 


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
                              <!-- <h5><marquee onmouseover='stop()'  onmouseout='start()'>Thanks for stopping by, all highlights will return soon. <a href='index.php?p=livestream'>View LiveStream</a></marquee></h5>-->
<?php           

$userid=$_COOKIE['userid'];

$video_id='';
if(isset($_GET['d'])){
$d=$_GET['d'];



$userid=$_COOKIE['userid'];


$query=mysqli_query($db,"SELECT * FROM tbl_r18highlights WHERE video_id='$d' and showit='1'");


while($r=mysqli_fetch_array($query))
  {

 $vid_title=$r['vid_title'];
 $video=$r['video'];
  $video_id=$r['video_id'];
   $video_url=$r['video_url'];
  $vid_amount=$r['vid_amount'];





  ///starts here 
$sql = mysqli_query($db,"SELECT * FROM tbl_r18log where userid='$userid' and postid='$d'");
$nums=mysqli_num_rows($sql);  //// check if the person has already paid for this 

$sql4 = mysqli_query($db,"SELECT * FROM tbl_users where userid='$userid'");
$rows = mysqli_fetch_array($sql4,MYSQLI_ASSOC); 
   $credit=$rows['credit'];

$nowtime=time();

if($nums=='0'){

      echo "<div class='alert  alert-danger' style='color:#ffffff;'>&#x20A6;   ".$vid_amount." will be deducted from your wallet </div>";
      if($credit>=$vid_amount){
      /// user has some money so request deduction
       ///do the deduction and record into tbl_r18log

$sql = mysqli_query($db,"INSERT into tbl_r18log set userid='$userid',postid='$d'");
$sql4 = mysqli_query($db,"UPDATE tbl_users set credit=credit-$vid_amount where userid='$userid'");
            if($sql4){
                echo "<div class='alert alert-block alert-success '  style='color:#ffffff;'>&#x20A6;  ".$vid_amount." has been deducted from your wallet </div>";
            }
      }else{
      ////user has no money do redirect to paystack
        echo "<div class='alert alert-danger '  style='color:#ffffff;'> Insufficient funds</div>";
        echo "<div ><a href='".SITE_URL."/index.php?p=makepayment'>Fund Wallet</a>, then refresh page</div>";
      }

    }

$sqlz = mysqli_query($db,"SELECT * FROM tbl_r18log where userid='$userid' and postid='$d'");
$ns=mysqli_num_rows($sqlz);

    if($ns!=0){


/////checks end here






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
  <video id="video1" width="480" height="320"   preload="auto" autoplay    playsinline allowfullscreen uk-responsive controls controlslist="nodownload" >i
    <source src="<?php echo SITE_URL; ?>/uploads/r18/<?php echo $video; ?>" type="video/mp4" >
    Your browser does not support HTML5 video.
  </video>
</div> 




    <?php

}

echo "</div>";

  }

}
}
                ?>
<br>
<h5>R18 Highlights</h5>
<?php           
   $cnt=1;

$q=mysqli_query($db,"SELECT * FROM tbl_r18highlights WHERE video_id!='$video_id' and  showit='1'  order by video_id desc");  
while($rq=mysqli_fetch_array($q))
  {

 $vid_title=$rq['vid_title'];
 $video_id=$rq['video_id']; 
 $coverimage=$rq['coverimage'];
 $vid_amount=$rq['vid_amount'];

 $sql = mysqli_query($db,"SELECT * FROM tbl_r18log where userid='$userid' and postid='$video_id'");
$nums=mysqli_num_rows($sql);  //// check if the person has already paid for this 

            ?>
            <div style="width: 300px; position: relative;float: left;right: 5px; padding: 10px;">
<a href='index.php?p=r18highlights&d=<?php echo $video_id; ?>'>

  <img src="images/play.png" class="play" width="30px" height="auto" />
  <img src="uploads/r18/images/<?php echo $coverimage; ?>" width='280px' height='220px' style='object-fit: cover' title='&#x20A6; <?php echo $vid_amount; ?> will be deducted from your wallet'>
</a><br>
   <div style="padding: 5px; border-bottom: dotted 1px #cccccc;" ><a href='index.php?p=r18highlights&d=<?php echo $video_id; ?>'>
       
       <?php echo substr($vid_title,0,30); if(strlen($vid_title)>30){ echo " ...";}  ?></a> 
    <?php
if($nums=='0'){
    ?><br>View costs &#x20A6; <?php echo $vid_amount; ?>

    <?php }else{echo "<br>Subscribed";} ?>
     </div>
</div>
    <?php
    $cnt++;
  }






                ?>

          


        
<div style="clear: all; margin-bottom: 40px"></div>
</div>
</div>
          </div>
        </div>
<br clear="all">
</div>
</div>