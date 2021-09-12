<!doctype html>
<html lang="en">
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>TruefansOnline - Welcome</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="vix99 premium video content hosted on ShufflesTV">
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
<body onload="gmtNightMode()">
<?php
$msg='';
/* 
///// taking all this off because we no longer require payment before entry

if(isset($_POST['basic'])){
    $userid=$_POST['userid'];
    $amounts='1000';
?>
<div align="center" style="padding:20px; padding-top: 60px;color:white;"><div style="max-width: 300px"> <img src="assets/images/logo-light.png" ><br>
<?php
if($userid==''){
echo "<div class='uk-alert-danger fade in' uk-alert>Invalid User...<br> Kindly login to access the portal</div>";
?><h3><a href='form-login.php' class="button danger">Click here to login</a></h3><?php
}
else{    
?>
You have chosen Basic Membership. We will now check if you have N<?php echo $amounts; ?> in your wallet. If not, you would be redirected to paystack.

<br>........<br>

<?php 
$sql2 = mysqli_query($db,"SELECT * FROM tbl_users where  userid='$userid'");
$rows = mysqli_fetch_array($sql2,MYSQLI_ASSOC); 
 
    $credit=$rows['credit'];

    if($credit<$amounts){ echo "<div style='color:red' >You have insufficient funds in your wallet <br> You will be redirected to paystack to make payment. <br> Please wait ...</div>";




    $time=md5(time());
$cartid=substr($time,0,10);
////// add 00 in the amount before sending to paystack
  $amount='100000';  


  ////echo $cartid;
 
  $email=$_COOKIE['useremail']; 

    $userid=$_COOKIE['userid']; 

$curl = curl_init();
 //the amount in kobo. This value is actually NGN 300

// url to go to after payment
$callback_url = 'https://shufflestv.com/vip/index.php?p=callback';  



curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount,
    'email'=>$email,
    'callback_url' => $callback_url
  ]),
  CURLOPT_HTTPHEADER => [ 
    "authorization: Bearer sk_live_182df3e51e359d66bd0e5878cd5c7d0437f266c7", //replace this with your own test key
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));
$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
  
  // there was an error contacting the Paystack API
 die('Curl returned error: ' . $err);
}

$tranx = json_decode($response, true);

if(!$tranx->status){
  // there was an error from the API
  //// no need to return this information for now 
  ///print_r('API returned error: ' . $tranx['message']);
}

// comment out this line if you want to redirect the user to the payment page
////print_r($tranx);

///echo "<br>";
///echo "<hr>";
$redirect= $tranx['data']['authorization_url'];
// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page
///header('Location: '.$redirect);
///echo $response;
///echo "check here";
?>
<script type="text/javascript">window.open("<?php echo $redirect; ?>" ,"_top");</script>


 <?php
  }else{ //// deduct and send SMS  
$code = substr(md5(microtime()),rand(0,26),5);
$md5code=md5($code);
$adminphone=$_COOKIE['phone'];


echo "<div style='color:red'>".$amounts." will be deducted from your wallet. <br>Please wait...</div>";
 $s=mysqli_query($db,"UPDATE tbl_users set credit=credit-$amounts,vippass='$md5code',vipcode='$code',vipmembership='basic' where userid='$userid' "); 

 if($s){
    echo "<div style='color:green'>".$amounts." has been deducted from your wallet. </div>";

      echo "<div style='color:red'>Sending VIP Passcode to ".$adminphone." <br>Please wait...</div>";







//Insert your API Parameters
$senderID ="ShufflesVIP";
$mobile = $adminphone;
$messageBody = "Your one-time VIP Pass on shufflestv.com/vip is ".$code."";
$url = "https://www.bulksmsnigeria.com/api/v1/sms/create";
$apiToken = SMS_TOKEN;

//Pass all Parameters into a array to be submitted to the SendViaPost function as a Single Variable
$arr_params = array(
    'from'      =>  $senderID,
    'to'        =>  $mobile,
    'body'      =>  $messageBody,
    'api_token' =>  $apiToken,
    'dnd'       =>  5
);


//Dispatch Message
sendViaPost($url,$arr_params);
sendViaPost($url,array(
    'from'      =>  $senderID,
    'to'        =>  $mobile,
    'body'      =>  $messageBody,
    'api_token' =>  $apiToken,
    'dnd'       =>  5
));


 echo "<div style='color:green'>SMS sent to ".$adminphone." <br>You will be redirected shortly</div>";


?>
<script type="text/javascript">

   setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>/form-verify.php';
         }, 3000);
</script>
<?php

 }
    }
}
?>
</div></div>
<?php
exit;

}else


if(!isset($_COOKIE['vippass']) && isset($_COOKIE['phone'])){
    $userid=$_COOKIE['userid'];
?>
<div align="center" style="padding:20px; padding-top: 60px;color:white;"><img src="assets/images/logo-light.png" ><br><h2 style="padding-top: 10px; color: #ffffff">Become a VIP member</h2>
<form action="" method="Post">
  <input type="hidden" name="userid" value="<?php echo $userid; ?>">
    <input type="submit" name="basic" value="  Get Membership - Click here ( N1,000 )" class="button danger">
    <!--<input type="submit" name="premium" value="Premium  - N10,000" class="button info">-->
</form><br><div align="center"><div style="max-width: 300px">  N.B : Please note, the selected amount will be deducted from your account if available or you would be redirected to paystack to make payment.  <br> If you would rather make an online transfer, use the details below <br><br>Access (Diamond) Bank <br><h2 style="margin-bottom: 0">
1219258684</h2>
Campout Nigeria Limited<br>
After payment, send an SMS with payment details to 07068877523</div></div><br>
</b>
  <a href='logout.php'> <b style="color: green"> <i class="uil-refresh"></i>  Refresh Registration </b></a>
</div>
<?php
exit;
}else
*/if(!isset($_COOKIE['vippass'])){
?>


            <div class="main_content_inner">
                <div align="center" style="padding:20px; padding-top: 60px;color:white;"><img src="assets/images/logo-light.png" ><br><h2 style="padding-top: 10px; color: #ffffff;">Where your true fans watch you.</h2>
</div>
<div align="center">
<!--<a href='form-register.php'>
<img src="assets/images/P_vix.jpg" style="max-width: 80%">
</a>
<br>-->
<h3><a href='form-register.php' class="button danger">Click here to Continue</a></h3>
</div>
            
<ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-3@s uk-grid">
<?php
    
$query=mysqli_query($db,"SELECT * FROM tbl_vip_videos where tbl_vip_videos.xrating='0' order by rand()  limit 3 ");      
      while($row=mysqli_fetch_array($query))
  {

      ?>

<!--- starts here -->
                        <li>
                       
                                <!-- Blog Post Thumbnail -->
                                <div class="video-post-thumbnail">
                                    <span class="video-post-count"><?php echo $row['views']; ?></span>
                                    <span class="video-post-time">N <?php echo $row['video_amount']; ?></span>
                                    <span class="play-btn-trigger"></span>
                                    <!-- option menu -->
                                  
                               
                <img src="<?php echo SITE_URL; ?>/uploads/vipvideoimages/<?php echo $row["coverimage"]; ?>" alt='<?php echo $row['vid_title']; ?>'>

                                </div>

                                <!-- Blog Post Content -->
                                <div class="video-post-content">
                                  <!--  <h3 style="color: #ffffff"> <?php echo $row['vid_title']; ?></h3>-->
                                     <img src="<?php echo SITE_URL; ?>/uploads/vipimages/<?php echo $row["photo"]; ?>" alt='<?php echo $row['uname']; ?>'>
                                    <span class="video-post-user"  style="color: #ffffff"><?php echo $row['uname']; ?></span>
                                   <!--<span class="video-post-views">N<?php echo $row['video_amount']; ?> views</span>-->
                                   <!-- <span class="video-post-date"> 2 weeks ago </span>-->
                                </div>
                         
                        </li>

                    <!-- Ends here -->
<?php } ?>
                    

                    </ul>


                </div>
<br><br><div align='center' style="padding:20px" ><h4 style='color:white;align:center'>NOTICE</h4>
<p  >Content you may be about to watch is legally protected & licensed copyright material of Truefansonline.com. By continuing, you agree to be bound by the Terms and Conditions & Policy by your use of this platform.</p>

   </div>


<?php
exit;
}

?>