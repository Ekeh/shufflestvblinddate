<div class="main-panel" >
        <div class="content-wrapper">
          <div class="row ">
            <div class="col-lg-12">


<div class="row">
            <div class="col-lg-12">

              <div class="card px-3" >
                <div class="card-body" >
                
                       <div id="video-gallery" class="row " align="center">
                       	<div align='center'>
               
<?php
$rid='';
$video='';
if(isset($_GET['rid'])){
    $rid=$_GET['rid'];
}else{
    /////if the get was not set, return user to the home page
?> <script type="text/javascript">window.location.replace("<?php echo SITE_URL; ?>");</script> <?php 
}

$selectdata = mysqli_query($db,"SELECT * FROM tbl_finalist where fid='$rid'");

while($row=mysqli_fetch_array($selectdata))
  {

      $fname=$row['fname'];
 }



                        ?>
                        <h3 style="text-transform: none">I want to vote  <span style="color:yellow">"<?php echo $fname; ?>"</span> </h3>
            
            <div class="main-content" >
            <div class="wrap">      <div class="content-grids">
                    <?php 
                    $userid=$_COOKIE['userid'];

                    if(isset($_POST['votenow'])){
                        $amount=$_POST['amount'];
                        $votes=$_POST['votes'];
                        $tamount=$amount*$votes;
                        $refid=$_POST['refid'];

                   

                        if($tamount=='' || $refid==''){
echo '<div class="alert alert-danger"> ERROR: Kindly try again later.</div>';
                        }else{
$selectuser = mysqli_query($db,"SELECT * FROM tbl_users where userid='$userid' ");
while($row=mysqli_fetch_array($selectuser))
  {
      $credit=$row['credit'];
      $money=$row['active_subscription_amount'];

    
 }

 if($credit>=$tamount){
 $vote = mysqli_query($db,"INSERT into tbl_final_vote set  vuser_id='$userid',finalist_id='$refid',amount='$tamount' ");
  $up = mysqli_query($db,"UPDATE  tbl_users set  credit=credit - $tamount where userid='$userid'");

    $up2 = mysqli_query($db,"UPDATE  tbl_finalist set  votes_received=votes_received + $votes  where refid='$refid'");

 if($vote){ echo '<div class="alert alert-success "> Voting Acknowledged</div>';

 ?>
<script>
         setTimeout(function(){
            window.location.href = '<?php echo SITE_URL; ?>/index.php?p=finals';
         }, 3000);
      </script> 

      <?php
  }else{
    echo '<div class="alert alert-danger "> Failed: Kindly try again later.</div>';
 }
}else{
echo '<div class="alert alert-danger">Insufficient Funds <br> <a href="'.SITE_URL.'/index.php?p=fundwallet">Fund Wallet</a></div>';   
}
                        }                    }
////// information about comedian starts here
      $selectdata = mysqli_query($db,"SELECT * FROM tbl_finalist where fid='$rid' ");
while($row=mysqli_fetch_array($selectdata))
  {
      $fid=$row['fid'];
      $fname=$row['fname'];
       $refid=$row['refid'];
     $picture=$row['picture'];
      $video=$row['video'];
 }

 $selectuser = mysqli_query($db,"SELECT * FROM tbl_users where userid='$userid' ");
while($row=mysqli_fetch_array($selectuser))
  {
      $credit=$row['credit'];   
 }

////amount charged per vote
 $money=50;
 ?>
<div class="content-grid" style="width:300px;">
            <img src="uploads/finalists/<?php echo $picture; ?>" title="<?php echo $fname; ?>" style='width: 300px; height: 300px;'  />
   
          
    <br>

              <?php if($credit<$money){ 
                $pager='index.php?p=qnapage&rid='.$rid.'';
                ?>
<div class="alert alert-block alert-danger "> Insufficient Funds in Wallet <br> <a href="<?php echo SITE_URL; ?>/index.php?p=fundwallet" style='padding:30px; color:yellow'>Fund Wallet</a></div>


              <?php 
              $msg='';
            ////  include('inc/log_reg_check_subscription.php');
         //// if($msg!=''){echo $msg;}
/////include('inc/log_reg_choose_subscription.php');
            }else{


$selectdata = mysqli_query($db,"SELECT * FROM tbl_settings where name='is_voting_live' ");

while($row=mysqli_fetch_array($selectdata))
  {

      $value=$row['value'];
    
 }

  if($value=='yes'){      
  if($money!='0'){   
     ?>
  <div>
<?php 
$end=0; 
if($end=='1'){ echo "<h3>Voting has Ended </h3>";}else{ ?>
    <p>Each vote costs N <?php echo $money; ?> </p>
    <form method="Post" action="">
            <input type="number" min='1' name="votes" class="form-control" value="" placeholder="Input number of votes e.g 5">
              <input type="hidden" name="refid" value="<?php echo $refid; ?>">
               <input type="hidden" name="amount" value="<?php echo $money; ?>">
            <input type="submit" name="votenow" value="VOTE NOW" class=' btn btn-primary ' style="padding: 10px 30px; margin-top:10px; cursor: pointer;" >
          </form>
<?php } ?>
</div><br clear="all">

<br>
<div >
         
</div>

          <?php 





        }else{
            echo "<div style='padding:30px; color:yellow'>Voting has not started</div>";} ?>
            <!--
          <a href='index.php?p=updatesub' class='' style="padding: 5px 30px; background-color: green">Review  Subscription</a> -->
          <?php

}else{

  echo "<div style='color:red; padding:4px 10px 4px 10px'>Voting has Ended <div>";
}


           } ?>
          </p>
          </div>
<div class="clear"> </div>
</div>
        <?php
if($video!=''){?>
<div class="clear"> </div>
<hr>


<?php } ?>

    </div>
    <div class="clear"> </div>
</div> </div>
 <br><br>
  
                
</div>
</div>
</div>