<section id="service" class="section-padding" style="min-height: 300px">
    <div class="container">
    	  <div class="row" >

    	  		<div class="col-md-12 col-sm-4 section-padding" >
<div style="font-size: 25px;">Your registrations </div> <br> N.B: Only valid registrations from 05/11/2019 will be displayed as <b>Approved</b><br>


 <?php
 $agentid=$_COOKIE['agents_id'];
 $query=mysqli_query($db,"SELECT * FROM tbl_agenta where agentid='$agentid' "); 
 $nums2=mysqli_num_rows($query);
 if($nums2=='0'){
?><div class='alert alert-block alert-danger fade in'> No result found</div><?php
      }else{
?>
<div align="" style="padding: 15px"><?php  echo $nums2 ?> Entries found</div><br>
<table style="width: 100%">
<tr style="background-color: #000000;"><td>S/No</td><td>Name</td><td>Phone</td><td>Status</td><td>Entry Date</td></tr>
<?php

$query=mysqli_query($db,"SELECT * FROM tbl_agenta  where agentid='$agentid'  order by id desc"); 
$cnt=1;
while($row=mysqli_fetch_array($query))
  {
  $name=$row['name'];
      $agentphone=$row['phone'];
       $entry_date=$row['entry_date'];

       $chk=mysqli_query($db,"SELECT * FROM tbl_users  where phone like '%".$agentphone."%' and activation_status='1' and userid > '10095'"); 
       $n=mysqli_num_rows($chk);
       if($n!=0){$status="<i class='fa fa-thumbs-up' style='color:green'></i> Approved ";}else{$status="<i class='fa fa-thumbs-down' style='color:red'></i>  Unapproved";}
?>
<tr><td><?php echo $cnt; ?></td><td><?php echo $name; ?></td><td><?php echo $agentphone; ?></td><td> <?php echo $status; ?></i></td><td><?php echo $entry_date; ?></td></tr>
<?php

$cnt++;
}

?>

</table>
<?php } ?>

    </div></div></section>