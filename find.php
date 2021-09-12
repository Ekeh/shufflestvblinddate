<?php
require_once('inc/db.php');

$chk="fgfsdys6dtusdjshdksd";
$c=$_GET['c'];
$s=$_GET['s'];
if($c!='' && $c==$chk && $s!=''){
    


$chkvote = mysqli_query($db,"SELECT * FROM tbl_votes where contestantid='$s'");
$nu=mysqli_num_rows($chkvote);

    echo $nu;
echo "<br>";




$chk = mysqli_query($db,"SELECT * FROM tbl_votes where contestantid='$s' group by userid");
$nuz=mysqli_num_rows($chk);
while($row=mysqli_fetch_array($chk))
	{
$userid=$row['userid'];    
$contestantid=$row['contestantid'];  

$chks = mysqli_query($db,"SELECT * FROM tbl_users where userid='$userid' ");
while($rod=mysqli_fetch_array($chks))
	{
$fname=$rod['fname']; 
$lname=$rod['lname']; 
$phone=$rod['phone']; 
$email=$rod['email']; 

$chky = mysqli_query($db,"SELECT * FROM tbl_votes where userid='$userid'");
$nuz=mysqli_num_rows($chky);

echo $fname." ".$lname." // ".$email." // ".$phone."//".$nuz;
echo "<br>";
	}


}

}else{
 echo "Invalid Code";   
}


?>