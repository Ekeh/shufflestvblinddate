
<div id="content-wrapper">
<div class="container-fluid">

<div class="video-block section-padding">
<div class="row">
<div class="col-md-12">
<?php
////include('inc/mobile-search.php'); 
?>
<div class="main-title">
<div class="" style="padding-bottom: 15px">

<h6 style="padding-bottom: 5px;">View Contestants</h6>
<form method="post"  class="searchbox-live-results-form" role="search" action="" style="padding-bottom: 10px;">
<div class="">
<input type="text" name="filterit" class="form-control selectit" style="position: relative;float: left; width: 80%" placeholder="Search for contestant - User ID, name etc  e.g 00112" required>


<button type="submit" class="btn btn-danger" name="filter"   style="border-radius: 0px 5px 5px 0px;font-size: 13px"> Search </button>
</div>
</div>
</form>
<form method="post"   class="searchbox-live-results-form" action="index.php?p=allcontestants" style="padding-bottom: 10px;">

<select name="mid" class="form-control selectit" style="position: relative;float: left; width: 200px" onchange="this.form.submit()" required>
  <!--- include the various contests -->
<option value="">--Search by Contests--</option>
<?php
  $q=mysqli_query($db,"SELECT * FROM tbl_contests order by contest_title asc"); 
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

</form>
</div>
</div>





<?php
if(isset($_GET['contest']) ){
  $mid=$_GET['contest'];
$query=mysqli_query($db,"SELECT * FROM tbl_contestants INNER JOIN tbl_users ON  tbl_contestants.contestant_id=tbl_users.userid   where   tbl_contestants.contest_id ='$mid' and contestant_status!='2' order by tbl_contestants.status asc,tbl_contestants.id desc "); 
 $c=mysqli_query($db,"SELECT * FROM tbl_contests  WHERE  contest_id='$mid'   "); 
while($qw=mysqli_fetch_array($c))
{
$contest_title=$qw['contest_title'];
}
echo "<div style='padding:10px'><h5> Showing : <span style='color:yellow'>".$contest_title." </span> </h5></div>";

}elseif(isset($_POST['filter'])){

$filterit=$_POST['filterit'];
$q=mysqli_query($db,"SELECT * FROM tbl_contestants INNER JOIN tbl_users ON  tbl_contestants.contestant_id=tbl_users.userid   where   (tbl_users.userid like '%$filterit%' OR tbl_users.fname like '%$filterit%' OR tbl_users.lname like '%$filterit%' OR tbl_users.username like '%$filterit%' OR tbl_users.phone like '%$filterit%' OR tbl_users.email like '%$filterit%') and contestant_status!='2' order by tbl_contestants.id desc "); 
 

}elseif(isset($_POST['mid']) ){
  $mid=$_POST['mid'];
$q=mysqli_query($db,"SELECT * FROM tbl_contestants INNER JOIN tbl_users ON  tbl_contestants.contestant_id=tbl_users.userid   where   tbl_contestants.contest_id ='$mid' and contestant_status!='2' order by tbl_contestants.id desc "); 
 
$c=mysqli_query($db,"SELECT * FROM tbl_contests  WHERE  contest_id='$mid'   "); 
while($qw=mysqli_fetch_array($c))
{
$contest_title=$qw['contest_title'];
}
echo "<div style='padding:10px'><h5> Showing : <span style='color:yellow'>".$contest_title." </span> </h5></div>";
}elseif(isset($_COOKIE['chkcontest']) ){
  $rid=$_COOKIE['chkcontest'];
$q=mysqli_query($db,"SELECT * FROM tbl_contestants INNER JOIN tbl_users ON  tbl_contestants.contestant_id=tbl_users.userid   where   tbl_contestants.contest_id ='$rid' and contestant_status!='2' order by tbl_contestants.id desc "); 
 
$c=mysqli_query($db,"SELECT * FROM tbl_contests  WHERE  contest_id='$rid'   "); 
while($qw=mysqli_fetch_array($c))
{
$contest_title=$qw['contest_title'];
}
echo "<div style='padding:10px'><h5> Showing Results for <span style='color:yellow'>".$contest_title." </span> </h5></div>";
}else{
$q=mysqli_query($db,"SELECT * FROM tbl_contestants INNER JOIN tbl_users ON  tbl_contestants.contestant_id=tbl_users.userid  WHERE  contestant_status!='2'   "); 
}
$total_records=mysqli_num_rows($q);
///pagination starts here
$total_records_per_page = 12;
include('inc/paginationtop.php');

////pagination stops here

?>
<div class="col-md-12">
<div style='padding: 10px; '>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>
</div>


