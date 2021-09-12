<?php

$amount=$amount;
  $cartid=$cartid;
  ////echo $cartid;
 
  $email=$_COOKIE['useremail']; 

    $userid=$_COOKIE['userid']; 

$curl = curl_init();
 //the amount in kobo. This value is actually NGN 300

// url to go to after payment
$callback_url = 'https://shufflestv.com/vip/validate.php';  



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
