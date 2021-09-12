 <!-- contents -->
        <div class="main_content">

            <div class="main_content_inner">

           <?php

           $ct='';$userid='';
     
if(isset($_POST['editusernow'])){


$ct=mysqli_real_escape_string($db,$_POST['ct']);


$userid=$_COOKIE['userid'];



$sql3 = 
mysqli_query($db,"UPDATE tbl_users set content_type='$ct' where userid='$userid'"); 

 if($sql3){
   
              ?> <script> alert ("Successfully Updated");</script> <?php 
                  $chkmsg="success";  
                  ?><script type="text/javascript">window.location.replace("<?php echo SITE_VIP; ?>");</script> <?php              
                }else{
                   $msg= "<div class='uk-alert-danger fade in' uk-alert> failed <br> An error occured, Kindly try again later</div>";
                      $chkmsg="error";
                }
}

?>
                <div class=" mt-12">
                    <div>
                            <h1> Notification Preference</h1>




   
                        </div>


                <!-- find channals -->
                <div class="" style="padding: 10px" align="center">
                    

<form  method="POST" action=""  enctype="multipart/form-data">
<div class="uk-width-1-3@m uk-width-1-2@s m-auto" align="left">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Preference</h3>
            </div>    

      

                       <div>
                        <div class="uk-form-group">
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

                        </div>
                    </div>

                  

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



            