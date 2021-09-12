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
            <h3 style="color: yellow; padding: 10px"> Love or Lust? </h3>

            <div class="col-lg-12">

            <div align="center"> <br clear="all">
<a href="<?php echo SITE_URL; ?>/index.php?p=lol" class="btn btn-primary" style="background-color: red">Home</a> <!--
<a href="<?php echo SITE_URL; ?>/index.php?p=reservation" class="btn btn-primary" style="background-color: red">Make A Reservation</a> --> <a href="<?php echo SITE_URL; ?>/index.php?p=trend" class="btn btn-primary" style="background-color: red">Trend Profile</a> <a href="<?php echo SITE_URL; ?>/index.php?p=gallery" class="btn btn-primary" style="background-color: red">View Gallery</a> <a href="<?php echo SITE_URL; ?>/index.php?p=topvotes-lol" class="btn btn-primary" style="background-color: red">View Results</a>

</div>
 <h3>Reservation</h3>



<div class="row">
            <div class="col-lg-12">
     
              <div class=" " >
                  
                <div class="card-body" >
      
                       <div id="video-gallery" align="left" >
                          
  <p>The more money in your wallet, the higher your chances of being amongst the top 6 people that would be invited for a 48hr dating game show showing live an online on shufflestv.com.<br> The show will run every 2 weeks and the money in your wallet will not expire until you feature.
            </p>
            <div class="" >
              <?php
              $amount='';
              $stop=0;

              $userid=$_COOKIE['userid'];
 $sql3 = mysqli_query($db,"SELECT * FROM tbl_users WHERE userid='$userid'");
while($rows=mysqli_fetch_array($sql3))
{

 $email=$rows['email'];
  $credit=$rows['credit'];

}
if(isset($_POST['addfunds'])){
$amount=$_POST['amount'];

if($amount==''){
  echo "<div class='alert alert-danger'>Kindly add a valid amount</div>";
}else{
  /////call the paystack function

  include('paystack_reservation.php');
  $stop=1;
}


}

if($stop=='0'){

  if($credit>='100'){
  $sqlz= mysqli_query($db,"UPDATE tbl_users set make_reservation='1',profile_type='1' WHERE userid='$userid'"); 
if($sqlz){
  echo "<div class='alert alert-success'>Your reservation is noted</div>";
          ?>
                        <script type="text/javascript">

                           setTimeout(function(){
                                    window.location.href = '<?php echo SITE_URL; ?>/index.php?p=topvotes-lol';
                                 }, 1000);
                        </script>
                        <?php

}else{
    echo "<div class='alert alert-danger'>An error occurred. Please try again later.</div>";
}

  }else{
              ?>

                <form method="post" action="">
                  <b>Enter an amount (NGN)</b>
                  <input type="number" min='100' name="amount" value="<?php echo $amount; ?>" class="form-control" placeholder="Add Amount" required><br>
                  <input type="submit" name="addfunds" value="Submit" class="btn btn-primary">
                </form>
              <?php 

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