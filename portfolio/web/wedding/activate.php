<?php
ob_start();
session_start();
require_once ('includes/config.inc.php');
$page_title = 'Activate Your Account';
$confirmation = "";
include ('includes/header.php');
$x = $y = FALSE;
if (isset($_GET['x']) && preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $_GET['x']) ) {
$x = $_GET['x'];
}
if (isset($_GET['y']) && (strlen($_GET['y']) == 32)) {
  $y = $_GET['y'];
}
if ($x && $y) {
     require_once (MYSQL);
     $q = "UPDATE users SET active=NULL WHERE (email= '" . mysqli_real_escape_string($dbc, $x) . "' AND active='" . mysqli_real_escape_string($dbc, $y) . "') LIMIT 1";
     $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
     
     if (mysqli_affected_rows($dbc)== 1) {
     $confirmation = "<li class='header error'>Your account is now active. You may now log in.</li>";
} else {
     $confirmation = "<li class='header error'>Your account could not be activated. Please re-check the link or contact the system administrator.</li>";
}
    mysqli_close($dbc);
} else {
     $url = BASE_URL . 'index.php'; ob_end_clean();
     header("Location: $url");
     exit();
}
?>
<h3 class="page-header">Activate Account</h3>
<div class="error-list">
  <ul>
  <?php
  if(isset($confirmation)) {
    echo $confirmation;
  }
  ?>
  </ul>
</div>
<?php include ('includes/footer.php');
?>