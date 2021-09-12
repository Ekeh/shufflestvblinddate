<?php
$servername = "localhost";
$username = "shuffles_db";
$password = "simpleas123";
$database = "shuffles_db";
//$database = "shuffles_db_test";
//

/*
$servername = "192.185.129.96";
$username = "campoutn_campout";
$password = "simpleas123";
$database = "campoutn_db";
*/

// Create connection

$db = new mysqli($servername, $username, $password, $database);

// Check connection
if ($db->connect_error) {

     /// echo "Connection Failed:No ID:NO Email";
 die("Connection failed: " . $dbtrivia->connect_error);

}





error_reporting(E_WARNING);
