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
  ?>
<?php
$d='';
?>
<div class="main-panel" >
        <div class="">
          <div class="row " style="padding: 20px;">
            <h3 style="color: yellow; padding: 10px"> Love or Lust? </h3>

            <div class="col-lg-12">

            <div align="center"> <br clear="all">

<a href="<?php echo SITE_URL; ?>/index.php?p=reservation" class="btn btn-primary" style="background-color: red">Make A Reservation</a>  <a href="<?php echo SITE_URL; ?>/index.php?p=trend" class="btn btn-primary" style="background-color: red">Trend Profile</a> <a href="<?php echo SITE_URL; ?>/index.php?p=gallery" class="btn btn-primary" style="background-color: red">View Gallery</a> <a href="<?php echo SITE_URL; ?>/index.php?p=topvotes-lol" class="btn btn-primary" style="background-color: red">View Results</a>

</div>
 <h3>Trending</h3>
 <div align='center'>
<?php

//// get profile of those that are trending
$sql = mysqli_query($db,"SELECT * FROM tbl_users WHERE make_trend='1' and credit!='0' order by rand() limit 8");
$num=mysqli_num_rows($sql);

if($num=='0'){
  ?>
<div class='alert alert-danger'> No Trending Photos at the moment</div>
  <?php
}else{

while($rows=mysqli_fetch_array($sql))
{

 $photo=$rows['photo'];
 $username=$rows['username'];
 $uid=$rows['userid'];
?>
<div class="item" style="float: left;  position: relative; right: 5px; padding: 4px; margin-left: auto; margin-right: auto;"><a href="index.php?p=dgallery&u=<?php echo $uid; ?>"><img src="uploads/profile/<?php echo $photo; ?>" alt="<?php echo $username; ?>" title="<?php echo $username; ?>"  style="object-fit: cover; border-radius: 10px; width: 170px; height:200px; "></a>
          </div>

<?php
}

}

?>
</div>


<div class="row">
            <div class="col-lg-12">
     
              <div class=" " >
                  
                <div class="card-body" >
      
                       <div id="video-gallery" align="left" >
                          

                </div>

              </div>


            </div>
          </div>
        </div>
<br clear="all">
</div>
</div>