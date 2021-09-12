<?php
                $msg='';
                $stop='';
                $fname='';
                $lname='';
                $phone='';
                $email='';
                $password='';
                $ref='';
include("../inc/db.php"); 

if(isset($_POST['regnow'])){

$fname=mysqli_real_escape_string($db,$_POST['fname']);
$lname=mysqli_real_escape_string($db,$_POST['lname']);
$email=mysqli_real_escape_string($db,$_POST['email']);
$phone=mysqli_real_escape_string($db,$_POST['phone']);
$ct=mysqli_real_escape_string($db,$_POST['ct']);
$strpassword=mysqli_real_escape_string($db,$_POST['password']);

$ref=mysqli_real_escape_string($db,$_POST['ref']);

$password=md5($strpassword);

  if(!is_numeric($phone)) {
 $msg="<div class='uk-alert-danger fade in' uk-alert> Invalid Phone Number : Must be Numbers </div>";
 

}elseif($fname=='' || $lname==''||$email=='' || $strpassword==''|| $phone=='' ){
    $msg= "<div class='uk-alert-danger fade in' uk-alert> You have left a required field blank</div>";
  }else{



$sql2 = mysqli_query($db,"SELECT * FROM tbl_users where email='$email' OR phone='$phone'");
$nums2=mysqli_num_rows($sql2);


if($nums2!='0'){
  $rws = mysqli_fetch_array($sql2,MYSQLI_ASSOC); 
    
    if($email==($rws['email'])){
      $msg="<div class='uk-alert-danger fade in' uk-alert> Failed: Email - <b>".$email."</b>  already exists.</div>";
    }else{

       $msg="<div class='uk-alert-danger fade in' uk-alert> Failed: Phone - <b>".$phone."</b>  already exists.</div>"; 
    }
  

}else{


///// uncomment this to allow ip address checks
$useripaddress=$_SERVER['REMOTE_ADDR'];

$sq = mysqli_query($db,"SELECT * FROM tbl_users where useripaddress='$useripaddress' and activation_status='0'");
$nm=mysqli_num_rows($sq);
if($nm>'1'){

  $msg="<div class='uk-alert-danger fade in' uk-alert> We are unable to register you at this time. A profile registered with this device is yet to be verified.</div>"; 
 

}else{

$time=time();
$code=substr($time,0,5);
$md5code=md5($code);





           $sql3 = mysqli_query(
    $db,"INSERT into tbl_users set email='$email', password='$password',fname='$fname',lname='$lname', phone='$phone',useripaddress='$useripaddress',activation_status='1',ref='$ref',vipcode='$code',vippass='$md5code',vipstatus='1',vipmembership='basic',content_type='$ct'"); 


   

           if($sql3){        

            $msg="<div class='uk-alert-success fade in' uk-alert> Registration Successful.  <br> Please wait</div>";

 $stop=1;

/*
?><script type="text/javascript">window.location.replace("<?php echo URL_PATH; ?>?x=login");</script><?php
*/

////// ask if activation code shoule be sent 

$sql4 = mysqli_query($db,"SELECT * FROM tbl_users where email='$email' and password='$password'");
$rows = mysqli_fetch_array($sql4,MYSQLI_ASSOC); 

    
    $fname=$rows['fname'];
      $lname=$rows['lname'];
   $username=$rows['username'];
      $useremail=$rows['email'];
      $userid=$rows['userid'];
      $adminphone=$rows['phone'];
        $vipmembership=$rows['vipmembership'];





        $cookie_username = "username";

      $cookie_uservalue = $username;

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 


     

      $cookie_username = "membership";

      $cookie_uservalue = $vipmembership;

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 


       $cookie_username = "vippass";

      $cookie_uservalue = '123';

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 
          

           $cookie_username = "fname";

      $cookie_uservalue = $fname;

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 hour  

       $cookie_username = "lname";

      $cookie_uservalue = $lname;

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 hour  


  
   $cookie_username = "phone";

      $cookie_uservalue = $adminphone;

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 hour  




      $cookie_name = "useremail";
      $cookie_value = $useremail;

      setcookie($cookie_name,$cookie_value, time() + (3600*24*365)); // 3600 = 1 hour   



      $cookie_id = "userid";
      $cookie_idvalue = $userid;
      setcookie($cookie_id, $cookie_idvalue, time() + (3600*24*365)); // 3600 = 1 hour 
      

      /* we are no longer sending out SMS 

//Insert your API Parameters
$senderID ="ShufflesVIP";
$mobile = $adminphone;
$messageBody = "Your one-time VIP Pass on shufflestv.com/vip is ".$code."";
$url = "https://www.bulksmsnigeria.com/api/v1/sms/create";
$apiToken = SMS_TOKEN;

//Pass all Parameters into a array to be submitted to the SendViaPost function as a Single Variable
$arr_params = array(
    'from'    =>  $senderID,
    'to'      =>  $mobile,
    'body'    =>  $messageBody,
    'api_token' =>  $apiToken,
    'dnd'       =>  5
);


//Dispatch Message
sendViaPost($url,$arr_params);
sendViaPost($url,array(
    'from'    =>  $senderID,
    'to'      =>  $mobile,
    'body'    =>  $messageBody,
    'api_token' =>  $apiToken,
    'dnd'       =>  5
));

*/
include('register_email.php');
if($sendmail){
?>
<script type="text/javascript">

   setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>';
         }, 1000);
</script>
<?php
}
           }else{
    $msg="<div class='uk-alert-danger fade in' uk-alert> Registration Failed.  <br> Please try again later</div>";
}



}
}
}
}
?>
<html lang="en">
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <title>Register - ShufflesTV VIP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ShuffltesTV VIP content">
    <link rel="icon" href="assets/images/favicon.png">
    <!-- CSS 
    ================================================== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/night-mode.css">
    <link rel="stylesheet" href="assets/css/framework.css">

    <!-- icons
    ================================================== -->
    <link rel="stylesheet" href="assets/css/icons.css">
    <!-- Google font
    ================================================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
