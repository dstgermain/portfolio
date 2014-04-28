<?php
ob_start();
session_start();
require_once ('includes/config.inc.php');
include ('includes/header.php');
if (!isset($_SESSION['first_name'])) {
    $url = BASE_URL . 'index.php';
    ob_end_clean();
    header("Location: $url");
    exit();
    } else { 
    $_SESSION = array();
    session_destroy();
    setcookie (session_name(),'',time()-300);
    echo '<h3 class="page-header">You are now logged out.</h3>';
    }
include ('includes/footer.php');
?>