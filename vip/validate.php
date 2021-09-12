<!doctype html>
<html lang="en">
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>vix99 - Payment Confirmation</title>
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
<?php

             include("../inc/db.php"); 

             ?>
            <div class="uk-card-default p-6 rounded">

               <h3 class="txt3">Secure payment made on paystack</h3>


            <div style="padding: 10px">
<?php
if(!isset($_GET['reference'])){  
  die("Transaction reference not found");
}
//set reference to a variable @ref
$reference = $_GET['reference'];
$txref = $_GET['reference'];
$result = array();
//The parameter after verify/ is the transaction reference to be verified
$url = 'https://api.paystack.co/transaction/verify/'.$reference;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
  $ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer sk_live_182df3e51e359d66bd0e5878cd5c7d0437f266c7']
);
$request = curl_exec($ch);
curl_close($ch);

if ($request) {
    $result = json_decode($request, true);
    // print_r($result);
    if($result){
      if($result['data']){
        //something came in
        if($result['data']['status'] == 'success'){
          // the transaction was successful, you can deliver value
    
    
    
     // Give value
   $userid=$_COOKIE['userid']; 
   $txamount=substr($result['data']['amount'], 0, -2);
   $txemail=$result['data']['customer']['email'];
   
   $chk= mysqli_query($db,"SELECT *  from tbl_credit_record where txref='$txref'");
   $n=mysqli_num_rows($chk);
   if($n!='0'){
        echo "<h6>Transaction already exists.</h6>"; 
       ///// since the transaction exits redirect the person to the home page
        ?>
<script type="text/javascript">

   setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>';
         }, 500);
</script>
<?php
   }else{
       
  $sql= mysqli_query($db,"INSERT into tbl_credit_record set userid='$userid',trans_email='$txemail',trans_status='1',amount='$txamount',txref='$txref'");
if($sql){
    $commission=.1*$txamount; ////// 10% of amount as commission
     $addcredit= mysqli_query($db,"UPDATE tbl_users set credit= credit+'$txamount',first_subscription=first_subscription+'$commission' where email='$txemail' OR userid='$userid'"); 
   echo "<h5>Thank you for making a purchase. Your transaction is noted</h5>"; 
    if($addcredit){
       echo "<h6>Your wallet has been funded.<br></h6>"; 
      
              ?>
<script type="text/javascript">

   setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>';
         }, 1000);
</script>
<?php
    }


  }else{
     echo "<h6>We are unable to record this transaction. <br>Kindly contact admin via info@shufflestv.com</h6>";  
  }  

}

/// give value ends here



        }else{
          // the transaction was not successful, do not deliver value'
          // print_r($result);  //uncomment this line to inspect the result, to check why it failed.
          echo "Transaction was not successful: Last gateway response was: ".$result['data']['gateway_response'];
        }
      }else{
        echo $result['message'];
      }

    }else{
      //print_r($result);
      die("Something went wrong while trying to convert the request variable to json. Uncomment the print_r command to see what is in the result variable.");
    }
  }else{
    //var_dump($request);
    die("Something went wrong while executing curl. Uncomment the var_dump line above this line to see what the issue is. Please check your CURL command to make sure everything is ok");
  }
?>


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