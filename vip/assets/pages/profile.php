 <!-- contents -->
        <div class="main_content">

            <div class="main_content_inner">

           <?php

           $fname='';$userid='';
           $lname=''; $username=''; $email=''; $bname=''; $aholder=''; $anumber=''; $photo='';
      
if(isset($_POST['editusernow'])){


$fname=mysqli_real_escape_string($db,$_POST['fname']);
$email=mysqli_real_escape_string($db,$_POST['email']);
$lname=mysqli_real_escape_string($db,$_POST['lname']);
$bname=mysqli_real_escape_string($db,$_POST['bname']);
$aholder=mysqli_real_escape_string($db,$_POST['aholder']);
$anumber=mysqli_real_escape_string($db,$_POST['anumber']);
$username=mysqli_real_escape_string($db,$_POST['username']);

$userid=$_COOKIE['userid'];

$sql2 = mysqli_query($db,"SELECT * FROM tbl_users where (email='$email' OR username='$username') && userid!='$userid'");
$nums2=mysqli_num_rows($sql2);

if($nums2!='0'){
$msg= "<div class='uk-alert-danger fade in' uk-alert> failed <br> Email - ".$email." OR Username - ".$username." already exists for another user</div>";
      $chkmsg="error";
}else{

$sql3 = 
mysqli_query($db,"UPDATE tbl_users set username='$username', email='$email', fname='$fname',lname='$lname', bname='$bname', aholder='$aholder', anumber='$anumber' where userid='$userid'"); 

 if($sql3){
   
              ?> <script> alert ("Successfully Updated");</script> <?php 
                  $chkmsg="success";  
                  ?><script type="text/javascript">window.location.replace("<?php echo SITE_VIP; ?>/index.php?p=logout");</script> <?php              
                }else{
                   $msg= "<div class='uk-alert-danger fade in' uk-alert> failed <br> An error occured, Kindly try again later</div>";
                      $chkmsg="error";
                }
}
}
?>
                <div class=" mt-12">
                    <div>
                            <h1> Update Profile </h1>




   
                        </div>
                 
<?php

$userid=$_COOKIE['userid'];
$sql4 = mysqli_query($db,"SELECT * FROM tbl_users where userid='$userid'");
$rows = mysqli_fetch_array($sql4,MYSQLI_ASSOC); 

    
    $fname=$rows['fname'];
      $lname=$rows['lname'];
   $username=$rows['username'];
      $email=$rows['email'];
      $userid=$rows['userid'];
      $userphone=$rows['phone'];
           $aholder=$rows['aholder'];
      $bname=$rows['bname'];
      $anumber=$rows['anumber'];
     

?>

                <!-- find channals -->
                <div class="" style="padding: 10px" align="center">
                    

<form  method="POST" action=""  enctype="multipart/form-data">
<div class="uk-width-1-3@m uk-width-1-2@s m-auto" align="left">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Personal Info</h3>
            </div>    

              <div class="box-body">
              <?php  if($msg!=''){  echo $msg; }?> 
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
                            <label class="uk-form-label"> UserName</label>

                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-user"></i>
                                </span>
                                <input class="uk-input" type="text" value="<?php echo $username; ?>"  placeholder="Unique Username" name="username" required>
                            </div>

                        </div>
                    </div>


                    <div>
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
<hr>


                       <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Bank Name</label>

                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-house"></i>
                                </span>
                             <select type="text"  class="uk-input" id="bank" name='bname' required>
                              <?php if($bname!=''){?><option value="<?php echo $bname; ?>" selected><?php echo $bname; ?></option>   <?php }else{?> 
<option selected value="">Choose a bank</option>
<?php } ?>
<option value="access-bank">Access Bank</option>
<option value="access-bank-diamond">
Access Bank (Diamond)</option>
<option value="alat-by-wema">
ALAT by WEMA</option>
<option value="asosavings">
ASO Savings and Loans</option>
<option value="cemcs-microfinance-bank">
CEMCS Microfinance Bank</option>
<option value="citibank-nigeria">
Citibank Nigeria</option>
<option value="ecobank-nigeria">
Ecobank Nigeria</option>
<option value="ekondo-microfinance-bank">
Ekondo Microfinance Bank</option>
<option value="fidelity-bank">
Fidelity Bank</option>
<option value="first-bank-of-nigeria">
First Bank of Nigeria</option>
<option value="first-city-monument-bank">
First City Monument Bank</option>
<option value="globus-bank">
Globus Bank</option>
<option value="guaranty-trust-bank">
Guaranty Trust Bank</option>
<option value="heritage-bank">
Heritage Bank</option>
<option value="jaiz-bank">
Jaiz Bank</option>
<option value="keystone-bank">
Keystone Bank</option>
<option value="kuda-bank">
Kuda Bank</option>
<option value="parallex-bank">
Parallex Bank</option>
<option value="polaris-bank">
Polaris Bank</option>
<option value="providus-bank">
Providus Bank</option>
<option value="rubies-mfb">
Rubies MFB</option>
<option value="sparkle-microfinance-bank">
Sparkle Microfinance Bank</option>
<option value="stanbic-ibtc-bank">
Stanbic IBTC Bank</option>
<option value="standard-chartered-bank">
Standard Chartered Bank</option>
<option value="sterling-bank">
Sterling Bank</option>
<option value="suntrust-bank">
Suntrust Bank</option>
<option value="taj-bank">
TAJ Bank</option>
<option value="tcf-mfb">
TCF MFB</option>
<option value="titan-bank">
Titan Bank</option>
<option value="union-bank-of-nigeria">
Union Bank of Nigeria</option>
<option value="united-bank-for-africa">
United Bank For Africa</option>
<option value="unity-bank">
Unity Bank/option>
<option value="vfd">
VFD</option>
<option value="wema-bank">
Wema Bank</option>
<option value="zenith-bank">
Zenith Bank</option>

</select>
                            </div>

                        </div>
                    </div>

                     <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Account Number</label>

                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-list"></i>
                                </span>
                                <input class="uk-input" type="text" value="<?php echo $anumber; ?>"  placeholder="Account Number" name="anumber" required>
                            </div>

                        </div>
                    </div>


                    <div>
 <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Account Name</label>

                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-user"></i>
                                </span>
                                <input class="uk-input" type="text" value="<?php echo $aholder; ?>"  placeholder="Name on Account" name="aholder" required>
                            </div>

                        </div>
                    </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit"  class="uk-input button success" name="editusernow" style="background-color: red">Save Profile</button>
              </div>
        
          </div>
        </div>
          <!-- /.box -->


         
          </div>
        </div>
   </form>


                    </div>
 <br><br>
  
                

                </div>



            