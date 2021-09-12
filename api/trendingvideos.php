<?php

$code=$_GET['code'];
if($code=='88343a4758ad5bd50971e643e2f2b7de'){
require_once("db.php");


$query=mysqli_query($db,"SELECT * FROM tbl_requests INNER JOIN tbl_contestants
    ON tbl_requests.userid = tbl_contestants.conid where tbl_requests.showit='1' and  tbl_requests.promote='1' order by rand()  limit 5 ");    


$num=mysqli_num_rows($query);

if($num!='0')
{
while($row=mysqli_fetch_array($query))
	{
	    $flag[]=$row;
	}
print(json_encode($flag));
}else{
    $flag='[{"0":"151","postid":"151","1":"","photo":"","2":"Business","hcat":"Business","3":"No requests available","ptitle":"","4":"lagos","location":"lagos","5":"...","pdesc":"This service is provide free of charge, we would appreciate your kind donation","6":"50000","amount_needed":"500000","7":"4","userid":"4","8":"0","status":"0","9":"2019-06-21 06:36:03","date":"2019-06-21 06:36:03","10":"0","amount_raised":"0","11":"","photo_caption":"","12":"4","13":"Admin","fname":"Admin","14":"- Eppa","lname":"- Eppa","15":"080","phone":"080","16":"myeppa@gmail.com","email":"myeppa@gmail.com","17":"83878c91171338902e0fe0fb97a8c47a","password":"83878c91171338902e0fe0fb97a8c47a","18":"2019-06-18 16:21:03","reg_date":"2019-06-18 16:21:03","19":"0","20":"","status_updated_when":"","21":"","comment_status_update":"","22":"0","investment_cycles":"0"}]';
    
    print $flag;
}


mysqli_close($db);
}else{
    
 header("Location: https://www.shufflestv.com/");  
}
?>