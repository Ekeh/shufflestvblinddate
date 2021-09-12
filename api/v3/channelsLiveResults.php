<?php
require_once("db.php");
require_once("constants.php");
require_once("accessValidations.php"); //Todo: The access of the user is validated in this file.
header("Content-type: application/json");


$query=mysqli_query($db,"SELECT * FROM tbl_channels WHERE has_live_result = 1 order by name asc ");
$num=mysqli_num_rows($query);
$cnt=1;
if($num != '0')
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
