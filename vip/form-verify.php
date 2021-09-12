<!doctype html>
<html lang="en">
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <title>Shuffles VIP</title>
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
    <div uk-height-viewport="expand: true" class="uk-flex uk-flex-middle">
      
        <div class="uk-width-1-3@m uk-width-1-2@s m-auto">
            <div align="center" style="padding: 10px"> <img src="assets/images/logo-light.png" width="150px" height="auto" ></div>
            <div class="uk-card-default p-6 rounded" style="padding-top: 3px">
<?php
include("../inc/db.php"); 
$strphone=$_COOKIE['phone'];
if(isset($_POST['regpass'])){
$pcode=mysqli_real_escape_string($db,$_POST['pcode']);
$chkpass=md5($pcode);

$userid=$_COOKIE['userid'];
if($pcode==''  ){
    $msg= "<div class='uk-alert-danger fade in' uk-alert> You have left a required field blank</div>";
  }else{
$sql2 = mysqli_query($db,"SELECT * FROM tbl_users where vippass='$chkpass' and userid='$userid'");
$nums2=mysqli_num_rows($sql2);

if($nums2=='0'){
$msg= "<div class='uk-alert-danger fade in' uk-alert> Invalid Pass Code</div>";
}else{
$msg= "<div class='uk-alert-success' uk-alert> Account Verified</div>";

$rows = mysqli_fetch_array($sql2,MYSQLI_ASSOC); 

    
    $membership=$rows['vipmembership'];

$sql = mysqli_query($db,"UPDATE tbl_users set vipstatus='1' where  userid='$userid'");

      $cookie_id = "vippass";
      
      $cookie_idvalue = $strphone;

      setcookie($cookie_id, $cookie_idvalue, time() + (3600*24*365)); // 3600 = 1 hour 


           $cookie_username = "membership";

      $cookie_uservalue = $membership;

      setcookie($cookie_username, $cookie_uservalue, time() + (3600*24*365)); // 3600 = 1 hour  


?><script type="text/javascript">window.location.replace("<?php echo SITE_VIP; ?>");</script><?php
}
}
}
echo $msg;
?>
<div class="my-4 uk-text-center" >
                   
                    <h2 class="mb-0">Input VIP code</h2><br>
                    <p class="my-2">We have sent a VIP passcode to <b><?php echo $strphone; ?></b><bR> <span style='color:green; size: 8px'>It May take up to 5 minutes to receive it</span></p>
                </div>
                 <form class="uk-child-width-1-1 uk-grid-small" uk-grid method="POST" action="">

                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label">Pass Code</label>

                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-lock"></i>
                                </span>
                                <input class="uk-input" type="text" value="<?php echo $pcode; ?>" placeholder="Input Pass Code" name="pcode">
                            </div>

                        </div>
                    </div>

                     <div class="mt-4 uk-flex-middle uk-grid-small" uk-grid>
                        
                            <div class="uk-width-auto@s">
                                <input type="submit" class="button primary" value="Verify Account" name="regpass"></input>
                            </div>
                            <br> <a href='logout.php'>Refresh </a>
                        </div>


                </form>

            </div>
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