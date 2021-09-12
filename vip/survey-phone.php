<html lang="en">
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <title>Verification</title>
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

 <script type="text/javascript">
      var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '6Lcr6M0UAAAAAOXebvAlkDvOOM9JVpl4kD0a8Lpe'
        });
      };
    </script>

</head>
<body>
<!-- Content
    ================================================== -->

        <div class="main_content">

            <div class="" align="center">

                <!-- find channals -->
                <div class="" style="padding: 10px; max-width: 350px" align="center">

                  <?php
if(isset($_GET['state'])){
  $next=1;
}else{
    $next=''; 
    }      $ct='';$userid='';
     include("../inc/db.php"); 

     if(isset($_POST['vcode'])){


$mycode=mysqli_real_escape_string($db,$_POST['mycode']);
$userid=$_COOKIE['userid'];
$md5code=md5($mycode);
$chk = 
mysqli_query($db,"SELECT * from tbl_users where userid='$userid' and activation_code='$md5code'");
$num=mysqli_num_rows($chk);

if($num=='0'){
  echo "<div class='uk-alert uk-alert-danger'>Invalid Code - ".$mycode."</div>";
}else{
  $sql3 = 
mysqli_query($db,"UPDATE tbl_users set phone_activate='1' where userid='$userid'"); 

 if($sql3){
   
 echo "<div  class='uk-alert uk-alert-success'>Verification Successful.<br> You will be redirected, Please wait...</div>";

 ?>
<script type="text/javascript">

   setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>';
         }, 200);
</script>
<?php
   }else{
  echo "<div class='uk-alert uk-alert-danger'>Something went wrong.<br> Please try again later.</div>";
  $next=1;
   }
}


}


if(isset($_POST['vphone'])){


$phone=mysqli_real_escape_string($db,$_POST['phone']);


$userid=$_COOKIE['userid'];
$code = substr(md5(microtime()),rand(0,26),5);
$md5code=md5($code);


$sql3 = 
mysqli_query($db,"UPDATE tbl_users set activation_code='$md5code',activation_code_plain='$code' where userid='$userid'"); 

 if($sql3){
   
/////Send SMS
echo "<div class='uk-alert alert-danger'>Sending SMS please wait</div>";


   //Insert your API Parameters
$senderID ="ShufflesVIP";
$mobile = $phone;
$messageBody = "Your verification code is ".$code."";
$url = "https://www.bulksmsnigeria.com/api/v1/sms/create";
$apiToken = SMS_TOKEN;

//Pass all Parameters into a array to be submitted to the SendViaPost function as a Single Variable
$arr_params = array(
    'from'      =>  $senderID,
    'to'        =>  $mobile,
    'body'      =>  $messageBody,
    'api_token' =>  $apiToken,
    'dnd'       =>  3
);


//Dispatch Message
sendViaPost($url,$arr_params);
sendViaPost($url,array(
    'from'      =>  $senderID,
    'to'        =>  $mobile,
    'body'      =>  $messageBody,
    'api_token' =>  $apiToken,
    'dnd'       =>  3
));



 echo "<div  class='uk-alert uk-alert-success'>SMS sent to ".$phone."</div>";


////// end of sending SMS
   /*           ?> <script> alert ("SMS sent to <?php echo $phone; ?>");</script> <?php  */
 ?>
<script type="text/javascript">

   setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>/survey-phone.php?state=1';
         }, 2000);
</script>
<?php
$next=1;
                      
                }else{
                  echo  "<div class='uk-alert-danger  uk-alert'> failed <br> An error occured, Kindly try again later</div>";
             
                }
}

?>
           


                 <h1> Update Preference</h1>
   



      <?php
      if($next=='1'){?>
<form  method="POST" action=""  enctype="multipart/form-data">
<div class="" align="left">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> Verification Code</h3>
            </div>    
                       <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Kindly input Verification Code sent to your phone.<br><div style="color: red">Code may take a few minutes, please wait.<br> If it doesn't come please call +2348024601335 for assistance</div></label>
<br><br>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-phone"></i>
                                </span>                 

                             <!-- Add two inputs for "phoneNumber" and "code" -->
                             <label>Verification Code <br>
        <input type="text" id="phoneNumber" class="uk-input" id="bank" name='mycode' value="" required/>
      </label>
</div>
     
 <!-- this is the recaptcha -->
<div id="html_element"></div>


                        </div>
                    </div>

                  

              <div class="box-footer"> 
     
        </button> <br>
                <button type="submit"  class="uk-input button success" name="vcode" style="background-color: red">Submit</button>
              </div>
        
          </div>
        </div>
          </div>
        </div>
   </form>



      <?php }
        else{ ?>
<form  method="POST" action=""  enctype="multipart/form-data">
<div class="" align="left">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Phone Verification</h3>
            </div>    
                       <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Kindly confirm the phone number you would be using on the platform. Verification Code would be sent there.</label>
<br><br>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-phone"></i>
                                </span>
       <?php                
 $userid=$_COOKIE['userid'];       
$s=mysqli_query($db,"SELECT * from tbl_users where userid='$userid' "); 
 while($rw=mysqli_fetch_array($s))
  {

$myphone= $rw['phone'];



}

 ?>                  

                             <!-- Add two inputs for "phoneNumber" and "code" -->
                             <label>Phone Number <br>
        <input type="tel" id="phoneNumber" class="uk-input" id="bank" name='phone' value="<?php echo $myphone; ?>" required/>
      </label>
</div>
     
   <!-- this is the recaptcha -->
<div id="html_element"></div>


   

                        </div>
                    </div>

                  

              <div class="box-footer"> 
     
        </button> <br>
                <button type="submit"  class="uk-input button success" name="vphone" style="background-color: red">Verify Phone</button>
              </div>
        
          </div>
        </div>
          </div>
        </div>
   </form>

      <?php } ?>
          <!-- /.box -->



     <!-- Add a container for reCaptcha -->
       <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>

                    </div>
 <br><br>
  
                

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