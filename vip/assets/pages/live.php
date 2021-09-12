 <!-- contents -->
        <div class="main_content">

            <div class="main_content_inner">

    <?php

$selectdata = mysqli_query($db,"SELECT * FROM tbl_settings where name='LIVE_AMOUNT' ");

while($row=mysqli_fetch_array($selectdata))
  {

      $value=$row['value'];
    
 }

define("LIVE_VIDEO_COST","$value"); 
$now='';
$date='';
 $qery=mysqli_query($db,"SELECT * FROM tbl_users where userid='$userid' "); 
$rew = mysqli_fetch_array($qery,MYSQLI_ASSOC); 

 $credit=$rew['credit'];

///check if the credit is greater than or equal to the cost of the video

 

 if($credit<LIVE_VIDEO_COST){
  ?>
<script type="text/javascript">alert("You have insufficient credit to watch this video. Kindly fund your wallet. Video Costs N<?php echo number_format(LIVE_VIDEO_COST); ?>");
   setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>/index.php?p=fundwallet';
         }, 500);
</script>
  <?php
  exit; //// stop all action
  ///prompt user and redirect to payment page
 }

//////
 $userid=$_COOKIE['userid'];
  $query=mysqli_query($db,"SELECT * FROM tbl_vip_live where status='0' order by id asc limit 1  "); 
$ruw = mysqli_fetch_array($query,MYSQLI_ASSOC); 

 $vid=$ruw['id'];
  $show_time=$ruw['show_time'];
  $status=$ruw['status'];
 //// update the number of viewers
$sql=mysqli_query($db,"UPDATE tbl_vip_live set views=views+1 where id='$vid' ");  

//// check if the video is stored in myvideos else charge the person
$sqls=mysqli_query($db,"SELECT * from tbl_vip_live_watched  where video_id='$vid' and userid='$userid'"); 
$num=mysqli_num_rows($sqls);

if($num=='0'){
if($credit>=LIVE_VIDEO_COST){
  $video_amount=LIVE_VIDEO_COST;
  ///deduct the cost of the video and give value to customer
   $qery=mysqli_query($db,"UPDATE tbl_users set  credit=credit-$video_amount where userid='$userid' "); 
   echo "<div class='uk-alert-success fade in' uk-alert>N ".$video_amount." has been removed from your wallet</div>";
 }else{
  ////be double sure the person has credit
  ?>
<script type="text/javascript">alert("You have insufficient credit to watch this live video. Kindly fund your wallet.");
   setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>/index.php?p=fundwallet';
         }, 500);
</script>
  <?php
  exit; //// stop all action
  ///prompt user and redirect to payment page

 }
 //// put the video in the watched list
 $i=mysqli_query($db,"INSERT into tbl_vip_live_watched set video_id='$vid', userid='$userid' "); 
}

 ?>

                
                <!-- find channals  header -->

                <div class="section-header mt-12">
                    <div>
                            <h1> Watch Live Video </h1>




   
                        </div>
                 
                </div>

                <!-- find channals -->
                <div class="" style="padding: 10px">
                    <iframe src="<?php echo SITE_VIP; ?>/checkvoting.php"  frameBorder="0" height='50px' width='100%'  scrolling="no"></iframe>
          <br>  


<?php
/*echo time()+(60*60*24*7)+(7*60*60);*/
if($status=='0'){  echo "<b>Show will start ";echo date('m/d/Y H:i:s', $show_time);  echo "</b>";
?>
<script type="text/javascript">
   <script>
         setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>/index.php?p=live';
         }, 30000);
      </script>
</script>

<?php }else{ echo "<b>Now Showing</b><br>";


//// include the iframe that displays the video
?>
<iframe width="560" height="315" src="https://www.youtube.com/embed/RDXC5wXyeUQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php
}

                          ?>



                    </div>
 <br><br>
  
                

                </div>



            