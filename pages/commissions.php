<div class="main-panel" >
        <div class="content-wrapper">
          <div class="row ">
            <div class="col-lg-12">
<h3> Referral Commisions</h3>
      <br clear="all">

<div class="row">
            <div class="col-lg-12">

              <div class="card px-3" >
                <div class="card-body" >
                
       
                        <div align='center'>

<div style="padding: 10px; text-align: left">
<?php
$userid=$_COOKIE['userid'];
  $tot=mysqli_query($db,"SELECT  SUM(amount) AS sumtviews FROM tbl_commission WHERE refid='$userid' ");   
      while($row=mysqli_fetch_array($tot))
  {
$total= $row['sumtviews']; 
  }

echo "Total Earnings - N";
echo $total;
echo " <br>";

$query=mysqli_query($db,"SELECT * FROM tbl_users WHERE userid='$userid'");   
while($row=mysqli_fetch_array($query))
  {
    /*$vid_title=$row['vid_title'];
      $video_amount=$row['video_amount'];
      */
    $commission=$row['commission'];
    }

    echo "Available Earnings - N";
echo $commission;

?>
</div>
             <table class="table" width="100%">
   

 <tr class="theader"><td>S/No</td><td>User</td><td>Amount</td><td>Date</td></tr>
<?php
$cnt=1;

////$query=mysqli_query($db,"SELECT * FROM tbl_vip_videos where views!='0' order by views desc limit 10    ");    

/// female

$query=mysqli_query($db,"SELECT * FROM tbl_commission WHERE refid='$userid'");   
while($row=mysqli_fetch_array($query))
  {
    /*$vid_title=$row['vid_title'];
      $video_amount=$row['video_amount'];
      */
    $amount=$row['amount'];
    $refid=$row['refid'];
    $uid=$row['userid'];
     $date=$row['date'];

     $q=mysqli_query($db,"SELECT * FROM tbl_users WHERE userid='$uid'");   
while($r=mysqli_fetch_array($q))
  {
    /*$vid_title=$row['vid_title'];
      $video_amount=$row['video_amount'];
      */
    $fname=$r['fname'];
    $lname=$r['lname'];

  }

     ?>
<tr><td><?php echo $cnt; ?></td><td><?php echo $fname; ?> <?php echo $lname; ?> - <?php echo $uid; ?></td><td><?php echo $amount; ?></td><td><?php echo $date; ?></td></tr>

     <?php

$cnt++;
}

?>


</table>
                         </div>


</div>





                </div>

              </div>


            </div>
          </div>
        </div>
<br clear="all">
</div>
