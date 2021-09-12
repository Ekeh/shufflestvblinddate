<?php
require_once("db.php");


$stremail=mysqli_real_escape_string($db,$_POST['email']);
$strpassword=mysqli_real_escape_string($db,$_POST['password']);

$password=md5($strpassword);


$sql2 = mysqli_query($db,"SELECT * FROM tbl_users where email='$stremail' and password='$password'");

$nums2=mysqli_num_rows($sql2);
      if($nums2!='0'){
          
     
            



      $rows = mysqli_fetch_array($sql2,MYSQLI_ASSOC); 

    
    
       $fname=$rows['fname'];
         $lname=$rows['lname'];
          $userphone=$rows['phone'];
      $useremail=$rows['email'];
      $userid=$rows['userid'];
      $actstatus=$rows['activation_status'];
       $credit=$rows['credit'];

      $cookie_id = "userid";
      $cookie_idvalue = $userid;
     

if($astat=='0'){
  echo "astat:You must verify your profile to continue:".$userid.":".$stremail.":".$fname.":".$lname.":".$userphone.":".$fname." ".$lname.":".$actstatus."";

}else{
    $update = mysqli_query($db,"UPDATE  tbl_users set shuffles_app='1' where userid='$userid'"); 
 echo "success:Login Successful:".$userid.":".$stremail.":".$fname.":".$lname.":".$userphone.":".$fname." ".$lname.":".$actstatus.":".$credit." units";
}

}else{
    $sql1 = mysqli_query($db,"SELECT * FROM tbl_users where email='$stremail'");
            $nums=mysqli_num_rows($sql1);

            if($nums!='0'){
            echo "failed:Invalid password:".$userid.":".$stremail.":".$fname.":".$lname.":".$userphone.":".$fname." ".$lname.":".$actstatus."";
            }
            else
            {  echo "failed:Email does not exist:".$userid.":".$stremail.":".$fname.":".$lname.":".$userphone.":".$fname." ".$lname.":".$actstatus."";
         
            }

    
}


?>