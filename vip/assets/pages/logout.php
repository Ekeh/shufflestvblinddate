<?php
$useremail=$_COOKIE['useremail'];
setcookie('useremail',$_COOKIE['useremail'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('userid',$_COOKIE['userid'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('vippass',$_COOKIE['vippass'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('fname',$_COOKIE['fname'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('lname',$_COOKIE['lname'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('phone',$_COOKIE['phone'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('username',$_COOKIE['username'], time() - (3600*24*365)); // 3600 = 1 hour



?>

<script type="text/javascript">window.location.replace("index.php");</script>