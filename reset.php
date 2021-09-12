 <?php 
 include("inc/db.php");
 
if(isset($_POST['enter'])){
  $stremail=mysqli_real_escape_string($db,$_POST['username']);


  if($stremail==''){
    echo '<div class="alert alert-block alert-danger fade in"> You have left a required field blank</div>';
  }else{



$sql2 = mysqli_query($db,"SELECT * FROM tbl_users where email='$stremail' or phone='$stremail'");

$nums2=mysqli_num_rows($sql2);
      if($nums2=='0'){

           $msg="<b>Failed</b><br> Email / Phone  - ".$stremail."  does not exist.";
            }
            else
            { 
            $msg= "<b>Failed</b><br>Password does not match email provided";




      $rows = mysqli_fetch_array($sql2,MYSQLI_ASSOC); 

    
      $astat=$rows['activation_status'];
       $fname=$rows['fname'];
         $lname=$rows['lname'];
          $userphone=$rows['phone'];
      $useremail=$rows['email'];
      $userid=$rows['userid'];
      
      $time=md5(time());
      $code=substr($time,0,5);
      $pwd=md5($code);
      
      $sql2 = mysqli_query($db,"UPDATE tbl_users set password='$pwd' where userid='$userid' ");
      
      include('reset_email.php');
      
//// send reset password to email

     


?>
<script type="text/javascript">alert("We have sent a reset password to your email address");</script><?php
          $redirectnow=$_COOKIE['redirectnow'];
      if($redirectnow!=''){
?>
<script type="text/javascript">window.location.replace("<?php echo $redirectnow; ?>");</script><?php
      }elseif($vuser!='' && $_COOKIE['channel']!=''){
?><script type="text/javascript">window.location.replace("<?php echo SITE_MAIN; ?>channel/memberarea/?p=allvideos&v=<?php echo $vuser; ?>");</script><?php
      }elseif($_COOKIE['channel']!=''){
?><script type="text/javascript">window.location.replace("<?php echo SITE_MAIN; ?>channel/memberarea/");</script><?php
}
else{
    ?><script type="text/javascript">window.location.replace("<?php echo SITE_MAIN; ?>login.php");</script><?php
}

 }
}

}

?><!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login - <?php echo SITE_TITLE; ?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
	body {
		color: #fff;
		background: #000000;
		background-image:url("images/bg.jpg");
		background-size: cover;
		background-repeat: no-repeat;
	}
	.form-control {
        min-height: 41px;
		background: #fff;
		box-shadow: none !important;
		border-color: #e3e3e3;
	}
	.form-control:focus {
		border-color: #70c5c0;
	}
    .form-control, .btn {        
        border-radius: 2px;
    }
	.login-form {
		width: 350px;
		margin: 0 auto;
		padding: 100px 0 30px;		
	}
	.login-form form {
		color: #7a7a7a;
		border-radius: 2px;
    	margin-bottom: 15px;
        font-size: 13px;
        background: #ececec;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;	
        position: relative;	
    }
	.login-form h2 {
		font-size: 22px;
        margin: 35px 0 25px;
    }
	.login-form .avatar {
		position: absolute;
		margin: 0 auto;
		left: 0;
		right: 0;
		top: -50px;
		width: 95px;
		height: 95px;
		border-radius: 50%;
		z-index: 9;
		background: #ffffff;
		padding: 15px;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
	}
	.login-form .avatar img {
		width: 100%;
	}	
    .login-form input[type="checkbox"] {
        margin-top: 2px;
    }
    .login-form .btn {        
        font-size: 16px;
        font-weight: bold;
		background: #70c5c0;
		border: none;
		margin-bottom: 20px;
    }
	.login-form .btn:hover, .login-form .btn:focus {
		background: #50b8b3;
        outline: none !important;
	}    
	.login-form a {
		color: #fff;
		text-decoration: underline;
	}
	.login-form a:hover {
		text-decoration: none;
	}
	.login-form form a {
		color: #7a7a7a;
		text-decoration: none;
	}
	.login-form form a:hover {
		text-decoration: underline;
	}

	.msg {
		padding: 10px;
		
		color: red;
		text-align: center;
	}
</style>
</head>
<body>
<div class="login-form">
    <form action="#" method="post">
		<div class="avatar">
			<img src="images/lock.png" alt="Logo">
		</div>
  
        <h2 class="text-center"> Reset Password</h2>  
        <?php if($msg!=''){ ?> <div class="msg"><?php echo $msg; ?></div>    <?php } ?>
     
        <div class="form-group">
          <label>Email Address / Phone Number</label>
        	<input type="text" class="form-control" name="username" placeholder="Email  / Phone" required="required">
        </div>

   
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-lg btn-block" name="enter" value="Submit">
        </div>
		<div class="clearfix">
       
         <br>
            <label class="pull-left"><a href='register.php' >Not registered ? Register </a></label><br>
            <a href="login.php"" class="pull-right">Login ?</a>
        </div>
   
   

 </form>
</div>
</body>
</html>                            