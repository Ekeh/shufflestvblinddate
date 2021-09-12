<div class="content-wrapper">
<section class="content-header">
      <h1>
      Payment Complete
        <small></small>
      </h1>
    </section>
    <section class="content">
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h5 class="box-title">Secure payment made on paystack</h5>
            </div> 
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

   $adminphone=$_COOKIE['phone'];
   
   $chk= mysqli_query($db,"SELECT *  from tbl_credit_record where txref='$txref'");
   $n=mysqli_num_rows($chk);
   if($n!='0'){
        echo "<h2>Transaction already exists. <a href='".SITE_VIP."'>Goto Shuffles VIP</a></h2>"; 
   }else{
       
  $sql= mysqli_query($db,"INSERT into tbl_credit_record set userid='$userid',trans_email='$txemail',trans_status='1',amount='$txamount',txref='$txref'");
if($sql){

  $code = substr(md5(microtime()),rand(0,26),5);
$md5code=md5($code);
$adminphone=$_COOKIE['phone'];



 $s=mysqli_query($db,"UPDATE tbl_users set vipmembership='premium' where userid='$userid' "); 


    echo "<div style='color:green'>".$txamount." has been received from you. </div>";

     






?>
<script type="text/javascript">

   setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>/form-login.php';
         }, 2000);
</script>
<?php


  }else{
     echo "<h2>We are unable to record this transaction. <br>Kindly contact admin via info@shufflestv.com</h2>";  
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
<br clear="all">
<div align="left" style="padding:10px ">
<img src="<?php echo SITE_URL; ?>/images/paystack.png" width='180px' height='auto'>
</div>
</div>
</div></section>
</div>