<?php

             include("../inc/db.php"); 
$msg='';
if(isset($_POST['lognow'])){

$username=mysqli_real_escape_string($db,$_POST['username']);
$password=mysqli_real_escape_string($db,$_POST['password']);

$password=md5($password);

if($username=='' || $password==''){
    $msg= "<div class='uk-alert-danger fade in' uk-alert> You have left a required field blank</div>";
  }else{



$sql2 = mysqli_query($db,"SELECT * FROM tbl_users where (email='$username' OR phone='$username') and password='$password'");
$nums2=mysqli_num_rows($sql2);


if($nums2=='0'){
$msg= "<div class='uk-alert-danger fade in' uk-alert> Invalid Email/Phone or Password Combination </div>";
  }else{


$rows = mysqli_fetch_array($sql2,MYSQLI_ASSOC); 

    
    $fname=$rows['fname'];
      $lname=$rows['lname'];
  $username=$rows['username'];
      $useremail=$rows['email'];
      $userid=$rows['userid'];
      $adminphone=$rows['phone'];
      $vipstatus=$rows['vipstatus'];
        $vipmembership=$rows['vipmembership'];

        if($vipmembership==''){
          $time=time();
$code=substr($time,0,5);
$md5code=md5($code);

$vipmembership='basic';
$sql3 = mysqli_query(
    $db,"UPDATE tbl_users set vipcode='$code',vippass='$md5code',vipstatus='1',vipmembership='$vipmembership' WHERE userid='$userid'"); 
        }

////if($vipstatus=='1'){
        //// allow everyone with valid login access to the website
       $cookie_username = "vippass";

      $cookie_uservalue = '123';

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 


        $cookie_username = "username";

      $cookie_uservalue = $username;

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 




      $cookie_username = "membership";

      $cookie_uservalue = $vipmembership;

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 hour   
      
      
$msg= "<div class='uk-alert-success fade in' uk-alert> Login Successful <br> Redirecting ... <br> Please wait.</div>";
//////}else{


/*

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


////$msg= "<div class='uk-alert-success fade in' uk-alert> Login Successful <br> Please wait ... <br> You need to choose a VIP membership</div>";
////}

          

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


?>
<script type="text/javascript">

   setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>';
         }, 500);
</script>
<?php


  }

}

} 
?>
<html lang="en">
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>vix99 - Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="vix99 is a collection of curated content strictly for entertainment">
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

            <div class="uk-card-default p-6 rounded">
                <div class="my-4 uk-text-center">
                    <h2 class="mb-0"> Welcome back</h2>
                    <p class="my-2">Login to manage your account.</p>
                </div>

                <?php echo $msg; ?>
                <form method="POST" action="">

                    <div class="uk-form-group">
                        <label class="uk-form-label"> Email / Phone </label>

                        <div class="uk-position-relative w-100">
                            <span class="uk-form-icon">
                                <i class="icon-feather-mail"></i>
                            </span>
                            <input class="uk-input" type="text" placeholder="email or phone number " name="username">
                        </div>

                    </div>

                    <div class="uk-form-group">
                        <label class="uk-form-label"> Password</label>

                        <div class="uk-position-relative w-100">
                            <span class="uk-form-icon">
                                <i class="icon-feather-lock"></i>
                            </span>
                            <input class="uk-input" type="password" placeholder="********" name="password">
                        </div>

                    </div>

           

                    <div class="mt-4 uk-flex-middle uk-grid-small" uk-grid>
                        <div class="uk-width-expand@s">
                            <p> Dont have account <a href="form-register.php" style="color:red">Sign up</a></p>
                        </div>
                        <div class="uk-width-auto@s">
                            <button type="submit" class="button warning" name="lognow">Enter</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>



    <!-- For Night mode -->
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