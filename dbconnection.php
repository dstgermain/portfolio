<?php
$dbhost = 'localhost'; 
// $dbuser = 'danstgermain_db';
// $dbpass = '6033035758Ds';
// $dbname = 'danstgermain_db';
$dbname = 'db_danstgermain';
$dbuser = 'root';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
//if not connected, echo error, otherwise echo connected message. 
if (!$conn) { 
die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error()); 
} 
//else {
//echo 'Connected!' . mysqli_get_host_info($conn); 
//} 
//mysqli_close($conn); //closes the connection
?>