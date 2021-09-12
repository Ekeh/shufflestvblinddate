<?php
require_once('inc/db.php');
$c='';
$chk="@checkingpassword";
$c=$_GET['password'];

if($c!='' && $c==$chk){
    


///$chkemail = mysqli_query($db,"SELECT * FROM tbl_users  where (email like '%@gmail.com' OR email like '%@yahoo.com') and activation_status='1' order by rand() limit 2000");

$chkemail = mysqli_query($db,"SELECT * FROM tbl_users  where email!='' order by userid asc");


$nu=mysqli_num_rows($chkemail);

  //echo $nu;
///echo "<br>";

while($row=mysqli_fetch_array($chkemail))
	{
$fname=$row['fname'];    
$lname=$row['lname'];  
$email=$row['email'];  
$phone=$row['phone'];  


///echo $fname.",".$lname.",".$email."";
echo $email;
echo " ; ";
	}



}else{
?>
<!DOCTYPE html>
<html>
   <body>
      <script>
         setTimeout(function(){
            window.location.href = 'https://www.shufflestv.com/';
         }, 1000);
      </script>
      <p>Nothing to see here</p>
   </body>
</html>
<?php
}


?>