</head>
<body>
<!-- Content
    ================================================== -->
    <div uk-height-viewport="expand: true" class="uk-flex uk-flex-middle">
      
        <div class="uk-width-1-3@m uk-width-1-2@s m-auto">
            <div align="center" style="padding: 10px"> <img src="assets/images/logo-light.png" width="150px" height="auto" ></div>
            <div class="uk-card-default p-6 rounded" style="padding-top: 3px">
             

                <?php

echo $msg;

if($stop!='1'){
?>



                   <div class="my-4 uk-text-center" >
                   
                    <h2 class="mb-0">Create Account</h2><br>
                    <p class="my-2">If you already have an account on shufflesTV <br>kindly <a href='form-login.php' style="text-decoration: underline; color: red">SIGN IN </a> instead.</p>
                </div>
                <form class="uk-child-width-1-1 uk-grid-small" uk-grid method="POST" action="">

                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label"> First Name</label>

                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-user"></i>
                                </span>
                                <input class="uk-input" type="text" value="<?php echo $fname; ?>" placeholder="First name" name="fname" required>
                            </div>

                        </div>
                    </div>

                       <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Last Name</label>

                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-user"></i>
                                </span>
                                <input class="uk-input" type="text" value="<?php echo $lname; ?>"  placeholder="Last name" name="lname" required>
                            </div>

                        </div>
                    </div>


                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Phone</label>

                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-mail"></i>
                                </span>
                                <input class="uk-input" type="number" value="<?php echo $phone ; ?>"  placeholder="Valid Phone Number" name="phone" required>
                            </div>
<span>We would send your passcode to this number </span>
                        </div>
                    </div>
 <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Email</label>

                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-mail"></i>
                                </span>
                                <input class="uk-input" type="email" value="<?php echo $email; ?>"  placeholder="name@example.com" name="email" required>
                            </div>

                        </div>
                    </div>

                  
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Password</label>

                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-lock"></i>
                                </span>
                                <input class="uk-input" type="password" placeholder="********" name="password" required>
                            </div>

                        </div>

                               <div class="uk-form-group">
                            <label class="uk-form-label"> Referral ID (Optional)</label>
<?php 
if(isset($_GET['ref'])){$ref=$_GET['ref'];}else{$ref='';}
?>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-user"></i>
                                </span>
                                <input class="uk-input" type="text" placeholder="Referral ID " name="ref" value="<?php echo $ref; ?>">
                            </div>

                        </div>
                        
                              <label class="uk-form-label"> What content would you like to receive notification on?</label>

                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-house"></i>
                                </span>
                             <select type="text"  class="uk-input" id="bank" name='ct' required>
                     
<option selected value="1">General Content</option>
<option value="2">Adult Content</option>
<option value="3">
All Content</option>


</select>
                            </div>
                   
                    <div><span><label><input type="checkbox" name="checkit" required> I agree to the <a href='terms.php' target="_blank" style="color: red"> terms and conditions </a> of using this service.</label></span></div>
                    <div>
                        <div class="mt-4 uk-flex-middle uk-grid-small" uk-grid>
                        
                            <div class="uk-width-auto@s">
                                <input type="submit" class="button warning" value="Get Started" name="regnow"></input>
                            </div>
                        </div>
                            <div class="uk-width-expand@s">
                                <p> Do you have account ? <a href="form-login.php" style="color:red">Sign in</a></p>
                            </div>
                    </div>
                </form>

       <?php
     }
     ?>
            </div>
        </div>
    </div>
    <script>
        (function (window, document, undefined) {
            'use strict';
            if (!('localStorage' in window)) return;
            var nightMode = localStorage.getItem('gmtNightMode');
            if (nightMode) {
                document.documentElement.className += ' night-mode';
            }
        })(window, document);


        (function (window, document, undefined) {

            'use strict';

            // Feature test
            if (!('localStorage' in window)) return;

            // Get our newly insert toggle
            var nightMode = document.querySelector('#night-mode');
            if (!nightMode) return;

            // When clicked, toggle night mode on or off
            nightMode.addEventListener('click', function (event) {
                event.preventDefault();
                document.documentElement.classList.toggle('night-mode');
                if (document.documentElement.classList.contains('night-mode')) {
                    localStorage.setItem('gmtNightMode', true);
                    return;
                }
                localStorage.removeItem('gmtNightMode');
            }, false);

        })(window, document);
    </script>

    <!-- javaScripts
            ================================================== -->
    <script src="assets/js/framework.js"></script>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/simplebar.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>