<div class="main-panel" >
        <div class="content-wrapper">
          <div class="row ">
            <div class="col-lg-12">
<h3> Top Referrals</h3>
      <br clear="all">

<div class="row">
            <div class="col-lg-12">

              <div class="card px-3" >
                <div class="card-body" >
                
       
                        <div align='center'>
                         
<!--<div style="color:yellow; padding: 10px;">Only Content in Roomies Section are counted here</div>-->
<div style="color:yellow; padding: 10px;">Top 3 Female and Top 2 Male get automatic tickets</div>
<br>

<?php
  $tot=mysqli_query($db,"SELECT  SUM(views) AS sumtviews,vplace FROM tbl_vip_videos WHERE xrating='7' ");   
      while($row=mysqli_fetch_array($tot))
  {
$total= $row['sumtviews']; 
  }

///echo $total;
///echo " Views <br>";
?>
             <table class="table" width="100%">
   
<tr><td colspan="4">Female</td></tr>
 <tr class="theader"><td>S/No</td><td>Name</td><td>Referral ID</td><!--<td>Total Votes</td>--></tr>
<?php
$cnt=1;



$query=mysqli_query($db,"SELECT * FROM tbl_users where gender='female' and commission!='0'  order by commission desc limit 10    ");  
      while($row=mysqli_fetch_array($query))
  {
 

    $fname=$row['fname'];
    $lname=$row['lname'];
   
     $userid=$row['userid'];



     ?>
<tr><td><?php echo $cnt; ?></td><td><?php echo $fname; ?> <?php echo $lname; ?></td><td><?php echo $userid; ?></td><!--<td><?php echo $percentage; ?> % </td>--></tr>

     <?php

$cnt++;
}

?>

<tr><td colspan="4">Male</td></tr>
 <tr class="theader"><td>S/No</td><td>Name</td><td>Referral ID</td><!--<td>Total Votes</td>--></tr>


<?php

/// male
$cnt=1;
$query=mysqli_query($db,"SELECT * FROM tbl_users where gender='male' and commission!='0'   order by commission desc limit 10    ");  
      while($row=mysqli_fetch_array($query))
  {
   

    $fname=$row['fname'];
    $lname=$row['lname'];
   
     $userid=$row['userid'];


     ?>
<tr><td><?php echo $cnt; ?></td><td><?php echo $fname; ?> <?php echo $lname; ?></td><td><?php echo $userid; ?></td><!--<td><?php echo $percentage; ?> % </td>--></tr>

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
