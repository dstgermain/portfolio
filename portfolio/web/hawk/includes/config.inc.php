<?php
define('LIVE', false);
define('EMAIL', 'dst.germain48@gmail.com');
define('BASE_URL', 'http://danstgermain.aisites.com/WebII/');
define('MYSQL', 'includes/mysqli_connect.php');

function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {
$message = "<p> An error occurred in script '$e_file' on line $e_line: $e_message\n<br/>";
$message .= "Date/Time: " .date('n-j-Y H:i:s') . "\n<br/>";
$message .= "<pre>" . print_r($e_vars, 1) . "</pre>\n</p>";

if (!LIVE) {
     echo '<div class="error">' .
     $message . '</div><br />';
} else {
     mail(EMAIL, 'Site Error!',
     $message, 'From: email@example.com');
     if ($e_number != E_NOTICE) {
          echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div><br />';
     }
}
}
set_error_handler ('my_error_handler');
?>