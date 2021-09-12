<?php
$pass='';
$mymessage='';
$msg='';
if(isset($_GET['p'])){

if($_GET['p']=='logout'){
	setcookie('allow','b0a77579ada5652c5f4e4445e3e93765', time() - (3600));

	?>
<script type="text/javascript">window.location.replace("whatsapp.php");</script>
<?php

}
}
if(isset($_POST['login'])){
	$pass=$_POST['pass'];

	if($pass='b0a77579ada5652c5f4e4445e3e93765'){
setcookie('allow','b0a77579ada5652c5f4e4445e3e93765', time() + (3600)); // 3600 = 1 hour
?>
<script type="text/javascript">window.location.replace("whatsapp.php");</script>
<?php
	}
}



if(isset($_COOKIE['allow'])){

include('inc/db.php');

?>
<div style="padding: 10px; font-family: verdana; ">

	<div style="padding: 10px; margin-bottom: 10px;"><a href='whatsapp.php?p=logout' >LogOut</a>
	</div>




<?php
if(isset($_POST['sendmsg'])){
  $mymessage=mysqli_real_escape_string($db,$_POST['mymessage']);

if($mymessage==''){
	echo "<div>Include a message to send to recipients</div>";
}

}


if($mymessage==''){
?>

<form method="POST" action="" style="padding: 20px;">
	<label>Message to send<br>
	<textarea rows="10" name='mymessage' cols="100" style="padding: 10px" required><?php echo $mymessage; ?></textarea> </label><br>
	<input type="submit" name="sendmsg" value="Submit" style="padding: 10px">
</form>
<?php

}else{

///// get the msg here
	$msg=preg_replace('/\s+/', '&nbsp;', $mymessage);
///$msg=str_replace(" ", "%20", $mymessage);

$s = mysqli_query($db,"SELECT * FROM tbl_credit_record INNER JOIN tbl_users ON tbl_credit_record.trans_email=tbl_users.email where trans_email!='okaoodu@gmail.com'group by trans_email order by id asc");
$n=mysqli_num_rows($s);
///echo $n;
?>
<table><tr><td>S/No</td><td>Name</td><td>Phone</td><td>Email</td></tr>
<?php
$cnt=1;
while($rows=mysqli_fetch_array($s))
  { 
   $fname=$rows['fname'];
      $lname=$rows['lname'];

      $email=$rows['email'];
      $userid=$rows['userid'];
      $phone=$rows['phone'];

$phone = ltrim($phone, "0");  
$phone = ltrim($phone, "+");  
if(strlen($phone)=='10'){
$phone="234".$phone;
}

if(strlen($phone)=='13'){
?>
<tr><td><?php echo $cnt; ?></td><td><?php echo $fname; ?> <?php echo $lname; ?></td><td><a href='https://wa.me/<?php echo $phone; ?>?text=<?php echo $msg; ?>' target="_blank"><?php echo $phone; ?></a></td><td><?php echo $email; ?></td></tr>
<?php
$cnt++;

}
}





?>
</table>

<?php

}
}else{
?>


<form method="POST" action="" style="padding: 20px;">
	<label>Input Password <br>
	<input type="password" name="pass" value="<?php echo $pass; ?>" placeholder='Input Password' style='padding: 10px' required></label>
	<input type="submit" name="login" value="Submit" style="padding: 10px">
</form>
</div>
<?php } ?>
