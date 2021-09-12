<?php

$code=$_GET['code'];
header('Content-type: application/json');

/*<Force users to update app>*/
    $result =  ["success" => false, "message" => "Please update your app. This version is no longer supported.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
/*</ End of Force users to update app>*/



if($code=='88343a4758ad5bd50971e643e2f2b7de'){
require_once("db.php");

$query=mysqli_query($db,"SELECT * FROM tbl_requests INNER JOIN tbl_contestants
    ON tbl_requests.userid = tbl_contestants.conid where tbl_requests.promote='1' order by rand()  limit 20 ");  


$num=mysqli_num_rows($query);
$cnt=1;
if($num!='0')
{
    $flag = [];
while($row=mysqli_fetch_assoc($query))
	{
	    $result = [];
	   $result['postid'] = $row['postid'];
	   $result['uid'] = $row['uid'];
	   $result['imagepath'] = $row['imagepath'];
	   $result['video'] = $row['video'];
	   $result['channel'] = $row['channel'];
	   $result['hcat'] = $row['hcat'];
	   $result['ptitle'] = $row['ptitle'];
	   $result['location'] = $row['location'];
	   $result['pdesc'] = $row['pdesc'];
	   $result['amount_needed'] = $row['amount_needed'];
	   $result['userid'] = $row['userid'];
	   $result['status'] = $row['status'];
	   $result['date'] = $row['date'];
	   $result['votes'] = $row['votes'];
	   $result['amount_raised'] = $row['amount_raised'];
	   $result['views'] = $row['views'];
	   $result['photo_caption'] = $row['photo_caption'];
	   $result['showit'] = $row['showit'];
	   $result['promote'] = $row['promote'];
	   //
	   $queryLikes = mysqli_query($db,"SELECT COUNT(`likeid`) AS total_likes FROM `tbl_likes` WHERE `postid` = {$row['postid']} AND `userid` != 0"); 
	   $likesResult = $queryLikes->fetch_assoc();
	   $result['likes'] = $likesResult['total_likes'];
	   $result['conid'] = $row['conid'];
	   $result['fname'] = $row['fname'];
	   $result['photo'] = $row['photo'];
	   $result['regdate'] = $row['regdate'];
	   $result['createdby'] = $row['createdby'];
	   $result['phone'] = $row['phone'];
	   $result['email'] = $row['email'];
	   $result['lname'] = $row['lname'];
	    $flag[]=$result;
	}

}else{
    $flag='{"status": false,"message" : "No items found", "items": ' . json_encode([]).'}';
echo $flag;
exit();
   
}

$flag='{"status": true,"message" : "Videos fetched successfully.","items" : ' . json_encode($flag).'}';
echo $flag;
mysqli_close($db);
}else{
    $flag='{"status": false,"message" : "Unauthorized"}';
echo $flag;
exit();
}
?>