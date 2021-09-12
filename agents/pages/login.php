<section id="service" class="section-padding" style="min-height: 300px;">
    <div class="container">
    	  <div class="row">
    	  	<div class="col-md-12 col-sm-4 section-padding" align="center">
    	  		<div class="section-padding" align="left" style="color: #ffffff; width:300px;">
    	  		    
    	  		    <div align='center' style='padding:10px'><img src='img/logo.png' width='80px' height='80px'></div>
            <?php

if(isset($_POST['submit'])){

 $email=mysqli_real_escape_string($db,$_POST['email']);
  $password=mysqli_real_escape_string($db,$_POST['password']);

$pwd=md5($password);
 if($email=='' || $password=='' ){
   echo '<div class="alert alert-block alert-danger fade in"> You have left a required field blank</div>';
  }else{
$sql2 = mysqli_query($db,"SELECT * FROM tbl_users where email='$email' and password='$pwd'");
$nums2=mysqli_num_rows($sql2);

if($nums2=='0'){
    
     echo "<div class='alert alert-block alert-danger fade in'> Invalid login details. Kindly register on <a href='https://campoutnaija.com/memberarea'> https://campoutnaija.com/memberarea </a> to get started.</div>";
    
  

}else{



$sql4 = mysqli_query($db,"SELECT * FROM tbl_users where email='$email' and password='$pwd'");
$rows = mysqli_fetch_array($sql4,MYSQLI_ASSOC); 
   $fname=$rows['fname'];
      $lname=$rows['lname'];

      $useremail=$rows['email'];
      $userid=$rows['userid'];
      $adminphone=$rows['phone'];

          

         


           echo "<div class='alert alert-block alert-success fade in'> Welcome ".$fname."!</div>";
  $cookie_username = "agents_fname";
      $cookie_uservalue = $fname;

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 hour  

       $cookie_username = "agents_lname";

      $cookie_uservalue = $lname;

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 hour  


  
   $cookie_username = "agents_phone";

      $cookie_uservalue = $adminphone;

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 hour  

  

  $username=$fname." ".$lname;


        $cookie_username = "agents_username";

      $cookie_uservalue = $username;

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 hour   


      $cookie_name = "agents_email";
      $cookie_value = $useremail;

      setcookie($cookie_name,$cookie_value, time() + (3600*24*365)); // 3600 = 1 hour   



      $cookie_id = "agents_id";
      
      $cookie_idvalue = $userid;

      setcookie($cookie_id, $cookie_idvalue, time() + (3600*24*365)); // 3600 = 1 hour 


?>

<script type="text/javascript">window.location.replace("<?php echo SITE_MAIN; ?>/agents");</script>
<?php 
   }
}

}


            ?>


	<h3 style="color: #ffffff">Kindly login to continue</h3>
	<b style="color:#cccccc;"><i>N.B: Login using the same details you used to register on Campoutnaija, 9jagifted or any of the shufflesTV channels</i></b> <br><br>
            <form method="post" action="" >

   <div class="form-group">Email <br> <input type="text" class="form-control  br-radius-zero" name="email" value="<?php echo $email; ?>" style="border: solid 3px #080808; border-radius: 10px; padding: 15px" placeholder="Your Email Address" required></div> <br>
   <div class="form-group">Password <br> <input type="password" class="form-control  br-radius-zero" name="password" value="<?php echo $password; ?>" style="border: solid 3px #080808; border-radius: 10px; padding: 15px" required></div> <br>
 <div class="form-action">
<input type="submit" name="submit" value="login" class="btn btn-primary btn-lg" style="width: 100%;" >
</div>

            </form>
        </div>
      

  
        </div>
        </div></section>