<?php


/*
$servername = "localhost";
$username = "root";
$password = "mysql";
$database = "shuffles_db";

*/

$servername = "localhost";
$username = "shuffles_db";
$password = "simpleas123";
$database = "shuffles_db";

// Create connection
$db = new mysqli($servername, $username, $password, $database);

// Check connection
if ($db->connect_error) {

     /// echo "Connection Failed:No ID:NO Email";
 die("Connection failed: " . $db->connect_error);

} 

define("SITE_URL","https://shufflestv.com");
define("SITE_VIP","https://shufflestv.com/vip");
define("URL_PATH","https://shufflestv.com/vip/index.php");


//// where the video and coverimage is stored
define("VIDEO_PATH","https://shufflestv.com/vip/uploads/videos");
define("COVERIMAGE_PATH","https://shufflestv.com/vip/uploads/coverimage");


///// this is the website title
define("SITE_TITLE","ShufflesTV VIP");
define("MAIN_SITE","https://vip.shufflestv.com");

/*
define("SITE_URL","http://localhost/vip");
define("URL_PATH","http://localhost/vip/index.php");


//// where the video and coverimage is stored
define("VIDEO_PATH","http://localhost/vip/uploads/videos");
define("COVERIMAGE_PATH","http://localhost/vip/uploads/coverimage");


///// this is the website title
define("SITE_TITLE","ShufflesTV VIP");
define("MAIN_SITE","https://vip.shufflestv.com");
*/




function setmycookie($cookiename,$cookievalue,$duration){
setcookie($cookiename, $cookievalue, $duration);
}


function unsetmycookie($cookiename,$cookievalue,$duration){
setcookie($cookiename, $cookievalue, $duration);
}
error_reporting(E_WARNING);
?>