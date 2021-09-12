<?php
require_once("db.php");
require_once("constants.php");
require_once("accessValidations.php"); //Todo: The access of the user is validated in this file.
header("Content-type: application/json");


   // sprintf('This is a %s test string', FOO);
$query=mysqli_query($db, sprintf("SELECT value FROM tbl_settings WHERE name = '%s' LIMIT 1", SHOW_VOTING_NAVIGATION));
$row=mysqli_fetch_assoc($query);
if($row['value'] == VOTING_ENABLED){
$query=mysqli_query($db,"SELECT * FROM tbl_selection");
$num=mysqli_num_rows($query);
if($num!='0')
{
    $flag = [];
while($row=mysqli_fetch_assoc($query))
{
    $flag[]=$row;
}
}else{
  $flag='{"success": false,"message" : "No contestant found","items" : ' . json_encode([]).'}';
  mysqli_close($db);
    echo $flag;
    exit();
}

//echo json_encode($flag);
$flag='{"success": true,"message" : "Contestants fetched successfully.","data" : ' . json_encode($flag).'}';
echo $flag;
mysqli_close($db);

}else{
    $errorType = ERROR_TYPE_VOTING_NOT_STARTED;
 $flag="{\"success\": false,\"message\" : \"Voting is not started. Qualified contestants are only visible when voting has started.\", \"data\": null, \"error_type\": $errorType }";
 mysqli_close($db);
  echo $flag;
}

?>
