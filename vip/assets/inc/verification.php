 <!-- contents -->
       <?php
/////check if a user has specified content preference
 $userid=$_COOKIE['userid'];

 $s=mysqli_query($db,"SELECT * from tbl_users where userid='$userid' "); 
 while($rw=mysqli_fetch_array($s))
  {

$ct= $rw['content_type'];
$pa= $rw['phone_activate'];


}

if($ct=='0'){
    ?>
<script type="text/javascript">alert("Kindly specify the type of content you would like to receive notification on")

   setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>/survey.php';
         }, 500);
         </script>
    <?php
    exit;
}elseif($pa=='0'){
    ?>
<script type="text/javascript">alert("We need to verify your phone number before you can continue to use this service")

   setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>/survey-phone.php';
         }, 500);
         </script>
    <?php
    exit;
}

?>