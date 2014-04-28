<?php
DEFINE ('DB_USER', 'danstgermain_db');
DEFINE ('DB_PASSWORD', '6033035758Ds');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'danstgermain_db');
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$dbc) {
     trigger_error ('Could not connect to MySQL: ' . mysqli_connect_error() );
}
?>