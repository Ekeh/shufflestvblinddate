<?php

setcookie('agents_email',$_COOKIE['useremail'], time() - (3600*24)); // 3600 = 1 hour
setcookie('agents_id',$_COOKIE['userid'], time() - (3600*24)); // 3600 = 1 hour
setcookie('agents_fname',$_COOKIE['fname'], time() - (3600*24)); // 3600 = 1 hour
setcookie('agents_lname',$_COOKIE['lname'], time() - (3600*24)); // 3600 = 1 hour
setcookie('agents_phone',$_COOKIE['phone'], time() - (3600*24)); // 3600 = 1 hour
setcookie('agents_username',$_COOKIE['username'], time() - (3600*24)); // 3600 = 1 hour



?>

<script type="text/javascript">window.location.replace("<?php echo SITE_MAIN; ?>/agents");</script>