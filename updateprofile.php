<?php
 include("inc/db.php");
//// this 2 lines introduces the twilio code 
/////require_once("vendor/autoload.php");
////use Twilio\Rest\Client;
//////
 $msg='';
 if(!isset($_COOKIE['userid'])){
  ?>
<script type="text/javascript">
  alert('You must login to access this page');
  window.location.replace("<?php echo SITE_MAIN; ?>login.php");</script>

  <?php
  exit;
 }

$userid=$_COOKIE['userid'];
if(isset($_POST['updatenow'])){

 $strfname=mysqli_real_escape_string($db,$_POST['fname']);
$strlname=mysqli_real_escape_string($db,$_POST['lname']);
$stremail=mysqli_real_escape_string($db,$_POST['email']);
$phone=mysqli_real_escape_string($db,$_POST['phone']);
 $gender=mysqli_real_escape_string($db,$_POST['gender']);
  $profile=mysqli_real_escape_string($db,$_POST['profile']);
    $username=mysqli_real_escape_string($db,$_POST['username']);
$phone = ltrim($phone, '0');
///$strphone="+".$countryCode.$phone;
$strphone=$phone;
$description = mysqli_real_escape_string($db,$_POST['description']);

$error=0;


if($strfname=='' || $strlname==''||$stremail=='' || $gender=='' ){
    $msg= '<div class="alert alert-block alert-danger fade in"> You have left a required field blank</div>';
    $error++;
  }else{
$sql2 = mysqli_query($db,"SELECT * FROM tbl_users where (email='$stremail' OR phone='$strphone') and userid!='$userid'");
$nums2=mysqli_num_rows($sql2);


if($nums2!='0'){
$msg="<div class='alert alert-block alert-danger fade in'> Failed: Phone - <b>".$strphone." or Email  - <b>".$stremail."</b>  already exists for another user.</div>";
$error++;
}else{



 
 $image=$_FILES["photo"]["name"];
if($error=='0'){

if($image!=''){
//////manage image upload here
$target_dir = "uploads/profile/";
$target_file = $target_dir . basename($_FILES["photo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check file size
if ($_FILES["photo"]["size"] > 3000000) {
  $msg= "<div class='alert-danger alert'>File must be smaller than 3MB.</div>";
  $uploadOk = 0;
  $error=1;
}

// Allow certain file formats
elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $msg= "<div class='alert-danger alert'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
  $uploadOk = 0;
  $error=1;
} else {
    $imagename=$phone.".png";
    $filename=$target_dir .$imagename;
  if (move_uploaded_file($_FILES["photo"]["tmp_name"], $filename)) {
    $msg= "<div class='alert-success alert'>The file ". $imagename. " has been uploaded.</div>";
  } else {
     $msg= "<div class='alert-danger alert'>Sorry, there was an error uploading your file.</div>";
      $uploadOk = 0;
      $error=1;
  }
}

}
}

if($error=='0'){

  if($image==''){

           $sql3 = mysqli_query(
    $db,"UPDATE tbl_users set email='$stremail',fname='$strfname',lname='$strlname', phone='$strphone',gender='$gender',profile_type='" . PROFILE_FREE . "',username='$username', description = '$description' where userid='$userid'");
  }else{
           $sql3 = mysqli_query(
    $db,"UPDATE tbl_users set email='$stremail',fname='$strfname',lname='$strlname', phone='$strphone',gender='$gender',profile_type='" . PROFILE_FREE . "',username='$username',photo='$imagename', description = '$description' where userid='$userid'");
  }






           if($sql3){
/*
?><script type="text/javascript">window.location.replace("<?php echo URL_PATH; ?>?x=login");</script><?php
*/

////// ask if activation code shoule be sent 



       $msg= "Update Succesful";
          

           $cookie_username = "fname";

      $cookie_uservalue = $strfname;

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 hour  

       $cookie_username = "lname";

      $cookie_uservalue = $strlname;

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 hour  


  
   $cookie_username = "phone";

      $cookie_uservalue = $strphone;

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 hour  

  

  $username=$strfname." ".$strlname;


        $cookie_username = "username";

      $cookie_uservalue = $username;

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 hour   


      $cookie_name = "useremail";
      $cookie_value = $stremail;

      setcookie($cookie_name,$cookie_value, time() + (3600*24*365)); // 3600 = 1 hour   



      $cookie_id = "userid";
      
      $cookie_idvalue = $userid;

      setcookie($cookie_id, $cookie_idvalue, time() + (3600*24*365)); // 3600 = 1 hour 
?><script type="text/javascript">

  window.location.replace("<?php echo SITE_MAIN; ?>");</script><?php


}

}
        }
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Update Profile  - ShufflesTV</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


<style type="text/css">
  body {
    color: #fff;
    background: #ffffff;
    background-image:url("images/bg.jpg");
    background-size: cover;
  
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
    border: 3px solid #ececec;
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
   <?php  
?>    <form action="#" method="post" enctype="multipart/form-data">
    <div class="avatar">
      <img src="images/lock.png" alt="Logo">
    </div>
       
<?php
$userid=$_COOKIE['userid'];
$sql4 = mysqli_query($db,"SELECT * FROM tbl_users where userid='$userid'");
$rows = mysqli_fetch_array($sql4,MYSQLI_ASSOC); 

    
      $fname=$rows['fname'];
      $lname=$rows['lname'];

      $email=$rows['email'];

      $phone=$rows['phone'];
       $gender=$rows['gender'];
  $profile=$rows['profile_type'];
       $photo=$rows['photo'];
  $username=$rows['username'];
$description= empty($description)? $rows['description'] : $description;

      ?>

          <div class="form-group" align="center" style="padding:4px; margin-top: 20px">
<!--
<img src="images/icon.png" width="120px" height="auto">-->


 <h4 class="text-center"> Update Profile</h4> 
         </div>

          <?php if($msg!=''){ ?> <div class="msg"><?php echo $msg; ?></div>    <?php } ?>
        
      
                      <div class="form-group">
                   <label for="uname">First Name</label>
          <input type="text" class="form-control" name="fname" placeholder="First Name" required="required" 
          value="<?php echo $fname; ?>" >
        </div>
          <div class="form-group">
             <label for="uname">Last Name</label>
          <input type="text" class="form-control" name="lname" placeholder="Last Name" required="required" value="<?php echo $lname; ?>">
        </div>
             <div class="form-group">
             <label for="uname">Username</label>
          <input type="text" class="form-control" name="username" placeholder="User Name" required="required" value="<?php echo $username; ?>">
        </div>
          <div class="form-group">
             <label for="uname">Email Address</label>
          <input type="email" class="form-control" name="email" placeholder="Email Address" required="required" value="<?php echo $email; ?>">
        </div>
        <div class="form-group">
             <label for="uname">Phone Number</label>
             <br clear="all">
            
              <input name="phone" type="text" placeholder="Phone Number" required="required" value="<?php echo $phone; ?>" class="form-control"    >
<br clear="all">
    
        </div>
         <div class="form-group">
       <label for="uname">Gender</label>
       <select  class="form-control"  name="gender" required>
        <?php if($gender!=''){ ?>
<option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
        <?php } ?>
        <option value=""><-- Choose Gender --></option>
         <option value="male">Male</option>
         <option value="female">Female</option>
       </select>
        
        </div>  
      <!--  <div class="form-group">
<label for="profile">Profile Type</label>
                  <select name="profile" id="profile" class="form-control" required>
                    <option value="">- Choose One -</option>
                      <?php /*if($profile!=''){ */?>
<option value="<?php /*echo $profile; */?>" selected><?php /*echo $profile; */?></option>
        <?php /*} */?>
                    <option value="1">Public</option>
                    <option value="0">Private</option>
                  </select>
                  <div style="font-size: 10px;"> If your profile type is <b>Public</b>, your photo will be displayed in the general gallery</div>
        </div>
-->
        <div class="form-group">
            <label for="description">Description</label>
            <br clear="all">

            <textarea name="description" id="description" type="text" maxlength="200" class="form-control" placeholder="Describe yourself and ideal date." required="required"><?=$description; ?></textarea>
            <div style="font-size: 10px;">Describe yourself and the kind of person you will like to date.</div>

        </div>

    <div class="form-group">
<label for="photo"> Upload Photo</label>
                  <input type="file" id="photo" name="photo" class="form-control" >
                  
                    <?php if($photo!=''){ ?><br>
<img src="uploads/profile/<?php echo $photo; ?>" style='width: 100px; height: 150px; object-fit: cover'>
        <?php } ?>
    </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-lg btn-block" name="updatenow" value="Update Profile">
        </div>
   <a href='index.php'>Skip for Now </a>
    </form>


   
</div>
</body>
</html>   

