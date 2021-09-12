<?php

if(!isset($_COOKIE['userid'])){
?>
<script type="text/javascript">
alert("You Must Login to view this page");
 setTimeout(function(){
            window.location.href = 'https://shufflestv.com/index.php?p=login';
         }, 1000);
</script>
<?php
  exit;
} ?>
<style>
li {

 display: inline;
}

.scrolling img{
  border-radius:5px;
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
          <div class="row ">
  
            <div class="col-lg-12"> 
<div class="row">
            <div class="col-lg-12">
     <div align="center" style="padding: 15px; padding-left: 20px"> <br clear="all">
   <?php if(!isset($_COOKIE['userid']))
     {
?><a href="<?php echo SITE_URL; ?>/register.php" class="btn btn-primary" style="background-color: red">Register / Login</a>
<?php }else{
  ?><a href="<?php echo SITE_URL; ?>/index.php?p=livestream" class="btn btn-primary" style="background-color: red">Watch LiveStream</a>
<?php
} ?>
</div>
<?php
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



?>



              <div class=" " >
                  
                <div class="card-body" >
       
                       <div id="video-gallery" align="left" >
                              <div align='center'>
                          <h5> Choose a Show to see highlights </h5>
<div class='info'> <a href ="index.php?p=roomies-highlight" ><img src='images/shows/roomies.jpg'></a>
</div>

<div class='info'><a href ="index.php?p=lol-highlight"><img src='images/shows/lol.jpg'></a>
</div>


</div>
 <br clear="all">       
<br><Br><br><br>

</div>
          </div>
        </div>

</div>
</div>