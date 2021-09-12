<?php

$code=$_GET['code'];
if($code=='88343a4758ad5bd50971e643e2f2b7de'){
require_once("db.php");


$query=mysqli_query($db,"SELECT * FROM tbl_selection order by username asc ");    


$num=mysqli_num_rows($query);

if($num!='0')
{
while($row=mysqli_fetch_array($query))
	{
	    $flag[]=$row;
	}
print(json_encode($flag));
}else{
    $flag='[{"0":"4","id":"4","1":"No Channel","name":"No Channel","2":"http:\/\/shufflestv.com","location":"http:\/\/shufflestv.com","3":"http:\/\/shufflestv.com\/channels\/logo.png","image":"http:\/\/shufflestv.com\/channels\/logo.png","4":"2019-10-05 03:59:50","entry_date":"2019-10-05 03:59:50"}]';
    
    print $flag;
}





mysqli_close($db);
}else{
    
 header("Location: https://www.shufflestv.com/");  
}
?>