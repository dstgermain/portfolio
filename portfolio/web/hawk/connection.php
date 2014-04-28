<?php
$dbhost = 'localhost'; 
$dbuser = 'root';
$dbpass = 'root';
$dbname = 'danstgermain_db';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
//if not connected, echo error, otherwise echo connected message. 
if (!$conn) { 
     die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error()); 
} 
else {
     echo 'Connected!' . mysqli_get_host_info($conn); 
} 
mysqli_close($conn); //closes the connection
?>