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
            <h3 style="color: yellow; padding: 10px">Blind Date Requests</h3>

            <div class="col-lg-12">

            <div align="center"> <br clear="all">
<a href="<?php echo SITE_URL; ?>/index.php?p=dashboard" class="btn btn-primary" style="background-color: red">Home</a>
                <a href="<?php echo SITE_URL; ?>/index.php?p=trend" class="btn btn-primary" style="background-color: red">Trend Profile</a>
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
$userid=$_COOKIE['userid'];

if(isset($_POST['accept_request'])) {
    $request_id = $_POST['request_id'];
    $from_user_id = $_POST['from_user_id'];
     $q = mysqli_query($db,"UPDATE tbl_blind_date_request SET status='" . BLIND_DATE_STATUS_ACCEPTED . "' WHERE id='$request_id'");
    if(mysqli_affected_rows($db) > 0) {
        mysqli_query($db, "UPDATE tbl_users SET profile_type = '" . PROFILE_ON_DATE . "' WHERE userid='$userid'");
        mysqli_query($db, "UPDATE tbl_users SET profile_type = '" . PROFILE_ON_DATE . "' WHERE userid='$from_user_id'");
        //TODO: Expire other requests from any of these users
        $q = mysqli_query($db,"UPDATE tbl_blind_date_request SET status='" . BLIND_DATE_STATUS_EXPIRED . "' WHERE id !='$request_id' AND user_id = '$userid'");
        $q = mysqli_query($db,"UPDATE tbl_blind_date_request SET status='" . BLIND_DATE_STATUS_EXPIRED . "' WHERE id !='$request_id' AND to_user_id = '$userid'");
    }

    ?>
    <script>
    alert('Request accepted successfully.');
    </script>
    <?php
}

    if(isset($_POST['reject_request'])) {
    $request_id = $_POST['request_id'];
    $from_user_id = $_POST['from_user_id'];
    $q = mysqli_query($db,"UPDATE tbl_blind_date_request SET status='" . BLIND_DATE_STATUS_REJECTED . "' WHERE id='$request_id'");
    if(mysqli_affected_rows($db) > 0) {
        mysqli_query($db, "UPDATE tbl_users SET profile_type = '" . PROFILE_FREE . "' WHERE userid='$userid'");
        mysqli_query($db, "UPDATE tbl_users SET profile_type = '" . PROFILE_FREE . "' WHERE userid='$from_user_id'");
    }
    ?>
    <script>
        alert('Request rejected successfully.');
    </script>
<?php
}
//// get profile of those that are trending
$checkRequest = mysqli_query($db,"SELECT * FROM tbl_blind_date_request WHERE to_user_id='$userid' AND status = '" . BLIND_DATE_STATUS_PENDING ."'");
$nu=mysqli_num_rows($checkRequest);
if($nu== 0){
  ?>
<div class='alert alert-danger'>No pending date request</div>
  <?php
}else{
while ($request = mysqli_fetch_assoc($checkRequest)){

    $requestDetails = mysqli_query($db, "SELECT * FROM tbl_users WHERE userid='" . $request['user_id'] . "'");
while ($rows = mysqli_fetch_assoc($requestDetails))
{
    $photo = $rows['photo'];
    $name = $rows['username'];
    $uid = $rows['userid'];
    $description = $rows['description'];
    $nam = substr($name, 0, 15);
    ?>
    <div class="row">
        <div class="col-lg-5 col-md-6 offer-deal" align="right">
            <img src="uploads/profile/<?php echo $photo; ?>" alt=""
                 style='width: 350px; height:auto; object-fit:cover; border-radius:5px'>
        </div>
        <div class="col-lg-5 col-md-6">
            <h5 class="" align="" style="padding: 10px"><b>Name:</b><br><?php echo $name; ?></h5>
            <p><b>Description:</b><br/><?= $description ?></p>
            <br><br><br>
            <form action="<?= $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'] ?>" method="post">
                <input type="hidden" name="request_id" value="<?= $request['id'] ?>"/>
                <input type="hidden" name="from_user_id" value="<?= $request['user_id'] ?>"/>
                <button type="submit" name="accept_request" value="1" class="btn btn-success"
                        style="float: left; position: relative; left: 10px; margin-right: 5px;">Accept<i
                            class="fa fa-arrow-right"></i></button>

            </form>
            <form action="<?= $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'] ?>" method="post">
                <input type="hidden" name="request_id" value="<?= $request['id'] ?>"/>
                <input type="hidden" name="from_user_id" value="<?= $request['user_id'] ?>"/>
                <button type="submit" name="reject_request" value="1" class="btn btn-danger"
                        style="float: left; position: relative; left: 10px;">Reject<i class="fa fa-arrow-right"></i>
                </button>

            </form>

        </div>

    </div>

    <?php
}

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