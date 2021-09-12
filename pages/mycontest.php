
<div id="content-wrapper">
<div class="container-fluid pb-0">
<div class="video-block section-padding">
		  <?php

include('inc/mobile-search.php'); 
?>
<div class="row">
<div class="col-md-8">
<div class="single-video-left">
<div class="single-video">
<?php
if($message!=''){echo $message;}
?><!-- home banner starts here -->
		
		<?php			
			
if(isset($_GET['cid'])){
	$cid=$_GET['cid'];
}else{
	$cid='';
	$num='0';
}
$post_cat="contests";
$sql=mysqli_query($db,"SELECT * FROM tbl_contests where  contest_id='$cid' "); 
$num=mysqli_num_rows($sql);
if($num=='0'){
echo "<div class='alert-danger alert'> We can't find this post</div>";
}else{
?>
	<div id="wrapper" style="position:relative;z-index: 1;">
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5db54b841de87700125fca76&product=inline-share-buttons" async="async"></script>
<div class="sharethis-inline-share-buttons" data-url="<?php echo SITE_URL;?>/contests/<?php echo $cid; ?>" data-title="Hi, Check out this beautiful contest , Thank me later! "></div>
</div><br>

       <div class="slideshow-container" style="margin-top: 10px; " >
       	<?php
while($row=mysqli_fetch_array($sql))
{
$contest_id=$row['contest_id'];
$mycontest_title=$row['contest_title'];
$mycontest_instruction=$row['contest_instruction'];
$coverimage=$row['coverimage'];
$views=$row['views'];
$status=$row['status'];

$audition_status=$row['audition_status'];
$audition_start=$row['audition_start'];
$audition_stop=$row['audition_stop'];
$event_start=$row['event_start'];
$event_stop=$row['event_stop'];

$audition_start=$row['audition_start'];
////// log view. if the person is not signed in log the IP address
include('inc/logcontests.php');
	?>

	<img class="" src="<?php echo SITE_URL; ?>/uploads/posts/<?php echo $post_cat; ?>/coverimage/<?php echo $coverimage; ?>" style="width:100%; height:auto;">  
<?php                
}

}
?>


</div>

<div class="single-video-author box mb-3">
<div class="float-right">
<?php

$now=time();
if($audition_start>$now){
	?>
							 		<span class='  btn btn-warning btn-sm'>Starts - <?php echo date("jS M Y" , $audition_start); ?>   <i class="fas fa-walking"></i>  </span> 
							 		<?php
}elseif($audition_status=='0'){
							?>
							 		<a href='<?php echo SITE_URL; ?>/contestsignup/<?php echo $contest_id; ?>' class='  btn btn-warning btn-sm'>Join Contest  <i class="fas fa-trophy"></i> </a> 
							 		<?php
							 	}else{?>
<a href='<?php echo SITE_URL; ?>/results/<?php echo $contest_id; ?>' class=' btn btn-primary btn-sm'>View Result  <i class="fas  fa-chart-bar"></i> </a> 
							 	<?php }?>
							 <a href="index.php?p=allcontestants&contest=<?php echo $contest_id; ?>" class='  btn btn-primary btn-sm'>	View Contestants  <i class="fas fa-walking"></i>  </a>

							 	
</div>
<!--<img class="img-fluid" src="img/s4.png" alt="">-->
<p><h5><?php echo ucfirst($mycontest_title); 
							 ?></h5></p>
<!--<small>Published on Aug 10, 2020</small>-->
</div>

</div>
<div class="single-video-title box mb-3">

<!--<p class="mb-0"><i class="fas fa-eye"></i> 2,729,347 views</p>-->

<div>
  <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5db54b841de87700125fca76&product=inline-share-buttons" async="async"></script>
<div class="sharethis-inline-share-buttons" data-url="<?php echo SITE_URL;?>/contests/<?php echo $contest_id; ?>" data-title="Hi, Check out this beautiful content , Thank me later! "></div>
</div>
<!--
<iframe src="inc/flooraction.php?pid=<?php echo $post_id; ?>&post_cat=<?php echo $post_cat; ?>" style='width:100%; height: 8vh; ' frameborder="0"  ></iframe>

-->
</div>
<div class="single-video-info-content box mb-3">
<h6>Duration:</h6>
<p><span style="color:#ffcc00">Audition :</span> <?php echo date("jS M Y" , $audition_start); ?> - <?php echo date("jS M Y" , $audition_stop); ?>
<br><span style="color:#ffcc00">Main Event :</span> <?php echo date("jS M Y" , $event_start); ?> - <?php echo date("jS M Y " , $event_stop); ?></p>
<!--<h6>Category :</h6>
<p>Gaming , PS4 Exclusive , Gameplay , 1080p</p>
-->
<h6>Instruction :</h6>
<p><?php echo $mycontest_instruction; ?></p>
<!---<h6>Tags :</h6>
<p class="tags mb-0">
<span><a href="#">Uncharted 4</a></span>
<span><a href="#">Playstation 4</a></span>
<span><a href="#">Gameplay</a></span>
<span><a href="#">1080P</a></span>
<span><a href="#">ps4Share</a></span>
<span><a href="#">+ 6</a></span>
</p>-->
</div>
</div>
</div>
<?php include('inc/sidebar.php'); ?>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
