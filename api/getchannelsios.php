<?php
require_once("db.php");
require_once("constants.php");
header("Content-type: application/json");

/*<Force users to update app>*/
    $result =  ["success" => false, "message" => "Please update your app. This version is no longer supported.", "data"=> null];
    mysqli_close($db);
    echo json_encode($result);
    exit();
/*</ End of Force users to update app>*/



$headers = apache_request_headers();
$code = (!empty($headers['Authorization'])) ? $headers['Authorization'] : $headers['Accesstoken'];
$result = [];
if($code !== CONSTANTS_ACCESS_TOKEN){
    $result =  ["success" => false, "message" => "Unauthorized.", "data"=> null];
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
	    /*$name=$row['name'];
	    $location=$row['location'];
	    $image=$row['image'];
	    
	    $data[] = ["name"=> $name, "location" => $location, "image" => $image]; */
	     $data[] = $row;
	    
	}
$result =  ["success" => true, "message" => "Channels fetched successfully.", "data"=> $data];
}else{
  $result =  ["success" => true, "message" => "No channels found.", "data"=> []];
}
 echo json_encode($result);
    exit();
mysqli_close($db);

?>