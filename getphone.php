<?php
///password - startnow

if(isset($_GET['logout'])){
	$cookie_username = "twist";
		$cookie_uservalue = "twist";
		setcookie($cookie_username, $cookie_uservalue, time() - (30)); // 3600 = 1 
?>
		<script type="text/javascript">
    
        setTimeout(function(){
            window.location.href = 'getphone.php';
         }, 2000);
    
</script>
<?php
}
//// you shouldn't be here
if(isset($_COOKIE['twist'])){
/////do nothing 
}else{
$pass=$_POST['pass'];

		if(md5($pass)!='222652052dfcbea947a6accbbd335154'){
			echo "Invalid Login";
		}else{
		/////set cookie
			////set the cookie and all user to provide video ID and actor ID
		$cookie_username = "twist";
		$cookie_uservalue = "twist";
		setcookie($cookie_username, $cookie_uservalue, time() + (3600)); // 3600 = 1 
?>
		<script type="text/javascript">
    
        setTimeout(function(){
            window.location.href = 'getphone.php';
         }, 500);
    
</script>
<?php

		}
}

if(isset($_COOKIE['twist'])){
	//// if the session is established
	echo "<h3>Welcome </h3>";
     include("inc/db.php"); 

?>
<div style="padding: 20px;"><a href='getphone.php?logout=1'>LogOut</a>
</div>
<?php





?>
<form method="POST" action="">

	<input type="submit" name="upnow" value="Extract Foreign Numbers - List">
</form>

<form method="POST" action="">

	<input type="submit" name="comma" value="Extract Foreign Numbers - Comma Separated">
</form>
<?php


if(isset($_POST['upnow'])){
	$sql3 = mysqli_query($db,"SELECT * FROM tbl_users where phone!='' and phone NOT LIKE '234%' AND phone NOT LIKE '+234%' and phone NOT LIKE '080%' AND phone NOT LIKE '80%'and phone NOT LIKE '070%' AND phone NOT LIKE '70%' and phone NOT LIKE '090%' AND phone NOT LIKE '90%' and phone NOT LIKE '081%' AND phone NOT LIKE '81%' and phone NOT LIKE '091%' AND phone NOT LIKE '91%' and phone NOT LIKE '071%' AND phone NOT LIKE '71%' order by userid desc");
$cnt=1;
$n3=mysqli_num_rows($sql3);
if($n3=='0'){
echo "Does not exist";
}else{
/////now that video ID and actor ID exist, come here
	echo "<h3>Total- ".$n3."</h3>";
	while($rows=mysqli_fetch_array($sql3))
	{
         $fname=ucfirst($rows['fname']);
      	 $lname=ucfirst($rows['lname']);
		 $phone=$rows['phone'];

			echo $cnt." . ".$fname." ".$lname." - ". $phone;
			echo "<br>";
			$cnt++;
	}
}



}


if(isset($_POST['comma'])){
	$sql3 = mysqli_query($db,"SELECT * FROM tbl_users where phone!='' and phone NOT LIKE '234%' AND phone NOT LIKE '+234%' and phone NOT LIKE '080%' AND phone NOT LIKE '80%'and phone NOT LIKE '070%' AND phone NOT LIKE '70%' and phone NOT LIKE '090%' AND phone NOT LIKE '90%' and phone NOT LIKE '081%' AND phone NOT LIKE '81%' and phone NOT LIKE '091%' AND phone NOT LIKE '91%' and phone NOT LIKE '071%' AND phone NOT LIKE '71%' order by userid desc");
$cnt=1;
$n3=mysqli_num_rows($sql3);
if($n3=='0'){
echo "Does not exist";
}else{
/////now that video ID and actor ID exist, come here
	echo "<h3>Total- ".$n3."</h3>";
	while($rows=mysqli_fetch_array($sql3))
	{
         $fname=ucfirst($rows['fname']);
      	 $lname=ucfirst($rows['lname']);
		 $phone=$rows['phone'];

			echo $phone;
			echo ",";
			$cnt++;
	}
}



}

}

if(!isset($_COOKIE['twist'])){ ?>

<form method="POST" action="">
	<input type="text" value="" name="pass" placeholder="Input Password">
	<input type="submit" name="regnow" value="Submit">
</form>


<?php 

}
?>