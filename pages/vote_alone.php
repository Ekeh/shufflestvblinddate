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
  text-decoration:none;
}

.btn-success:focus, .btn-success.focus {
  box-shadow: 0 0 0 0.2rem rgba(38, 215, 149, 0.5);
}

.btn-success.disabled, .btn-success:disabled {
  color: #fff;
  background-color: #00d082;
  border-color: #00d082;
}

.btn-success:not(:disabled):not(.disabled):active, .btn-success:not(:disabled):not(.disabled).active,
.show > .btn-success.dropdown-toggle {
  color: #fff;
  background-color: #009d62;
  border-color: #00905a;
}

.btn-success:not(:disabled):not(.disabled):active:focus, .btn-success:not(:disabled):not(.disabled).active:focus,
.show > .btn-success.dropdown-toggle:focus {
  box-shadow: 0 0 0 0.2rem rgba(38, 215, 149, 0.5);
}

.btn-info {
  color: #fff;
  background-color: #1cbccd;
  border-color: #1cbccd;
  padding: 5px 10px 5px 10px;
  border-radius: 5px;
  text-decoration: none;
}

.btn-info:hover {
  color: #fff;
  background-color: #179dab;
  border-color: #1693a0;
  text-decoration:none;
}

.btn-info:focus, .btn-info.focus {
  box-shadow: 0 0 0 0.2rem rgba(62, 198, 213, 0.5);
}


</style><?php 
include('../inc/db.php'); 
 include("../inc/header.php"); 



$uid=$_COOKIE['userid'];
$pid=$_GET['postid'];
$likes=$_GET['likes'];
$votes=$_GET['votes'];
$buy=0;

if($_GET['vote']){
$mid=$_GET['mid'];
$votes=$_GET['votes'];


$query=mysqli_query($db,"SELECT * FROM tbl_users where userid='$uid'"); 
while($row=mysqli_fetch_array($query))
{
$chk=$row['credit'];
}

$withdraw=20;

if($chk<$withdraw){
    $redirect=SITE_URL.'/index.php?p=makepayment';
?>
<script>alert("You need to purchase credit to continue ")</script> 

<script type="text/javascript">window.open("<?php echo $redirect; ?>" ,"_top");</script>

<?php	
$buy=1;

}else{
$votes=$votes+1;
$vote_music = mysqli_query($db,"INSERT into tbl_votes set userid='$uid',constestantid='$pid'");
$updat_user = mysqli_query($db,"UPDATE tbl_selection set vote=vote+1 where selection_id='$pid'");
$updat_amount= mysqli_query($db,"UPDATE tbl_users set credit=credit-'$withdraw' where userid='$uid'");

?>
<script>alert("Voting Successful ")</script>
<?php	
}
}



if($_GET['like']){


$pid=$_GET['pid'];
$likes=$_GET['likes'];

$query=mysqli_query($db,"SELECT * FROM tbl_users where userid='$uid'"); 
while($row=mysqli_fetch_array($query))
  {
$astat=$row['activation_status'];
}

if($astat=='0'){
?> <script type="text/javascript">alert("Your profile must be activated before you can like a video. Click the 'Activate Now' button at the top of your page");</script><?php
}else{

$query=mysqli_query($db,"SELECT * FROM tbl_likes where userid='$uid' and postid='$pid' "); 
$nu=mysqli_num_rows($query);
if($nu=='0'){
$likes=$likes+1;
$vote_music = mysqli_query($db,"INSERT into tbl_likes set userid='$uid',postid='$pid'");
$updat_user = mysqli_query($db,"UPDATE tbl_requests set likes='$likes' where postid='$pid'");
}
?>
<!--<script>alert(" Successful ")</script>-->
<?php
}
	









}

?>



						<div class="share" align='center'>
 <?php ///echo $votes; ?> 
 <?php ////if($votes=='1'){ echo 'vote'; } else{ echo 'votes';}

if($buy=='1'){
  
 ?>
<a href="<?php echo SITE_URL; ?>/index.php?p=makepayment" target="_top"> &nbsp;&nbsp;
  <span class="btn btn-primary" name="buynow"><span class="fa fa-credit-card"></span>  Buy Credit</span></a>
<?php }else{ 
if($uid==''){?>
<a href="<?php echo SITE_URL; ?>/login.php" target='_top'> &nbsp;&nbsp;
  <span class="btn btn-success" name="voteuser"><span class="fa fa-check"></span>  Vote Now</span></a>

<?php
    
}else{
?>
<a href="<?php echo SITE_URL; ?>/pages/vote_alone.php?vote=1&votes=<?php echo $votes; ?>&likes=<?php echo $likes; ?>&postid=<?php echo $pid; ?>"> &nbsp;&nbsp;
  <span class="btn btn-success" name="voteuser"><span class="fa fa-check"></span>  Vote Now</span></a>&nbsp;

<?php 
}


}

 ?>


 </div>