<?php
if(isset($_GET['contest']) ){
  $mid=$_GET['contest'];
$query=mysqli_query($db,"SELECT * FROM tbl_contestants INNER JOIN tbl_users ON  tbl_contestants.contestant_id=tbl_users.userid   where   tbl_contestants.contest_id ='$mid' and contestant_status!='2' order by tbl_contestants.status asc,tbl_contestants.id desc LIMIT $offset, $total_records_per_page "); 
 

}elseif(isset($_POST['filter'])){

$filterit=$_POST['filterit'];
$query=mysqli_query($db,"SELECT * FROM tbl_contestants INNER JOIN tbl_users ON  tbl_contestants.contestant_id=tbl_users.userid   where tbl_contestants.status='0' and (tbl_users.userid like '%$filterit%' OR tbl_users.fname like '%$filterit%' OR tbl_users.lname like '%$filterit%' OR tbl_users.username like '%$filterit%' OR tbl_users.phone like '%$filterit%' OR tbl_users.email like '%$filterit%') and contestant_status!='2'order by tbl_contestants.status asc,tbl_contestants.id desc LIMIT $offset, $total_records_per_page"); 
 

}elseif(isset($_POST['mid']) ){
  $mid=$_POST['mid'];
$query=mysqli_query($db,"SELECT * FROM tbl_contestants INNER JOIN tbl_users ON  tbl_contestants.contestant_id=tbl_users.userid   where   tbl_contestants.contest_id ='$mid' and contestant_status!='2' order by tbl_contestants.status asc,tbl_contestants.id desc LIMIT $offset, $total_records_per_page "); 
 

}elseif(isset($_COOKIE['chkcontest']) ){
  $mid=$_COOKIE['chkcontest'];
$query=mysqli_query($db,"SELECT * FROM tbl_contestants INNER JOIN tbl_users ON  tbl_contestants.contestant_id=tbl_users.userid   where   tbl_contestants.contest_id ='$mid' and contestant_status!='2' order by tbl_contestants.status asc,tbl_contestants.id desc LIMIT $offset, $total_records_per_page "); 
 

}else{
$query=mysqli_query($db,"SELECT * FROM tbl_contestants INNER JOIN tbl_users ON  tbl_contestants.contestant_id=tbl_users.userid    WHERE  contestant_status!='2'
	order by tbl_contestants.status asc,tbl_contestants.id desc  LIMIT $offset, $total_records_per_page "); 

}

$total_records=mysqli_num_rows($query); ///// total_records is used in pagination
if($total_records=='0'){
echo "<div class='alert-danger alert'> We couldn't find any result</div>";
}else{



while($row=mysqli_fetch_array($query))
{
$fname=$row['fname'];
$lname=$row['lname'];
$username=$row['username'];
$contestant_id=$row['userid'];
$contest_id=$row['contest_id'];
$audition_votes=$row['audition_votes'];
$event_votes=$row['event_votes'];
$refid=$row['userid'];
$status=$row['status'];
$photo=$row['photo'];
$id=$row['id'];

$val=$audition_votes+$event_votes;

$sum=0;
$esum=0;
$result = mysqli_query($db,"SELECT * FROM tbl_contestants where contest_id='$contest_id' and status='0'"); 
while($rod=mysqli_fetch_array($result))
  { 
     ////totalvotes 
     $sum=$sum+$rod["audition_votes"];  
     $esum=$esum+$rod["event_votes"]; 
  }
$esum=$esum+$sum;


  if($esum=='0'){
$percentage=0;
}else{
$percentage=round(($val/$esum)*100,2);
}


if($status=='1'){
 $percentage='-'; 
}
$sql2 = mysqli_query($db,"SELECT * FROM tbl_contests where contest_id = '$contest_id'");
  while($r=mysqli_fetch_array($sql2))
{
$contest_title=$r['contest_title'];
$audition_vote_cost=$r['audition_vote_cost'];
$main_event_vote_cost=$r['main_event_vote_cost'];
$stop_contest=$r['stop_contest'];
}



if(isset($_COOKIE['chkcontest']) || isset($_POST['mid']) || isset($_POST['filter']) )
{
?>


<div class="col-xl-3 col-sm-6 mb-3">
<div class="video-card history-video">
<div class="video-card-image">
<!--<a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>-->
<a href="<?php echo SITE_URL; ?>/contestant/<?php echo $contest_id; ?>/<?php echo $refid; ?>">
<img class="img-fluid" src="uploads/profile/<?php echo $photo; ?>" alt="" style=' height: 200px; object-fit:cover; '>
<div class="time">Ref ID: <?php echo $refid; ?></div>
</a>
</div>

<?php
if(isset($_COOKIE['userid'])){
$uids=$_COOKIE['userid'];

}else{
  $uids='0';
}
if($stop_contest=='1' && $uids!='11047'){ ?>
 <span class="btn btn-info form-control" >Voting Ended</span>
 <?php  }else{ ?>
 <button class="btn btn-danger form-control" type="button"  onclick="myFunction('<?php echo SITE_URL; ?>/votepaymentpage.php?pid=<?php echo $id;?>')">Vote Now [   <?php if($audition_vote_cost=='0'){ echo "FREE";}else{echo "&#x20A6; ".$audition_vote_cost; } ?> ] <i class="fas fa-donate"></i>  </strong></button> 
 <?php 
}
?>



<div class="video-card-body">
<div class="video-title">
<a href="<?php echo SITE_URL; ?>/contestant/<?php echo $contest_id; ?>/<?php echo $contestant_id; ?>"><?php
if($username!=''){echo ucfirst($username);}elseif($fname!=''){echo ucfirst($fname." ".$lname); }else{ echo "User ".$refid;}
    ?></a>
</div>
<div class="video-page text-success">
<a href="<?php echo SITE_URL; ?>/contests/<?php echo $contest_id; ?>" target='_blank'><?php echo $contest_title; ?></a>
</div>
<div class="video-view">
<i class="fas fa-thumbs-up"></i> <?php echo $percentage; if($audition_votes>1){?> % votes<?php }else{echo " % vote"; }?>
</div>

<div  style="padding: 10px">
<?php if($status=='0'){echo "<span style='color:green'>Active</span>";}else{echo "<span style='color:red'>Disqualified</span>";} ?>
</div>
</div>
</div>
</div>

<?php 
} elseif($stop_contest=='0' )
{
?>


<div class="col-xl-3 col-sm-6 mb-3">
<div class="video-card history-video">
<div class="video-card-image">
<!--<a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>-->
<a href="<?php echo SITE_URL; ?>/contestant/<?php echo $contest_id; ?>/<?php echo $refid; ?>">
<img class="img-fluid" src="uploads/profile/<?php echo $photo; ?>" alt="" style=' height: 200px; object-fit:cover; '>
<div class="time">Ref ID: <?php echo $refid; ?></div>
</a>
</div>

<?php
if(isset($_COOKIE['userid'])){
$uids=$_COOKIE['userid'];

}else{
  $uids='0';
}
if($stop_contest=='1' && $uids!='11047'){ ?>
 <span class="btn btn-info form-control" >Voting Ended</span>
 <?php  }else{ ?>
 <button class="btn btn-danger form-control" type="button"  onclick="myFunction('<?php echo SITE_URL; ?>/votepaymentpage.php?pid=<?php echo $id;?>')">Vote Now [   <?php if($audition_vote_cost=='0'){ echo "FREE";}else{echo "&#x20A6; ".$audition_vote_cost; } ?> ] <i class="fas fa-donate"></i>  </strong></button> 
 <?php 
}
?>



<div class="video-card-body">
<div class="video-title">
<a href="<?php echo SITE_URL; ?>/contestant/<?php echo $contest_id; ?>/<?php echo $contestant_id; ?>"><?php
if($username!=''){echo ucfirst($username);}elseif($fname!=''){echo ucfirst($fname." ".$lname); }else{ echo "User ".$refid;}
		?></a>
</div>
<div class="video-page text-success">
<a href="<?php echo SITE_URL; ?>/contests/<?php echo $contest_id; ?>" target='_blank'><?php echo $contest_title; ?></a>
</div>
<div class="video-view">
<i class="fas fa-thumbs-up"></i> <?php echo $percentage; if($audition_votes>1){?> % votes<?php }else{echo " % vote"; }?>
</div>

<div  style="padding: 10px">
<?php if($status=='0'){echo "<span style='color:green'>Active</span>";}else{echo "<span style='color:red'>Disqualified</span>";} ?>
</div>
</div>
</div>
</div>

<?php 
} 

}



}

 ?>


 <script>
	 var newwindow;
function myFunction(url) {
   newwindow=window.open(url, "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=10,left=10,width=400,height=600").focus();

  if (window.focus) {newwindow.focus()}

}
</script>
<script type="text/javascript">
	var blurred = false;
window.onblur = function() { blurred = true; };
window.onfocus = function() { blurred && (location.reload()); };

</script>


</div>

<style type="text/css">
  .pagination li{
    padding: 10px;
  }
</style>
<div class="col-md-12" ><div style='padding: 10px; '>
 <?php
////include the page it is landing
$page_return='allcontestants';
include('inc/paginationbottom.php');
?></div>
</div>
<!--

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

-->
</div>
</div>