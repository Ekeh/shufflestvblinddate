<script>
alert ('Contest has been paused. You will be notified via IG, SMS or EMAIL when/if the contest is reopened. Thanks for your interest.');
window.location.replace("https://shufflestv.com/race9ja");
</script><?php 
include('../inc/db.php');

include('ainc/header.php');
 
include('ainc/topnav.php'); 


if(isset($_COOKIE['agents_id'])){
$page=$_GET['p'];


                if($page==''){
                  
                include("pages/adashboard.php"); 
                }elseif(!file_exists("pages/".$page.".php")){
                include("pages/adashboard.php");
                }else{
                include("pages/".$page.".php"); 
                }

            }else{

                include("pages/login.php"); 
        
            }
include('ainc/footer.php'); 


?>
   
   
     