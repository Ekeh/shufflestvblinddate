
<div id="content-wrapper">
<div class="container-fluid">
<div class="video-block section-padding">
		  <?php

include('inc/mobile-search.php'); 
?>
<div class="row">
<div class="col-md-12">
<div class="main-title">

<h6> All Contests</h6>

<form method="post"   class="searchbox-live-results-form" action="" style="padding-bottom: 10px;">
<div class="">
<select name="cid" class="form-control selectit" style="position: relative;float: left; width: 200px" onchange="this.form.submit()" required>
	<!--- include the various contests -->
<option value="">--Search by Contests--</option>
<?php
	$q=mysqli_query($db,"SELECT * FROM tbl_contests order by contest_id desc"); 
while($r=mysqli_fetch_array($q))
{
$contest_title=$r['contest_title'];
$contest_id=$r['contest_id'];


?>

<option value="<?php echo $contest_id; ?>"><?php echo $contest_title; ?></option>
<?php } ?>

</select>
<!--
<button type="submit" class="btn btn-danger" name="filter"  style="border-radius: 0px 5px 5px 0px;font-size: 13px"> GO </button>
-->
</div>
</div>
</form>



<br clear="all">
<div style="clear: all;"></div>
<br><Br>
<?php if($message!=''){echo $message;} ?>
</div>


<?php

			
			
if(isset($_GET['cid']) ){
	$cid=$_GET['cid'];
$sql=mysqli_query($db,"SELECT * FROM tbl_contests where  contest_id='$cid' order by contest_id desc"); 
}elseif(isset($_POST['cid']) ){
	$cid=$_POST['cid'];
$sql=mysqli_query($db,"SELECT * FROM tbl_contests where  contest_id='$cid' order by contest_id desc"); 
}else{
	$cid='';
$sql=mysqli_query($db,"SELECT * FROM tbl_contests   order by contest_id desc"); 
}


$num=mysqli_num_rows($sql);
if($num=='0'){
echo "<div class='alert-danger alert'> We could not find this contest</div>";
}else{

while($row=mysqli_fetch_array($sql))
{
$contest_id=$row['contest_id'];
$contest_title=$row['contest_title'];
$contest_instruction=$row['contest_instruction'];
$coverimage=$row['coverimage'];
$audition_status=$row['audition_status'];
$views=$row['views'];
$status=$row['status'];
$audition_start=$row['audition_start'];

////// log view. if the person is not signed in log the IP address
///include('inc/logcontests.php');
?>


<div class="col-xl-3 col-sm-6 mb-3">
<div class="video-card history-video">
<div class="video-card-image">

<!--<a class="play-icon"  href="<?php echo SITE_URL; ?>/contests/<?php echo $contest_id; ?>" title="<?php echo $contest_title; ?>"><i class="fas fa-play-circle"></i></a>-->
<a  href="<?php echo SITE_URL; ?>/contests/<?php echo $contest_id; ?>" title="Learn more!"><img class="img-fluid" src="<?php echo SITE_URL; ?>/uploads/posts/contests/coverimage/<?php echo $coverimage; ?>" alt="" style='height: 250px; width: 250px; object-fit:cover'></a>
<!--<div class="time">3:50</div>-->
<div style="padding: 5px;" class="video-title">
<a href="<?php echo SITE_URL; ?>/contests/<?php echo $contest_id; ?>" title="<?php echo $contest_title; ?>"><?php echo $contest_title; ?></a>
</div>
</div>
<div class="video-view" style="padding: 10px"><a href='<?php echo SITE_URL; ?>/contests/<?php echo $contest_id; ?>'>Learn More</a>&nbsp; &nbsp;<a href='index.php?p=allcontestants&contest=<?php echo $contest_id; ?>' >  See Contestants</a>
</div>
<div align="center">
								<?php

$now=time()+3600;
$nows=date("M j, Y H:i:s", $audition_start);
///echo $nows;
if($audition_start>$now){
	?>
	<span class='  btn btn-warning btn-sm'>Starts Soon   <i class="fas fa-walking"></i> </span> <br><?php echo $nows; ?>
							 		<?php
}elseif($audition_status=='0'){
							?>
							 		<a href='<?php echo SITE_URL; ?>/contestsignup/<?php echo $contest_id; ?>' class='  btn btn-warning btn-sm'>Join Contest  <i class="fas fa-trophy"></i> </a><br>- 
							 		<?php
							 	}else{?>
<a href='<?php echo SITE_URL; ?>/results/<?php echo $contest_id; ?>' class=' btn btn-primary btn-sm'>View Result  <i class="fas  fa-chart-bar"></i> </a><br>-  
							 	<?php } ?>
							 	</div>
<!-- use this for progress bar
<i class="fas fa-users"></i>
<div class="progress">
<div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">1:40</div>
</div>
-->
<div class="video-card-body">

<div class="video-view"><?php
if($audition_start>$now){
echo "<span style='color:yellow'>NOT STARTED</span>";}
elseif($audition_status=='1'){ echo "<span style='color:red'>REGISTRATION CLOSED</span>";}else{echo "<span style='color:green'>ONGOING</span>";}
								?> &nbsp; &nbsp;
								<!--<i class="fas fa-eye"></i> 
<?php echo $views;  if($views>1){?>  views<?php }else{echo " view"; } ?>
-->
</div>
</div>
</div>
</div>

<?php
}
}
?>



</div>
<!--<nav aria-label="Page navigation example">
<ul class="pagination justify-content-center pagination-sm mb-0">
<li class="page-item disabled">
<a class="page-link" href="#" tabindex="-1">Previous</a>
</li>
<li class="page-item active"><a class="page-link" href="#">1</a></li>
<li class="page-item"><a class="page-link" href="#">2</a></li>
<li class="page-item"><a class="page-link" href="#">3</a></li>
<li class="page-item">
<a class="page-link" href="#">Next</a>
</li>
</ul>
</nav>-->
</div>
</div>
</div>
</div>