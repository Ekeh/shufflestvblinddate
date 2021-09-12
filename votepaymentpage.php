<div align="center" style="padding: 10px;"><img src="img/logo.png" width="250px" height="auto"> <h4>Payment Page</h4>
<div align="left" style="padding: 20px">
<?php
include('inc/db.php');
include('inc/header.php');
$folds='';
$tips='';
$stop='0';
$guest='0';
$su='';
$fname='';
$txamount='';
$stop_unverified_voter=0;
$stop_guest=0;


if(!isset($_COOKIE['userid'])){
$userid=$_SERVER['REMOTE_ADDR'];
}else{
$userid=$_COOKIE['userid'];	
}
///check if user already exists in guests
$sq = mysqli_query($db,"SELECT * FROM tbl_guests where ipaddress='$userid'");
$nt=mysqli_num_rows($sq);

if($nt!='0'){
	///means the person has already voted
	$stop_guest=1;
}

if($nt>'3'){
	///means the person has already voted
	$stop_unverified_voter=1;
}


if(!isset($_COOKIE['userid'])){
$userid=$_SERVER['REMOTE_ADDR'];
$guest='1';
//// please note that if a person is a guest you ask for the email address else get it from database, if the person doesn't have it ask for it in this form.
if($stop_guest=='1'){
///stop the voter and give a warning
	echo "<div class='alert-danger alert'>You have already voted as a quest, to keep voting... <br> <a href='register.php' onclick='javascript:self.close();' class='btn btn-primary' target='_blank'> Create Free Account </a> <br> </div>";
	exit;
}

}else{
	$userid=$_COOKIE['userid'];

	if($stop_unverified_voter=='1'){
///stop the voter and give a warning
	echo "<div class='alert-danger alert'>You must verify your email to keep voting... <br> <a href='memberarea.php?action=vemail' onclick='javascript:self.close();' class='btn btn-primary' target='_blank'> Verify Email </a> <br> </div>";
	exit;
}

$sql4 = mysqli_query($db,"SELECT * FROM tbl_users where userid='$userid'");
$rows = mysqli_fetch_array($sql4,MYSQLI_ASSOC); 

 $phone=$rows['phone'];
 $email=$rows['email'];
  $credit=$rows['credit'];

 if($email==''){
 	$detail=$phone;
 }else{
 	$detail=$email;
 }
}



