<?php
require_once("db.php");
$code=$_GET['code'];
//echo file_get_contents('php://input');
//exit();
header('Content-type: application/json');
$searchArray = json_decode(file_get_contents('php://input'), true);
if($code=='88343a4758ad5bd50971e643e2f2b7de'){
if(empty($searchArray['searchQuery'])) {
$flag='{"success": false,"message" : "Query to search must not be empty."}';
echo $flag;
exit();
}  
$searchQuery = $searchArray['searchQuery'];
$searchQuery = str_replace(['\\', '_', '%'], ['\\\\', '\\_', '\\%'], $searchQuery);

$query=mysqli_query($db,"SELECT * FROM tbl_requests INNER JOIN tbl_contestants
    ON tbl_requests.userid = tbl_contestants.conid where tbl_requests.showit='1' and tbl_contestants.fname like '%{$searchQuery}%' limit 20 ");  

$num=mysqli_num_rows($query);
if($num!='0')
{
    $flag = [];
while($row=mysqli_fetch_assoc($query))
	{
	    $flag[]=$row;
	}

}else{
  $flag='{"success": false,"message" : "Item not found","items" : ' . json_encode([]).'}';
    echo $flag;
    exit();
}

//echo json_encode($flag);
$flag='{"success": true,"message" : "Videos fetched successfully.","items" : ' . json_encode($flag).'}';
echo $flag;
mysqli_close($db);
}else{
    
 $flag='
  {
    "success": false,
    "message" : "Unauthorized"
  }';
  echo $flag;   
}
?>