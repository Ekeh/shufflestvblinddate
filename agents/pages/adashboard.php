<section id="service" class="section-padding" style="min-height: 300px">
    <div class="container">
    	  <div class="row" >
    	  	<div class="col-md-12 col-sm-4 section-padding" >
    	  		<div style="font-size: 25px; padding: 10px; ">Welcome <?php echo $_COOKIE['agents_fname']; ?>, </div> 
<div style="padding: 10px;" >
Kindly input the name and phone number of the people you invited to register
</div>

</div>  
</div>
	  <div class="row" >


<?php

$agentid=$_COOKIE['agents_id'];

///echo $agentid;
if(isset($_POST['submit'])){
 $name=mysqli_real_escape_string($db,$_POST['name']);
  $phone=mysqli_real_escape_string($db,$_POST['phone']);


 if($name=='' || $phone=='' ){
   echo '<div class="alert alert-block alert-danger fade in"> You have left a required field blank</div>';
  }elseif (!is_numeric($phone)) { 
 echo '<div class="alert alert-block alert-danger fade in"> Phone Number must be numeric</div>';
  }else{

  	$phonecut = ltrim($phone, '0');

$sql2 = mysqli_query($db,"SELECT * FROM tbl_agenta where phone = '$phonecut'");
$nums2=mysqli_num_rows($sql2);

if($nums2!='0'){
    
     echo "<div class='alert alert-block alert-danger fade in'> A user with this phone number has already been invited.</div>";
    
  

}else{


$sql5 = mysqli_query($db,"INSERT into  tbl_agenta set phone = '$phonecut', name='$name',agentid='$agentid'");
if($sql5){
	     echo "<div class='alert alert-block alert-success fade in'>Successful</div>";
	     
	     ?>

<script type="text/javascript">window.location.replace("<?php echo SITE_MAIN; ?>agents/index.php?p=registrations");</script>

<?php
}
	else{
		     echo "<div class='alert alert-block alert-danger fade in'> We could not complete this task. Kindly try again later</div>";
	}

}
}
}
?>
<form method="post" action="" >
   <div class="col-md-4 col-sm-4">


   <div class="form-group">Name <br> <input type="text" class="form-control  br-radius-zero" name="name" value="<?php echo $name; ?>" style="border: solid 3px #080808; border-radius: 10px; padding: 15px" placeholder="Add Name" required></div> 
   
   <div class="form-group">Phone Number <br> <input type="text" class="form-control  br-radius-zero" name="phone" placeholder="Add Phone Number"   maxlength="11" value="<?php echo $phone; ?>" style="border: solid 3px #080808; border-radius: 10px; padding: 15px" required>e.g 08037676565</div> 

 <div class="form-action">
<input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg" style="width: 100%; padding: 15px" >
</div>
</div>

            </form>



    	  	</div></div></div></section>
