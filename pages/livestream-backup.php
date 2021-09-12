<div class="main-panel" >
        <div class="content-wrapper">
          <div class="row ">
            <div class="col-lg-12">
<h3> Live Streaming</h3>
      <br clear="all">

<div class="row">
            <div class="col-lg-12">
<h3>Note: Livestream Quality/Availability dependent on Network.</h3>

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
include('inc/subscriptionform_chk.php');


$sql = mysqli_query($db,"SELECT * FROM tbl_livestreaming where client_id='$userid'");
$nums=mysqli_num_rows($sql);
$row = mysqli_fetch_array($sql,MYSQLI_ASSOC); 
   $stop_time=$row['stop_time'];

$sql4 = mysqli_query($db,"SELECT * FROM tbl_users where userid='$userid'");
$rows = mysqli_fetch_array($sql4,MYSQLI_ASSOC); 
   $credit=$rows['credit'];

$nowtime=time();

if($nums=='0'){

      echo "<div class='alert  alert-danger' style='color:#ffffff;'> You don't have an active subscription </div>";
      if($credit>=100){
      /// user has some money so request deduction
        echo "<div class='alert alert-block alert-success'  style='color:#ffffff;'> Subscribe Below </div>";
        include('inc/subscriptionform.php');
      }else{
      ////user has no money do redirect to paystack
        echo "<div class='alert alert-block alert-danger '  style='color:#ffffff;'> Fund your wallet now </div>";
        echo "<a href='".SITE_URL."/index.php?p=makepayment'><div class='btn btn-primary'>Start Now</div></a>";
      }

}else{
  /*$officialstart='1605459600';
$start=time();

if($officialstart>$start)
{//// meaning we have not reached the start time



                         ?>

                         <!-- Display the countdown timer in an element -->
                         <h5> Broadcast starts ...
                        <?php 

echo date("jS M Y H:i:s" , $officialstart); ?></h5><br><br>
<p id="demo" style="font-size: 35px; font-weight: bold; color: yellow"></p>

<script>
// Set the date we're counting down to
var countDownDate = new Date("Jan 30, 2020 10:30:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "NOW LIVE";
  }
}, 1000);
</script>





<?php 
///// comment this else so it starts immediately
///}else{
  */
  ///// do what should be done when the time to broadcast reaches.
?>
<h6>Your Subscription expires...
 <?php 

echo date("jS M Y H:i:s" , $stop_time); ?>
</h6>
<!--
<div >
                <form method="post" action="index.php?p=allvideos">
                  <table width="100%"><tr><td > <input type="text" class="form-control" placeholder="Search Video Title, Ref Id or Description etc" aria-label="search" aria-describedby="search" name="table_search" ></td><td><input type="submit" name="search" value="SEARCH" class="btn btn-success"></td></tr></table>
               
                 </form>
                <br>
              </div>

<div class="" align="">
  <video id="video1" width="480" height="320"   preload="auto" autoplay    playsinline allowfullscreen uk-responsive controls controlslist="nodownload" >
    <source src="<?php echo SITE_URL; ?>/images/shuffles.mp4" type="video/mp4" >
    Your browser does not support HTML5 video.
  </video>
</div> -->

<!-- this is for the IBM
         
         <div
  id="Container"
  style="padding-bottom:56.25%; position:relative; display:block; width: 100%"
>
<iframe src="https://video.ibm.com/combined-embed/24009456?videos=gallery&autoplay=true" 
  width="100%" height="100%"
    style="position:absolute; top:0; left: 0"
    allowfullscreen
    webkitallowfullscreen
    frameborder="0"></iframe>

</div>

<div
  id="Container"
  style="padding-bottom:56.25%; position:relative; display:block; width: 100%"
>
<iframe src="https://video.ibm.com/embed/24054423?autoplay=true" style="border: 0;position:absolute; top:0; left: 0" webkitallowfullscreen allowfullscreen frameborder="no" width="100%" height="100%"></iframe>

</div>-->
  <!--
<br>
<h6>Live Chat</h6>
<br>
<div
  id="Container"
  style="padding:10px; padding-bottom:56.25%; position:relative; display:block; width: 100%"
>
  <iframe
    id="UstreamIframe"
    src="https://video.ibm.com/socialstream/24054423?videos=0"
    width="100%" height="100%"
    style="position:absolute; top:0; left: 0"
    allowfullscreen
    webkitallowfullscreen
    frameborder="0"
  >
  </iframe>
</div>

<div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/509281442" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe></div>


-->

<!--<div align="center">
  <div style="max-width: 300px; margin-top: 300px; padding: 10px;">
<h4>Extend your Subscription!</h4>
 <?php include('inc/subscriptionform.php');
              ?>
            </div>
            </div>-->
<?php

///}
}

?>

            
          </div>
        </div>
<br clear="all">

<?php

if(isset($_COOKIE['userid'])){

if($_COOKIE['userid']=='23750'){
?>
<!---
<h4>Test transmission </h4>
////include test transmission here for only this user
-->
<?php
}


}

 ?>

</div>
</div>
</div>
  
<!--- this refreshes the page when it returns from payment  -->
<!--
<script type="text/javascript">
  var blurred = false;
window.onblur = function() { blurred = true; };
window.onfocus = function() { blurred && (location.reload()); };

</script>
-->