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
            <h3 style="color: yellow; padding: 10px"> Love or Lust? </h3>

            <div class="col-lg-12">

            <div align="center"> <br clear="all">
<a href="<?php echo SITE_URL; ?>/index.php?p=lol" class="btn btn-primary" style="background-color: red">Home</a> 
<a href="<?php echo SITE_URL; ?>/index.php?p=reservation" class="btn btn-primary" style="background-color: red">Make A Reservation</a>  <a href="<?php echo SITE_URL; ?>/index.php?p=trend" class="btn btn-primary" style="background-color: red">Trend Profile</a> <a href="<?php echo SITE_URL; ?>/index.php?p=gallery" class="btn btn-primary" style="background-color: red">View Gallery</a> <!--<a href="<?php echo SITE_URL; ?>/index.php?p=topvotes-lol" class="btn btn-primary" style="background-color: red">View Results</a>-->

</div>
 <h3>Results</h3>



<div class="row">
            <div class="col-lg-12">
     

      

                          
<br><br>
        
        <h5>N.B : Only the top 6 individuals will be invited to the show. <br> They would be able to choose their date from the gallery </h5>

        <br>

        <table class="" style="width: 100%" cellpadding="10px">
          <tr style="background-color: #000000; color: #ffffff; font-weight: bold;"><td>S/No</td><td>Name</td><td>User ID</td><td> Funds (%)</td></tr>
<?php 

$total=0;
$cnt=1;
   $s = mysqli_query($db,"SELECT * FROM tbl_users where make_reservation='1'");
while($rows=mysqli_fetch_array($s))
{
   $total=$total+$rows['credit'];
  }

   $sql3 = mysqli_query($db,"SELECT * FROM tbl_users where make_reservation='1' order by credit desc");
while($rows=mysqli_fetch_array($sql3))
{

 $name=$rows['username'];
  $uid=$rows['userid'];
$credit=$rows['credit'];

if($total=='0'){
$mywallet=0;
}else{
$mywallet=round(($credit*100)/$total,2);
}
?>
  <tr ><td><?php echo $cnt; ?></td><td><?php echo $name; ?></td><td><?php echo $uid; ?></td><td> <?php echo $mywallet; ?> %</td></tr>

<?php
$cnt++;
} ?>

        </table>
         

          </div>
        </div>
<br clear="all">
</div>
</div>