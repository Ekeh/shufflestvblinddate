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
$d='';
?>
<div class="main-panel" >
        <div class="">
          <div class="row " style="padding: 20px;">
            <h3 style="color: yellow; padding: 10px">Blind Date </h3>

            <div class="col-lg-12">

            <div align="center"> <br clear="all">
<a href="<?php echo SITE_URL; ?>/index.php?p=blinddategallery" class="btn btn-primary" style="background-color: red">Home</a>
                <a href="<?php echo SITE_URL; ?>/index.php?p=gallery" class="btn btn-primary" style="background-color: red">View Gallery</a>

</div>
 <h3>Trend your Profile</h3>



<div class="row">
            <div class="col-lg-12">
           <div class="card-body" >
      
  
            <p>When you trend yourself, people will see your profile in the gallery. You must have a profile picture.</p>
            <div class="" >
              <?php
              $amount='';
              $stop=0;


              if(isset($_POST['start_trend'])){
$userid=$_POST['userid'];
 $sp = mysqli_query($db,"UPDATE tbl_users set make_trend='1',profile_type='1' WHERE userid='$userid'");

if($sp){
echo "<div class='alert alert-success'>Sucessful</div>";
?>
<script>
         setTimeout(function(){
            window.location.href = 'index.php?p=gallery';
         }, 1000);
      </script>
      <?php
}else{
echo "<div class='alert alert-danger'>Failed</div>";
}

}


              if(isset($_POST['stop_trend'])){
$userid=$_POST['userid'];
 $sp = mysqli_query($db,"UPDATE tbl_users set make_trend='0' WHERE userid='$userid'");

if($sp){
echo "<div class='alert alert-success'>Sucessful</div>";
?>
<script>
         setTimeout(function(){
            window.location.href = 'index.php?p=gallery';
         }, 1000);
      </script>
      <?php
}else{
echo "<div class='alert alert-danger'>Failed</div>";
}

}

if(isset($_POST['addfunds'])){
$amount=$_POST['amount'];

if($amount==''){
  echo "<div class='alert alert-danger'>Kindly add a valid amount</div>";
}else{
  /////call the paystack function
$userid=$_COOKIE['userid'];
 $sql3 = mysqli_query($db,"SELECT * FROM tbl_users WHERE userid='$userid'");
while($rows=mysqli_fetch_array($sql3))
{

 $email=$rows['email'];

}
  include('paystack_trend.php');
  $stop=1;
}


}

if($stop=='0'){
$userid=$_COOKIE['userid'];
$sq = mysqli_query($db,"SELECT * FROM tbl_users WHERE userid='$userid'");
while($rows=mysqli_fetch_array($sq))
{

 $photo=$rows['photo'];
 $wallet=$rows['credit'];
 $make_trend=$rows['make_trend'];
 $userid=$rows['userid'];
}

if($photo==''){
///no photo found
 echo "<div class='alert alert-danger'>You must have a profile picture to continue. <a href='updateprofile.php' target='_blank'> CLICK HERE </a></div>";
}elseif($make_trend=='1'){

 echo "<div class='alert alert-success'>You are already trending</div>";
?>
 <form method="post" action="">
                  <b>Click the UNtrend button (You can start trending at any time)</b>
                  <input type="hidden" name="userid" value="<?php echo $userid; ?>" class="form-control"><br>
                  <input type="submit" name="stop_trend" value="UNtrend Now" class="btn btn-primary">
                </form>
                <?php


}elseif($wallet<100){
////less than 100 in wallet

              ?>

                <form method="post" action="">
                  <b>Enter an amount (NGN)</b>
                  <input type="number" min='100' name="amount" value="<?php echo $amount; ?>" class="form-control" placeholder="Add Amount" required><br>
                  <input type="submit" name="addfunds" value="Submit" class="btn btn-primary">
                </form>
              <?php
}else{
    echo "<div class='alert alert-success'>Everything seem fine</div>";
?>
 <form method="post" action="">
                  <b>Click the Start Trending button (You can stop trending at any time)</b>
                 <input type="hidden" name="userid" value="<?php echo $userid; ?>" class="form-control"><br>
                  <input type="submit" name="start_trend" value="Start Trending" class="btn btn-primary">
                </form>
                <?php
}

}
?></div></div>
          </div>
        </div>
<br clear="all">
</div>
</div>
    <script type="text/javascript">
      var blurred = false;
window.onblur = function() { blurred = true; };
window.onfocus = function() { blurred && (location.reload()); };
    </script>