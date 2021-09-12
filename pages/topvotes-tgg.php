<div class="main-panel" >
        <div class="content-wrapper">
          <div class="row ">
            <div class="col-lg-12">
<h3> Top 20 Votes</h3>
      <br clear="all">

<div class="row">
            <div class="col-lg-12">

              <div class="card px-3" >
                <div class="card-body" >
                
       
                        <div align='center'>
                         
<div style="color:yellow; padding: 10px;">Only Content in "The Good Gals" are counted here</div>
<div style="color:yellow; padding: 10px;">Top 10 Female</div>
<br>

<?php
  $tot=mysqli_query($db,"SELECT  SUM(views) AS sumtviews,vplace FROM tbl_vip_videos WHERE xrating='8' ");   
      while($row=mysqli_fetch_array($tot))
  {
$total= $row['sumtviews']; 
  }

///echo $total;
///echo " Views <br>";
?>
             <table class="table" width="100%">
   
<tr><td colspan="4">Female</td></tr>
 <tr class="theader"><td>S/No</td><td>Name</td><td>Referral ID</td><td>Total Votes</td></tr>
<?php
$cnt=1;

////$query=mysqli_query($db,"SELECT * FROM tbl_vip_videos where views!='0' order by views desc limit 10    ");    

/// female

$query=mysqli_query($db,"SELECT  SUM(views) AS sumviews,actor_id,vplace,fname,lname,phone,gender  FROM tbl_vip_videos 
INNER JOIN tbl_users ON  tbl_vip_videos.actor_id=tbl_users.userid  
WHERE views>0 and xrating='8' and gender='female'
GROUP BY actor_id 
ORDER BY SUM(views) DESC 
limit 10");   
      while($row=mysqli_fetch_array($query))
  {
    /*$vid_title=$row['vid_title'];
      $video_amount=$row['video_amount'];
      */
    $actor_id=$row['actor_id'];
    $sum=$row['sumviews'];
    $fname=$row['fname'];
    $lname=$row['lname'];
   
     $phone=$row['phone'];


    //// this will call the views in percentage
    if($total!='0'){
    $percentage=round((($sum/$total)*100));
  }else{
    $percentage=0;
  }
     ?>
<tr><td><?php echo $cnt; ?></td><td><?php echo $fname; ?> <?php echo $lname; ?></td><td><?php echo $actor_id; ?></td><td><?php echo $percentage; ?> % </td></tr>

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
