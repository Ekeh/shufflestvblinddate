<?php

           $ct='';$userid='';
     include("../inc/db.php"); 
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
</head>
<body>
<!-- Content
    ================================================== -->

        <div class="main_content">

            <div class="">

           
                <!-- find channals -->
                <div class="" style="padding: 10px" align="center">
                 <h1> Update Preference</h1>
   

<form  method="POST" action=""  enctype="multipart/form-data">
<div class="uk-width-1-3@m uk-width-1-2@s m-auto" align="left">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Content Preference</h3>
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