<style type="text/css">
  .btn-success {
  color: #fff;
  background-color: #00d082;
  border-color: #00d082;
  padding: 5px 10px 5px 10px;
  border-radius: 5px;
  text-decoration: none;
}

.btn-success:hover {
  color: #fff;
  background-color: #00aa6a;
  border-color: #009d62;
  text-decoration: none;
}

.btn-success:focus, .btn-success.focus {
  box-shadow: 0 0 0 0.2rem rgba(38, 215, 149, 0.5);
  text-decoration: none;
}

.btn-success.disabled, .btn-success:disabled {
  color: #fff;
  background-color: #00d082;
  border-color: #00d082;
  text-decoration: none;
}

.btn-success:not(:disabled):not(.disabled):active, .btn-success:not(:disabled):not(.disabled).active,
.show > .btn-success.dropdown-toggle {
  color: #fff;
  background-color: #009d62;
  border-color: #00905a;
  text-decoration: none;
}

.btn-success:not(:disabled):not(.disabled):active:focus, .btn-success:not(:disabled):not(.disabled).active:focus,
.show > .btn-success.dropdown-toggle:focus {
  box-shadow: 0 0 0 0.2rem rgba(38, 215, 149, 0.5);
  text-decoration: none;
  padding: 5px 12px;
}

.btn-info {
  color: #fff;
  background-color: #1cbccd;
  border-color: #1cbccd;
  padding: 5px 10px 5px 10px;
  border-radius: 5px;
  text-decoration: none;
  text-decoration: none;
}

.btn-info:hover {
  color: #fff;
  background-color: #179dab;
  border-color: #1693a0;
  text-decoration: none;
}

.btn-info:focus, .btn-info.focus {
  box-shadow: 0 0 0 0.2rem rgba(62, 198, 213, 0.5);
  text-decoration: none;
}


</style>
<style>
    .hidden-div {
        display:none
    }
    </style>

    <?php 
include('../inc/db.php'); 

if(!isset($_COOKIE['userid'])){
echo "<div style='color:#ffffff; font-weight:bold'>You Must Login to Vote - <a href='".SITE_URL."/login.php' target='_top'>Click Here </a></div>";
exit;
}
$uid=$_COOKIE['userid'];

$likes='';
$host='';
$aid='';
$video_amount='';

$pid=$_GET['pid'];
$aid=$_GET['aid'];
$xrating=$_GET['xrating'];
$watched=$_GET['watched'];
$phone_activate=$_GET['phone_activate'];
$buy=0;

if(isset($_GET['vote'])){
$video_amount=$_GET['video_amount'];
$pid=$_GET['pid'];
$aid=$_GET['aid'];
$votes=$_GET['votes'];

$video_amount=$votes*$video_amount;

$query=mysqli_query($db,"SELECT * FROM tbl_users where userid='$uid'"); 
while($row=mysqli_fetch_array($query))
{
$chk=$row['credit'];
}



if($chk<$video_amount){
?>
<script>alert("You need to purchase credit to continue ")</script> 
<script type="text/javascript">window.open("<?php echo SITE_URL; ?>/?p=makepayment" ,"_blank");</script>
<?php 
$buy=1;

}else{

/*echo "<span style='padding:5px;color:yellow'>Pid -".$pid."</span>";
echo "<span style='padding:5px;color:yellow'>Aid -".$aid."</span>";
echo "<span style='padding:5px;color:yellow'>Uid -".$uid."</span>";
*/

//// this is for categories that can only vote once
if($xrating=='5'){

  $sql2 = mysqli_query($db,"SELECT * FROM tbl_vip_watched where video_id='$pid' and actor_id='$aid' and userid='$uid'");
$nums2=mysqli_num_rows($sql2);


if($nums2=='0'){
 $i=mysqli_query($db,"INSERT into tbl_vip_watched set video_id='$pid', actor_id='$aid',userid='$uid' "); 
$updat_amount= mysqli_query($db,"UPDATE tbl_users set credit=credit - $video_amount where userid='$uid'");
  $sql=mysqli_query($db,"UPDATE tbl_vip_videos set views=views+1 where video_id='$pid' ");  
   $u=mysqli_query($db,"INSERT into tbl_vote_record set post_id='$pid', amount='$video_amount',vuser_id='$uid' "); 
}else{
  ///// do nothing. because the person can only vote once
}


}else{

 $i=mysqli_query($db,"INSERT into tbl_vip_watched set video_id='$pid', actor_id='$aid',userid='$uid' "); 
$updat_amount= mysqli_query($db,"UPDATE tbl_users set credit=credit - $video_amount where userid='$uid'");
  $sql=mysqli_query($db,"UPDATE tbl_vip_videos set views=views+$votes where video_id='$pid' ");
 $u=mysqli_query($db,"INSERT into tbl_vote_record set post_id='$pid', amount='$video_amount',vuser_id='$uid' "); 
}
////if($i){echo "<span style='padding:5px;color:yellow'>done</span>";}else{echo "<span style='padding:5px;color:yellow'>failed</span>";}
$watched=1;
?>
<script>alert(" Successful ")</script>
<?php 
}
}

?>



            <div class="share" align="left" style="padding:10px">

