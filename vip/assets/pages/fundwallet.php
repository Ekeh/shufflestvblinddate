 <!-- contents -->
        <div class="main_content">

            <div class="main_content_inner">


                
                <!-- find channals  header -->

                <div class="section-header mt-5">
                    <div>
                            <h3> Fund Wallet </h3>
                   
                          <span>Secure payments provided by Paystack</span>
                        </div>
                 
                </div>

<?php
$msg='';
$email='';
if(isset($_POST['subscribe'])){
 $subscription=$_POST['subscription'];

  
        if(!$_COOKIE['userid']){
         $msg= "<div class='uk-alert-danger fade in' uk-alert>  We are unable to locate your user id. Kindly login. <a href='login.php'>Click Here </a></div>";
        }else{

        $userid=$_COOKIE['userid'];
  
                            //// this is the call to go to paystack

                            $amount=$subscription;
                            $time=md5(time());
                            $cartid=substr($time,0,10);

                            require_once('paystackcall.php');

                             ////paystackends here
                                 

}
}

    if($msg!=''){echo $msg;}
    ?>

                <!-- find channals -->
                <div class="" style="padding: 10px" align="center">
                    
<div style="max-width: 300px; padding: 10px" align="left">
<h5 class="txt3">Choose Amount</h5>
                <form  method="POST" action="">
                    <div class="wrap-input100 validate-input m-t-25 m-b-35" data-validate = "Choose Amount">
                        <select name="subscription" class="uk-input">
<option value="10000">N100</option>   
<option value="50000" >N500</option>   
<option value="100000" selected>N1,000</option>   
<option value="500000">N5,000</option>   
<option value="1000000">N10,000</option>   
<option value="2000000">N20,000</option>   
        
                        </select>
                    </div>

                    <div class="container-login100-form-btn" style="margin-top: 5px">
                        <button class="button warning" name="subscribe" style="width: 100%">
                          <i class="uil-wallet"></i>  Fund Wallet Now
                        </button>
                    </div>
                    <div align="center" style="background-color: #ffffff;margin-top: 5px"><img src="assets/images/pay.png" height="70px" width="auto"></div>

                    
                </form>
                 OR
 <br>
 Make an online transfer to :
 <br>
 <span style='color:#ffffff;'>
 <br> Access (Diamond) Bank
<h3>1219258684</h3>
 Campout Nigeria Limited
 <br>
 </span>
 After payment, send an SMS with payment details to 07068877523

</div>



                    </div>
 <br><br>
  
                

                </div>



            