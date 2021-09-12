<?php

if(!isset($_COOKIE['userid'])){
?>
<script type="text/javascript">
alert("You Must Login to view this page");
 setTimeout(function(){
            window.location.href = 'https://shufflestv.com/register.php';
         }, 1000);
</script>
<?php
  exit;
}
$userid=$_COOKIE['userid'];
  ?><style>
li {

 display: inline;
}

.scrolling img{
  border-radius: 5px;
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
          <div class="row " style="padding: 20px;">
            <h3 style="color: yellow; padding: 10px">Blind Date </h3>

            <div class="col-lg-12">

            <div align="center"> <br clear="all">
<a href="<?php echo SITE_URL; ?>/index.php?p=dashboard" class="btn btn-primary" style="background-color: red">Home</a>
<a href="<?php echo SITE_URL; ?>/index.php?p=gallery" class="btn btn-primary" style="background-color: red">View Gallery</a>

</div>
 <h3>Profile Details</h3>



<div class="row">
            <div class="col-lg-12">
     
              <div class=" " >
                  
                <div class="card-body" >
      
                       <div id="video-gallery" align="left" >
                          
 <?php
if(isset($_COOKIE['userid']))
{
if(isset($_GET['u'])){ 
$uid=$db -> real_escape_string($_GET['u']);
}else{
echo "<div class='alert alert-danger'> Unknown User ID</div>";
?>
<script>
         setTimeout(function(){
            window.location.href = 'index.php?p=gallery';
         }, 1000);
      </script>
      <?php
      exit;

}


$userid=$_COOKIE['userid'];
$price_per_view=5;

if(isset($_POST['request_date']) || isset($_GET['chargeaccepted'])) {
if($userid == $uid) {
      ?>
    <script>
        alert('You can not send request to yourself.');
        setTimeout(function(){
            window.location.href = 'index.php?p=gallery';
        }, 1000);
    </script>
<?php
}
//TODO: Is the send on a date
$checkUserOnDate = mysqli_query($db,"SELECT  id FROM tbl_blind_date_request WHERE (user_id='$userid' OR to_user_id = '$userid') AND status='" . BLIND_DATE_STATUS_ACCEPTED . "'");
//TODO: Is the friend on a date with this user
$checkUserAndFriend = mysqli_query($db,"SELECT  id FROM tbl_blind_date_request WHERE ((user_id='$userid' AND to_user_id = '$uid') OR (user_id='$uid' AND to_user_id = '$userid')) AND (status='" . BLIND_DATE_STATUS_PENDING . "' OR status='" . BLIND_DATE_STATUS_ACCEPTED . "')");
$friendOnDate = mysqli_query($db,"SELECT  id FROM tbl_blind_date_request WHERE (user_id='$uid' OR to_user_id = '$uid') AND status='" . BLIND_DATE_STATUS_ACCEPTED . "'");

//TODO: Check how many pending requests this user has.
$checkPendingRequests = mysqli_query($db,"SELECT id FROM tbl_blind_date_request WHERE user_id='$userid' AND status='" . BLIND_DATE_STATUS_PENDING . "'");
//exit();
if(mysqli_num_rows($checkUserOnDate) > 0) {
?>
    <script>
        alert("You are already on a date.");
    </script>
<?php
}else if(mysqli_num_rows($checkUserAndFriend) > 0) {
?>
    <script>
        alert("You already have an active request with this user.");
    </script>
<?php
}else if(mysqli_num_rows($friendOnDate) > 0) {
?>
    <script>
        alert("This user is already on a date.");
    </script>
<?php
}else if(mysqli_num_rows($checkPendingRequests) >= FREE_REQUEST_QUOTA) {
if($_GET['chargeaccepted'] === '1') {
//TODO: charge users wallet
$checkCredit = mysqli_query($db,"SELECT credit FROM  tbl_users  WHERE userid='$userid'");
$credit = 0;
if($row = mysqli_fetch_assoc($checkCredit)) {
    $credit =  intval($row['credit']);
}
if($credit < AMOUNT_PER_REQUEST) {
?>
    <script>
        alert('Insufficient credit. Please, fund your wallet.');
    </script>
<?php
}else {
if(insert_date_request($db, $userid, $uid)) {
    var_dump(124);
$debit= mysqli_query($db,"UPDATE  tbl_users set credit=credit - '" . AMOUNT_PER_REQUEST . "'  WHERE userid='$userid'");
?>
    <script>
        alert('Request sent successfully.');
        setTimeout(function(){
            window.location.href = 'index.php?p=dgallery&u=<?=$uid?>';
        }, 1000);
    </script>
<?php
}else {
?>
    <script>
        alert('Error occurred while sending your request.');
    </script>
<?php
}
}
}else{
?>
    <script>
        if (confirm("You have exceeded your '<?=FREE_REQUEST_QUOTA?>' free request quota. Any other request will be charged '<?=AMOUNT_PER_REQUEST?>'.")) {
            window.location.href = 'index.php?p=dgallery&u=<?=$uid?>&chargeaccepted=1';
        }
    </script>
<?php
}
}else{
if(insert_date_request($db, $userid, $uid)) {
?>
    <script>
        alert('Request sent successfully.');
    </script>
<?php
}else {
?>
    <script>
        alert('Error occurred while sending your request.');
    </script>
<?php
}

}

}
//// get profile of those that are trending
$sq = mysqli_query($db,"SELECT * FROM tbl_users WHERE userid='$uid'");
$nu=mysqli_num_rows($sq);

if($nu=='0'){
  ?>
<div class='alert alert-danger'> Photo is not trending at the moment</div>
  <?php
}else{

while($rows=mysqli_fetch_array($sq))
{
 $photo=$rows['photo'];
 $name=$rows['username'];
 $description=$rows['description'];
 $uid=$rows['userid'];
$nam=substr($name,0,15);

//////deduct from wallet and store in trending 
///first check if this user has viewed the profile in the past.
$s = mysqli_query($db,"SELECT * FROM tbl_trend WHERE viewer_id='$userid' and owner_id='$uid'");
$n=mysqli_num_rows($s);

if($n=='0'){
//// means the viewer hasnt see the image before so charge for it
$q = mysqli_query($db,"INSERT into tbl_trend SET viewer_id='$userid', owner_id='$uid'");
$p = mysqli_query($db,"UPDATE tbl_users SET views=views + 1, credit=credit-'$price_per_view' WHERE userid='$uid'");
}



?>
    <div class="row">
        <div class="col-lg-5 col-md-6 offer-deal"  align="right">


  <img src="uploads/profile/<?php echo $photo; ?>" alt="" style='width: 350px; height:auto; object-fit:cover; border-radius:5px'>
  </div>
        <div class="col-lg-5 col-md-6" >
       

  <h5 class="" align=""><b>Name:</b></h5>
   <div><?php echo $name;?></div>
            <br />
  <h5 class="" align=""><b>Description:</b></h5>
  <div><?=!empty($description)?$description:'N/A';?></div>
  <br><br><br>
            <?php if($userid != $uid) {?>
            <form action="<?=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']?>" method="post">
            <input type="hidden" name="chargeaccepted" value="<?=empty($_GET['chargeaccepted'])? '0' : $_GET['chargeaccepted']?>"/>
            <button type="submit" name="request_date" value="1" class="btn btn-primary" style="float: left; position: relative; left: 10px;">Send Date Request<i class="fa fa-arrow-right"></i></button>
            </form>
    <?php } ?>

</div>
           
          </div>

<?php
}

}

}

?>
                </div>

              </div>


            </div>
          </div>
        </div>
<br clear="all">
</div>
</div>