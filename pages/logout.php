<?php
$useremail=$_COOKIE['useremail'];
setcookie('useremail',$_COOKIE['useremail'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('userid',$_COOKIE['userid'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('astatus',$_COOKIE['astatus'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('fname',$_COOKIE['fname'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('lname',$_COOKIE['lname'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('phone',$_COOKIE['phone'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('username',$_COOKIE['username'], time() - (3600*24*365)); // 3600 = 1 hour

?>
<!-- 
<script type="text/javascript">window.location.replace("<?php echo SITE_MAIN; ?>");</script>


Content Header (Page header) 
<section class="content-header">
<h1>LogOut
        <small>Logout from the admin area</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?p=dashboard"><i class="fa fa-users"></i> Home</a></li>
        <li class="active">LogOut</li>
      </ol>
    </section>


    <section class="content">

     
     
    </section>

  </div>-->