<?php
$query=mysqli_query($db,"SELECT * FROM tbl_vip_videos  where video_id='$pid' ");
$row = mysqli_fetch_array($query,MYSQLI_ASSOC); 
?>
 <span style="font-size:20px; color:#ffffff;font-weight:strong"><?php echo $row['views']; ?>  <?php   if($xrating=='5'  || $xrating=='6'|| $xrating=='7'){ ?>Votes <?php }else{?> Views <?php } ?>  </span>&nbsp;
 <?php
$video_amount=$_GET['video_amount'];
 $qery=mysqli_query($db,"SELECT * FROM tbl_users where userid='$uid' "); 
$rew = mysqli_fetch_array($qery,MYSQLI_ASSOC); 

 $credit=$rew['credit'];

///check if the credit is greater than or equal to the cost of the video

 

 if($credit<$video_amount){
if(!isset($_COOKIE['userid'])){
?><a href="<?php echo SITE_URL; ?>/form-register.php" target="_top"> &nbsp;&nbsp;
  <span class="btn btn-primary" name="buynow">  Register/Login</span></a>
<?php
}else{
 ?>


<a href="<?php echo SITE_URL; ?>/index.php?p=makepayment" target="_top"> &nbsp;&nbsp;
  <span class="btn btn-primary" name="buynow"><span class="fa fa-credit-card"></span>  Buy Credit</span></a>
<?php

}
 }else{ 




if($phone_activate=='1' || $xrating!='5'  || $xrating!='6'){
if($watched!='1'){
  ?>
<form method="GET" action="">
              <select name="votes" style="padding:10px; margin-bottom: 10px;" required>
              <option value=""><-- Choose Number of Votes --></option>

<option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option><option value="30">30</option><option value="35">35</option><option value="40">40</option>
            </select>
  <input type="hidden" name="pid" value="<?php echo $pid; ?>">
   <input type="hidden" name="aid" value="<?php echo $aid; ?>">
    <input type="hidden" name="video_amount" value="<?php echo $video_amount; ?>">
     <input type="hidden" name="xrating" value="<?php echo $xrating; ?>">
      <input type="hidden" name="watched" value="<?php echo $watched; ?>">
       <input type="hidden" name="phone_activate" value="<?php echo $phone_activate; ?>">
<button  name="vote"  class="btn btn-success"  id="show_button">Vote Now - &#8358;  <?php echo $video_amount; ?></button>
</form>
<!--<a href="<?php echo SITE_URL; ?>/assets/inc/vote.php?vote=1&pid=<?php echo $pid; ?>&aid=<?php echo $aid; ?>&video_amount=<?php echo $video_amount; ?>&xrating=<?php echo $xrating; ?>&watched=<?php echo $watched; ?>&phone_activate=<?php echo $phone_activate; ?>" class="btn btn-success" name="voteuser" >Vote Now - &#8358;  <?php echo $video_amount; ?></a>&nbsp;-->
<?php 

}

if($xrating=='5' && $watched=='1'){
  echo "<span style='padding:5px;color:yellow'>( Already Voted )</span>";
}

if($xrating!='5'  && $watched=='1'){
   ?>
<form method="GET" action="">
    <select name="votes" style="padding:10px; margin-bottom: 10px;" required>
              <option value=""><-- Choose Number of Votes --></option>

<option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option><option value="30">30</option><option value="35">35</option><option value="40">40</option>
            </select>
  <input type="hidden" name="pid" value="<?php echo $pid; ?>">
   <input type="hidden" name="aid" value="<?php echo $aid; ?>">
    <input type="hidden" name="video_amount" value="<?php echo $video_amount; ?>">
     <input type="hidden" name="xrating" value="<?php echo $xrating; ?>">
      <input type="hidden" name="watched" value="<?php echo $watched; ?>">
       <input type="hidden" name="phone_activate" value="<?php echo $phone_activate; ?>">


<button  name="vote"  class="btn btn-success"  id="show_button">Vote Now - &#8358;  <?php echo $video_amount; ?></button>
</form>
<!--<a href="<?php echo SITE_URL; ?>/assets/inc/vote.php?vote=1&pid=<?php echo $pid; ?>&aid=<?php echo $aid; ?>&video_amount=<?php echo $video_amount; ?>&xrating=<?php echo $xrating; ?>&watched=<?php echo $watched; ?>&phone_activate=<?php echo $phone_activate; ?>" class="btn btn-success" name="voteuser" >Vote Now - &#8358;  <?php echo $video_amount; ?></a>&nbsp;
-->
<?php 
}


}else{
  ?>
   <div style="padding-top:10px"><a href="<?php echo SITE_URL; ?>/index.php?p=phonechk" target='_top' style='text-decoration: none;'><span class="btn-upgrade" style='border-radius:10px; background: red; color: white; font-weight: bold; padding:10px;'> <i class="uil-play"></i> Activate Phone Number to Vote
 </span></a></div>
 <?php
}

/*
 echo "<span style='padding:5px;color:yellow'>Voting has Ended</span>";
*/
}


?>
</div>
<script type="text/javascript">
    var button = document.getElementById('show_button')
    button.addEventListener('click',hideshow,false);

    function hideshow() {
        document.getElementById('hidden-div').style.display = 'block'; 
        this.style.display = 'none'
    }   
</script>