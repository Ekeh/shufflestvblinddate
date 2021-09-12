 <!-- contents -->
     <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5db54b841de87700125fca76&product=inline-share-buttons" async="async"></script>
        <div class="main_content">
    <div class="main_content_inner" align="center">
               <div class="uk-card-default  p-3 uk-width-1-1@m rounded" style="padding: 10px" 
 <div align="left">
 	<h3>Your referral ID is <?php echo $_COOKIE['userid']; ?> </h3>
 
  <div style="width: 100%">
<div class="sharethis-inline-share-buttons" data-url="I just found this beautiful opportunity to make lots of money. You should check it out !   <?php echo SITE_VIP; ?>/form-register.php?ref=<?php echo $_COOKIE['userid']; ?>" data-title="Come see a new type of entertainment"></div>
 	<!--  <div style="padding: 10px; align=left;"> - Choose from any/all of the options above <br> - Share your unique referral link - <?php echo SITE_VIP; ?>/form-register.php?ref=<?php echo $_COOKIE['userid']; ?> <br> - When your friends register using your link, you immediately get credited 10% of their  initial subscription. <br>  </b>
   </div>-->

                </div>


<?php
$userid=$_COOKIE['userid'];
$chk = mysqli_query($db,"SELECT * FROM tbl_users  where ref='$userid'  ");
$nms=mysqli_num_rows($chk);
				?>	
						<h3>Those referred by you - <?php echo $nms; ?></h3>
		
					
				
		
			
<table class="table" width="100%">
	<tr class="theader"><td>S/No</td><td>Name</td><td>Date</td><td>Subscription</td><td>Commission</td></tr>

<?php
$cnt=1;
$userid=$_COOKIE['userid'];
$selectdata = mysqli_query($db,"SELECT * FROM tbl_users  where ref='$userid'  order by userid desc");

while($row=mysqli_fetch_array($selectdata))
  {

    $fname=$row['fname'];
      $lname=$row['lname'];
     $reg_date=$row['reg_date'];
      $first_subscription=$row['first_subscription'];
      if($first_subscription=='0'){$maxsub=0;}else{
      $maxsub=($first_subscription*100)/10;
  }
     ?>
<tr><td><?php echo $cnt; ?></td><td><?php echo $fname; ?> <?php echo $lname; ?></td><td><?php echo $reg_date; ?></td><td><?php echo $maxsub; ?></td><td><?php echo $first_subscription; ?></td></tr>

     <?php

$cnt++;
}

?>


</table>

 </div>

                    </div>
 <br><br>
  
                
</div>
                </div>



            