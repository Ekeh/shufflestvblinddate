<style>
    .table-wrapper-trend-profile {
        overflow: scroll;
    }
    .table-wrapper-trend-profile::-webkit-scrollbar {
        background: transparent;  /* Optional: just make scrollbar invisible */
        width: 5px;
    }
    .table-wrapper-trend-profile::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
    }
    /* Optional: show position indicator in red */
    .table-wrapper-trend-profile::-webkit-scrollbar-thumb {
        background: #27293D
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,1); ;
    }

</style>
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
          <div class="row " style="padding: 20px;">
            <h3 style="color: yellow; padding: 10px">Blind Date </h3>

            <div class="col-lg-12">

            <div align="center"> <br clear="all">
                <!--<a href="<?php echo SITE_URL; ?>/index.php?p=dashboard" class="btn btn-primary" style="background-color: red">Home</a>
           <a href="<?php /*echo SITE_URL; */?>/index.php?p=trend" class="btn btn-primary" style="background-color: red">Trend Profile</a>-->

</div>
 <h3>Trending Profile</h3>



<div class="row">
            <div class="col-lg-12">

              <div class=" " >

<div class="card-body" >
<div id="video-gallery" align="left" >
                   <?php
if(isset($_COOKIE['userid']))
{
$userid=$_COOKIE['userid'];
$sqlTrending = mysqli_query($db,"SELECT userid, photo, username FROM tbl_users WHERE profile_type='" . PROFILE_TRENDING . "' order by rand() LIMIT 20");
$numTrend = mysqli_num_rows($sqlTrending);
if($numTrend !== '0') {
        ?>

        <div class="table-responsive table-wrapper-trend-profile">
            <table class="table">
                <tr>
                    <?php
    while($rows = mysqli_fetch_array($sqlTrending)) {
        $photo = $rows['photo'];
        if (empty($photo)) {
            continue;
        }
        $trend_user_id = $rows['userid'];
        $trend_photo = $rows['photo'];
        $trend_username = $rows['username'];
                    ?>
                    <td align="left" style="width:200px">
                        <a href="index.php?p=dgallery&amp;u=<?=$trend_user_id?>">
                            <img src="uploads/profile/<?=$trend_photo?>" alt="<?=$trend_username?>"
                                 style="width: 200px; height:200px; padding: 10px; object-fit:cover; border-radius:50%" />
                        </a>
                    </td>

        <?php
    }
        ?>

                </tr>
            </table>
        </div>
        <?php
}
    ?>
    <br />
    <br />

    <h3>Gallery</h3>
    <hr />
    <br />
<?php

//// get profile of those that are trending
$sql = mysqli_query($db,"SELECT * FROM tbl_users WHERE profile_type='" . PROFILE_FREE . "' AND userid != '$userid'  order by rand()");
$num=mysqli_num_rows($sql);

if($num=='0'){
  ?>
<div class='alert alert-danger'> No Public Profile at the moment</div>
<div class='alert alert-success'> Would you like to feature your profile here ? <a href='index.php?p=trend' target='_blank'>LEARN MORE</a></div>
  <?php
}else{

while($rows=mysqli_fetch_array($sql))
{
 $photo=$rows['photo'];
 if(empty($photo)) {
     continue;
 }
 $name=$rows['username'];
 $uid=$rows['userid'];
 $make_trend=$rows['make_trend'];
 $nam=substr($name,0,15);


?>
<div class="item" style="float: left; position: relative;right: 5px; width: 220px;">
<a href="index.php?p=dgallery&u=<?php echo $uid; ?>">
  <img src="uploads/profile/<?php echo $photo; ?>" alt="" style='width: 200px; height:250px; object-fit:cover; border-radius:5px'></a>
  <h5 class="this-title" align="" style="padding: 10px"><?php

  if($name==''){echo "...";}else{echo $nam; if (strlen($name) > 15){echo "...";}}?></h5>


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