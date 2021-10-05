<?php
session_start();
$x='';
$k='';
$vuser='';
$page='';
$msg='';
include('inc/db.php');
if(isset($_GET['p'])){
$page=$_GET['p'];
}

if($page =='logout'){
setcookie('useremail',$_COOKIE['useremail'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('userid',$_COOKIE['userid'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('fname',$_COOKIE['fname'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('lname',$_COOKIE['lname'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('username',$_COOKIE['username'], time() - (3600*24*365)); // 3600 = 1 hour
setcookie('role',$_COOKIE['role'], time() - (3600*24*365)); // 3600 = 1 hour

?>

<script type="text/javascript">window.location.replace("<?php echo SITE_MAIN; ?>");</script>
<?php
  exit;
}

if(isset($_POST['enter'])){
  $stremail=mysqli_real_escape_string($db,$_POST['username']);
  $pwd=mysqli_real_escape_string($db,$_POST['password']); 

  if($stremail=='' || $pwd==''){
    echo '<div class="alert alert-block alert-danger fade in"> You have left a required field blank</div>';
  }else{
$password=md5($pwd);
$sql4 = mysqli_query($db,"SELECT * FROM tbl_users where (email='$stremail' OR phone='$stremail') and password='$password'");
$nums2=mysqli_num_rows($sql4);
      if($nums2=='0'){
            $sql1 = mysqli_query($db,"SELECT * FROM tbl_users where email='$stremail' OR phone='$stremail'");
            $nums=mysqli_num_rows($sql1);

            if($nums=='0'){
           $msg="<b>Failed</b><br> Email or Phone - ".$stremail."  does not exist.";
            }
            else
            { 
            $msg= "<b>Failed</b><br>Password does not match email provided";
            }
      }else{
      $rows = mysqli_fetch_array($sql4,MYSQLI_ASSOC);
    /*  echo '<pre>';
          var_dump($rows);
          echo '</pre>';
      exit();*/
      $fname=$rows['fname'];
      $lname=$rows['lname'];
     $useremail=$rows['email'];
      $userid=$rows['userid'];
      $adminphone=$rows['phone'];
       $gender=$rows['gender'];
       $role = $rows['role'];
       $msg= "Login Succesful";
  
      setcookie("fname", $fname, time() + (3600*24*365)); // 3600 = 1 hour 
      setcookie("lname", $lname, time() + (3600*24*365)); // 3600 = 1 hour  
  $username=$fname." ".$lname;
      setcookie("username", $username, time() + (3600*24*365)); // 3600 = 1 
      setcookie("useremail",$useremail, time() + (3600*24*365)); // 3600 = 1 hour   
      setcookie("userid", $userid, time() + (3600*24*365)); // 3600 = 1 hour hour
      setcookie("role", base64_encode($role), time() + (3600*24*365)); // 3600 = 1 hour hour
if($gender==''){
?><script type="text/javascript">
alert('Kindly update your profile and include gender');
  window.location.replace("<?php echo SITE_URL; ?>/updateprofile.php");</script><?php
      }else{
?><script type="text/javascript">window.location.replace("<?php echo SITE_URL; ?>/index.php");</script><?php
}
exit;
 }
}

}
if(isset($_GET['x'])){
  $x=$_GET['x'];
}

if(isset($_GET['k'])){
  $k=$_GET['k'];
}




if($k=='activatenow'){
    ///////this will activate code sent via email.
include("activatenow.php");
}
if(isset($_GET['vuser'])){
$vuser=$_GET['vuser'];
}

if($vuser!=''){

        $cookie_username = "vuser";
$cookie_uservalue = $vuser;
setcookie($cookie_username, $cookie_uservalue, time() + (3600*24)); // 3600 = 1 hour 

if(!isset($_COOKIE['useremail'])){
   ?> <script type="text/javascript">alert("You must Register/login to continue");</script> 
   <script type="text/javascript">window.location.replace("<?php echo URL_PATH; ?>?x=login");</script> <?php
}else{
 ?> <script type="text/javascript">window.location.replace("<?php echo URL_PATH; ?>?p=allvideos&v=<?php echo $vuser; ?>");</script> <?php       
}
}
if($x=='login' || isset($_POST['enter']) || isset($_POST['sendnow']) || isset($_POST['actsnow'])){
include("login.php");
}elseif($x=='register' || isset($_POST['joinnow']) || isset($_POST['actnow'])){
include("register.php");
}elseif($x=='password' || isset($_POST['resetpass'])){
include("password.php");
}else{

include('inc/header.php');
include('inc/sidebar.php'); 
include('inc/topnav.php'); 

                if($page==''){
                ////include("pages/livestream.php"); 
                include("pages/dashboard.php");
                }elseif(!file_exists("pages/".$page.".php")){
                ///include("pages/livestream.php");
               include("pages/dashboard.php");
                }else{
                include("pages/".$page.".php"); 
                }
include('inc/footer.php'); 
}

?>
   
   
     