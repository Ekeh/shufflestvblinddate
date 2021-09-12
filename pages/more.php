<div class="main-panel" >
        <div class="content-wrapper">
          <div class="row ">
            <div class="col-lg-12">
<h3> Watch and Vote </h3>
      <br clear="all">

<div class="row">
            <div class="col-lg-12">

              <div class="card " >
                <div class="card-body">
                
                      
                        <div align='left'>
                          <div class="">
                <form method="post" action="index.php?p=allvideos">
                  <table width="100%"><tr><td > <input type="text" class="form-control" placeholder="search for name, ref ID etc" aria-label="search" aria-describedby="search" name="table_search" required ></td><td><input type="submit" name="search" value="SEARCH" class="btn btn-success"></td></tr></table>
               
                 </form>
              </div>
                         
<?php
$stop=0;
$watch='';
$xrating='';
$num='';
$membership='';
$watched='1';
$phone_activate='0';
if(isset($_GET['vid'])){
$vid=$_GET['vid'];
$aid=$_GET['aid'];
}else{
?>
<script type="text/javascript">alert("Invalid Video ID");
   setTimeout(function(){
            window.location.href = '<?php echo SITE_URL; ?>';
         }, 500);
</script>
<?php
exit;
}
 


$query=mysqli_query($db,"SELECT * FROM tbl_vip_videos INNER JOIN tbl_users on tbl_vip_videos.video_id=tbl_users.userid where video_id='$vid' "); 

$r = mysqli_fetch_array($query,MYSQLI_ASSOC); 

 $vcat=$r['vcat'];
$xrating=$r['xrating'];
 $video_amount=$r['video_amount'];
 $mainvid=$r['video'];
 if(isset($_COOKIE['membership'])){
$membership=$_COOKIE['membership'];
}
 if($vcat!='basic' && $membership=='basic'){
  $stop=1;
 }

//// allow the user to give permission to deduct from wallet
if(isset($_GET['donow']) ||  $xrating=='7'){

    ?> 
<div class="" align="" style="margin-top: 50px; padding-top: 20px; ">
  <video id="video1" width="480" height="320"   preload="auto" autoplay    playsinline allowfullscreen uk-responsive controls controlslist="nodownload" >
    <source src="<?php echo SITE_URL; ?>/uploads/vipvideos/<?php echo $mainvid; ?>" type="video/mp4" >
    Your browser does not support HTML5 video.
  </video>
</div> 
<br clear="all">
<iframe src="<?php echo SITE_URL; ?>/pages/vote.php?pid=<?php echo $vid; ?>&aid=<?php echo $aid; ?>&video_amount=<?php echo $video_amount; ?>&xrating=<?php echo $xrating; ?>&watched=<?php echo $watched; ?>&phone_activate=<?php echo $phone_activate; ?>"   height="200px" style="width: 100%" scrolling="yes" frameborder='0'></iframe>

<p><h4> <?php echo $r['vid_title']; ?></h4>Ref ID - <?php echo $r['actor_id']; ?></p>


<?php } ?>
                         </div>


</div>





                </div>

              </div>


          </div>
        </div>
<br clear="all">
</div>
</div>
