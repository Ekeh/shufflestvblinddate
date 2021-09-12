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

$query=mysqli_query($db,"SELECT * FROM tbl_channels order by name asc ");    
$num=mysqli_num_rows($query);
$cnt=1;
if($num !='0')
{
    $data = [];
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC))
	{
	    $data[] = $row;
	    
	}
$result =  ["success" => true, "message" => "Channels fetched successfully.", "data"=> $data];
}else{
  $result =  ["success" => true, "message" => "No channels found.", "data"=> []];
}
mysqli_close($db);
 echo json_encode($result);
    exit();

?>