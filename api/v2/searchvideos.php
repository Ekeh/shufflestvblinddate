<?php
require_once("db.php");
require_once("constants.php");
header("Content-type: application/json");
$headers = apache_request_headers();
$code = $headers['Accesstoken'];
$result = [];
if($code !== CONSTANTS_ACCESS_TOKEN){
    $result =  ["success" => false, "message" => "Unauthorized.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
}

$searchArray = json_decode(file_get_contents('php://input'), true);
if(empty($searchArray['searchQuery'])) {
$flag='{"success": false,"message" : "Query to search must not be empty."}';
mysqli_close($db);
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
    mysqli_close($db);
  $flag='{"success": false,"message" : "Item not found","items" : ' . json_encode([]).'}';
  mysqli_close($db);
    echo $flag;
    exit();
}

//echo json_encode($flag);
$flag='{"success": true,"message" : "Videos fetched successfully.","items" : ' . json_encode($flag).'}';
mysqli_close($db);
echo $flag;
mysqli_close($db);

?>