if((!isset($_GET['pid']) || $_GET['pid']=='') && !isset($_POST['post_id'])){
?>
<div class='alert-danger alert'> Invalid request </div>

<script type="text/javascript">
		setTimeout(function(){
           javascript:self.close();
         }, 2000);
	</script>
<?php
exit;
}else{

	if(isset($_GET['pid'])){
	$post_id=$_GET['pid'];
}else{
	$post_id=$_POST['post_id'];
}

////// details of who they are paying for

$t=mysqli_query($db,"SELECT * FROM tbl_contestants INNER JOIN tbl_users  ON  tbl_contestants.contestant_id=tbl_users.userid  where  tbl_contestants.id='$post_id'"); 
$num=mysqli_num_rows($t);

if($num=='0'){
?>
<div class='alert-danger alert'> Contestant Not Found</div>

<script type="text/javascript">
		setTimeout(function(){
           javascript:self.close();
         }, 2000);
	</script>

<?php
exit;
}else{
///// if the post ID exists come here
while($rt=mysqli_fetch_array($t))
{
$username=$rt['username'];
$photo=$rt['photo'];
$contest_id=$rt['contest_id'];
$refid=$rt['userid'];

$r=mysqli_query($db,"SELECT * FROM tbl_contests  where  contest_id='$contest_id'");
while($rts=mysqli_fetch_array($r))
{
$contest_title=$rts['contest_title'];
$coverimage=$rts['coverimage'];
$audition_status=$rts['audition_status'];  //// when audition_status-0 it means the audition is still on, when it is 1, it means the main event has started
$stop_contest=$rts['stop_contest']; //// if this is 1 it means the contest has ended and payment should not be allowed
}


if(isset($_COOKIE['userid'])){
$uids=$_COOKIE['userid'];
}else{
	$uids='';
}

if($stop_contest=='1' && $uids!='11047'){ 
	echo "<h5>Voting has Ended </h5>";
 
 	 ?>
 
<script type="text/javascript">
		setTimeout(function(){
           javascript:self.close();
         }, 2000);
	</script>

 <?php

	exit;

}
?>

<div class="col-xl-3 col-sm-6 mb-3"><h6>You're voting...</h6>
<div class="video-card history-video">
<div class="video-card-image">
<img class="img-fluid" src="uploads/profile/<?php echo $photo; ?>" alt="" style=' height: 150px; object-fit:cover; '>
<div class="time">Ref ID: <?php echo $refid; ?></div>
</a>
</div>
<h6 style="padding: 10px; text-align: center;"><?php echo $username; ?></h6>
<p style="color: #ffcc00; text-align: center;padding: 5px; padding-top: 0"><?php echo $contest_title; ?></p>
</div>
</div>
<?php

}
/// the while loop ends here
}





if(isset($_POST['makepayment'])){
	$folds=mysqli_real_escape_string($db,$_POST['folds']);
	$tips=mysqli_real_escape_string($db,$_POST['tips']);
	$post_id=mysqli_real_escape_string($db,$_POST['post_id']);
	$detail=mysqli_real_escape_string($db,$_POST['detail']);

if($folds<1){
echo "<div class='alert-danger alert'> Units must be at least 1 </div>";
}else{

$total=$folds*$tips;

echo "<div class='alert-success alert'>Make Payment of N ".$total." </div>";
$time=time();
$md5code=md5($time);
$cartid=substr($md5code,0,8);

if(isset($_COOKIE['userid'])){ $userid=$_COOKIE['userid'];
$d= mysqli_query($db,"SELECT * FROM  tbl_users WHERE userid='$userid'"); 
while($r=mysqli_fetch_array($d))
{
$credit=$r['credit'];
}
}else{
	$userid='';
	$credit=0;
}
  

///// check if user has money in wallet, hence go to paystack
if($credit>=$total && $userid!=''){
//// user has sufficient money in wallet. Give value here
	 ////check if the transaction already exists
$chk= mysqli_query($db,"SELECT *  from tbl_contest_credit_record where txref='$cartid'");
$n=mysqli_num_rows($chk);
if($n!='0'){
echo "<div class='alert-danger alert'> Transaction already exists.</div>"; 
///// since the transaction exits redirect the person to the home page
?>
<!--<a onclick="javascript:self.close();">Close Page</a> -->
<?php
//// transaction does not exist
                           }else{ 



  ///deduct from users wallet
 $de= mysqli_query($db,"UPDATE  tbl_users set credit=credit - '$total'  WHERE userid='$userid'");  
 ////store a record of the voting                         
 $sd = mysqli_query($db,"INSERT into  tbl_contest_credit_record set  userid='$userid', product='$post_id', txref='$cartid',amount='$total',trans_email='$detail',authorized_by='wallet'");
 //// this will add the votes to the contestants

/// check if audition has ended

 $r=mysqli_query($db,"SELECT * FROM tbl_contestants  where  id='$post_id'");
while($rts=mysqli_fetch_array($r))
{
$contest_id=$rts['contest_id'];  //// get the ID for the contest
}

$rv=mysqli_query($db,"SELECT * FROM tbl_contests  where  contest_id='$contest_id'");
while($rtv=mysqli_fetch_array($rv))
{

$audition_status=$rtv['audition_status'];  //// when audition_status-0 it means the audition is still on, when it is 1, it means the main event has started
}

 if($audition_status=='0'){
/// this means audition is still on
$su = mysqli_query($db,"UPDATE  tbl_contestants set  audition_votes=audition_votes + '$folds' where id='$post_id'");
 }else{
 $su = mysqli_query($db,"UPDATE  tbl_contestants set  event_votes=event_votes + '$folds' where id='$post_id'");
 }

/// ends here 

 ////send a notification to the contestant about the vote received
////get info of the person making payment
  $d= mysqli_query($db,"SELECT * FROM  tbl_users WHERE userid='$userid'"); 
while($r=mysqli_fetch_array($d))
{
$userid=$r['userid'];
$username=$r['username'];
$fname=$r['fname'];
$email_activation_status=$r['email_activation_status'];
}

if($email_activation_status=='0'){
	////insert into the guests table
///since user is not registered insert in the guests table
$sut = mysqli_query($db,"INSERT into  tbl_guests set  ipaddress='$userid'");

}else{
	///since user is activated delete record from the guests table
$sut = mysqli_query($db,"DELETE from tbl_guests WHERE   ipaddress='$userid'");
	///delete all records
}
if($fname!=''){$voter=$fname;}elseif($username!=''){$voter=$username;}else{$voter=$userid;}

$txamount=$total;
 ///// get info of the contestant
$t=mysqli_query($db,"SELECT * FROM tbl_contestants INNER JOIN tbl_users  ON  tbl_contestants.contestant_id=tbl_users.userid  where  tbl_contestants.id='$post_id'"); 
while($rt=mysqli_fetch_array($t))
{
$email=$rt['email'];
$username=$rt['username'];
$contest_id=$rt['contest_id'];
$contestant_id=$rt['contestant_id'];
}
if($email!=''){
	////user has an email so send notification
////remember to uncomment this
	include('inc/vote_email.php');
}

///ends here
////// sending to the owner of the contest
$tr=mysqli_query($db,"SELECT * FROM tbl_contests WHERE contest_id='$contest_id'"); 
while($rts=mysqli_fetch_array($tr))
{
$contest_title=$rts['contest_title'];
$contest_owner=$rts['contest_owner'];

}

if($contest_owner!='11047' && $contest_owner!=''){
///// no need sending to me

	  /// Get contest owner email
$c=mysqli_query($db,"SELECT * FROM tbl_users WHERE userid='$contest_owner'"); 
while($d=mysqli_fetch_array($c))
{
$owneremail=$d['email'];

}
//


include('inc/contestowner_email.php');

}

//////sending to owner ends here 

 }
  

}else{




 ///// attach the post ID to the cartid so you can explode when verifying the payment 
include('paystack.php');

}

 if($su){
 	 echo "<div class='alert-success alert'> Your vote has been received.</div>"; 
 	 ?>
 	 <!--
<script type="text/javascript">
		setTimeout(function(){
           javascript:self.close();
         }, 200);
	</script>
-->
 <?php }
 /////
$stop=1;
}

}




if($stop!='1'){




$sql4 = mysqli_query($db,"SELECT * FROM tbl_contestants INNER JOIN tbl_contests ON tbl_contestants.contest_id=tbl_contests.contest_id where id='$post_id' ");
$n=mysqli_num_rows($sql4);
if($n=='0'){
	///// meaning there is no such post
	?>
<div class='alert-danger alert'>Invalid Content ID </div>
<!--
<script type="text/javascript">
		setTimeout(function(){
           javascript:self.close();
         }, 2000);
	</script>
-->
	<?php
}else{
$rows = mysqli_fetch_array($sql4,MYSQLI_ASSOC); 

 $post_amount=$rows['audition_vote_cost'];

 if(!isset($_COOKIE['userid'])){
 	//// because the person is not logged in make the person a guest
 	$guest='1'; //// user is now a guest
	?>
<div class='alert-danger alert'>You are making payment as a guest</div>
<?php
 }



 	if($post_amount=='0'){
 		///// check if the person has already offered a zero tip if not, acknowledge the tip and close the page
 $sl = mysqli_query($db,"SELECT * FROM tbl_contest_credit_record where userid='$userid' and  txref='$post_id' ");
$nl=mysqli_num_rows($sl);
if($nl!='0')
{
	////error message because has done this before
	?>
<div class='alert-danger alert'>You have already voted  &#8358; 0 . <br>Pay &#8358; 50 each for more votes? </div>
<form method="post" action="" name="loginform" >
	<div class="col-lg-12 mt-5">
		<?php
		if($guest=='0'){
			////meaning user is logged in, so don't show this 
			?>
<input type="hidden" name="detail"  value="<?php echo $detail; ?>" class='form-control'  required>
			<?php
		}else{
		//// meaning user is not logged in?>
<input type="email" name="detail" value="" placeholder="input email address" class='form-control' required>
		<?php } ?><br>
<input type="hidden" name="tips" min="50" value="50" placeholder="input amount e.g 100" class='form-control' required>
<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
<input type="number" name="folds" min="1" placeholder="input number of units e.g 5" value="<?php echo $folds; ?>" class='form-control' style='background-color: #ffffff; color: #000000' required>

<input type="submit" name="makepayment" value="Make Payment" class="btn btn-warning btn-block btn-lg">
</div>
</form>
	<?php
	
}else{
	///// give value here because the value is zero
	 $sd = mysqli_query($db,"INSERT into  tbl_contest_credit_record set  userid='$userid', txref='$post_id',amount='0'");


/// check if audition has ended

 $r=mysqli_query($db,"SELECT * FROM tbl_contestants  where  id='$post_id'");
while($rts=mysqli_fetch_array($r))
{

$contest_id=$rts['contest_id'];  //// get the ID for the contest
}

$r=mysqli_query($db,"SELECT * FROM tbl_contests  where  contest_id='$contest_id'");
while($rts=mysqli_fetch_array($r))
{

$audition_status=$rts['audition_status'];  //// when audition_status-0 it means the audition is still on, when it is 1, it means the main event has started
}

$folds=1;   ///// because only one vote is allowed for free votes
$total=0; /// because it is free 

///since user is not registered insert in the guests table
$sut = mysqli_query($db,"INSERT into  tbl_guests set  ipaddress='$userid'");

 if($audition_status=='0'){
/// this means audition is still on
$su = mysqli_query($db,"UPDATE  tbl_contestants set  audition_votes=audition_votes + '$folds' where id='$post_id'");
 }else{
 $su = mysqli_query($db,"UPDATE  tbl_contestants set  event_votes=event_votes + '$folds' where id='$post_id'");
 }

/// ends here 



 ///send a notification to the contestant about the vote received
////get info of the person making payment
  $d= mysqli_query($db,"SELECT * FROM  tbl_users WHERE userid='$userid'"); 
while($r=mysqli_fetch_array($d))
{
$userid=$r['userid'];
$username=$r['username'];
$fname=$r['fname'];
}

if($fname!=''){$voter=$fname;}elseif($username!=''){$voter=$username;}else{$voter=$userid;}


 ///// get info of the contestant
$t=mysqli_query($db,"SELECT * FROM tbl_contestants INNER JOIN tbl_users  ON  tbl_contestants.contestant_id=tbl_users.userid  where  tbl_contestants.id='$post_id'"); 
while($rt=mysqli_fetch_array($t))
{
$email=$rt['email'];
$username=$rt['username'];
$contest_id=$rt['contest_id'];
$contestant_id=$rt['contestant_id'];
}
if($email!=''){
	////user has an email so send notofication
///remember to uncomment this 
	include('inc/vote_email.php');
}

///ends here

		?>
<div class='alert-success alert'>Thanks! Your vote has been received. </div>

<script type="text/javascript">
		setTimeout(function(){
       javascript:self.close();
         }, 2000);
	</script>

<?php
}


 	}else{
?>

<form method="post" action="" name="loginform" >
	<div class="col-lg-12 mt-5" style="color: #ffffff"><b>Each vote is &#8358; <?php echo $post_amount; ?></b>
			<?php
		if($guest=='0'){
			////meaning user is logged in
			?>
<input type="hidden" name="detail"  value="<?php echo $detail; ?>"  required>
			<?php
		}else{
		//// meaning user is not logged in?>
<input type="email" name="detail" value="" placeholder="input email address" class='form-control' required>
		<?php } ?><br>
<input type="hidden" name="tips" value="<?php echo $post_amount; ?>">
<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
<input type="number" name="folds" min="1" placeholder="input number of units e.g 5" value="<?php echo $folds; ?>" style='background-color: #ffffff; color: #000000' class='form-control' required>

<input type="submit" name="makepayment" value="Make Payment" class="btn btn-warning btn-block btn-lg">
</div>
</form>


<?php

}
}
}



}

 ?>
</div>
<br>

<a href="javascript:self.close();" title=""> Close </a>

</div>
