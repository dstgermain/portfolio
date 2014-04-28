<?php
ob_start();
session_start();
require_once ('includes/config.inc.php');
$page_title = 'Change Your Password';
include ('includes/header.php');
$err_array = array();
if (!isset($_SESSION['first_name'])) {
    $url = BASE_URL . '/index.php';
    ob_end_clean();
    header("Location: $url");
    exit();
}
if (isset($_POST['submitted'])) {
    require_once(MYSQL);
    $p = FALSE;
if (preg_match ('/^(\w){4,20}$/',$_POST['password1']) ) {
   if ($_POST['password1']==$_POST['password2']) {
     $p = mysqli_real_escape_string($dbc, $_POST['password1']);
   } else {
     array_push($err_array,"Your password did not match the confirmed password");
   }
} else {
   array_push($err_array,"Please enter a valid password");
}
if ($p) {
     $q = "UPDATE users SET pass=SHA1('$p') WHERE user_id={$_SESSION['user_id']} LIMIT 1";
     $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: " . mysqli_error($dbc));
     if (mysqli_affected_rows($dbc)==1) {
       echo '<h3 class="page-header">Your password has been changed.</h3>';
       mysqli_close($dbc);
       include ('includes/footer.php');
       exit();
        } else {
        array_push($err_array,"Your password was not changed. Make sure your new password is different than the current password. Contact the system administrator if you think an error occurred.");
     }
   } else {
   array_push($err_array,"Please try again.");
   }
   mysqli_close($dbc);
}
?>
<h3 class="page-header">Change Your Password</h3>
<div class="error-list">
  <ul>
  <?php
  foreach ($err_array as $errorList) {
    echo "<li>$errorList</li>";
  }
  ?>
  </ul>
</div>
<form action="change_password.php" method="post">
     <div class="form-group">
     <label for="password1">New Password</label>
     <small>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</small>
     <input type="password" name="password1" size="20" maxlength="20" class="form-control"/> </div>
     <div class="form-group">
     <label for="password2">Confirm New Password</label>
     <input type="password" name="password2" size="20" maxlength="20" class="form-control"/></div>
     <button type="submit" name="submit" class="btn btn-default">Change My Password</button>
     <input type="hidden" name="submitted" value="TRUE" />
</form>
<?php
include ('includes/footer.php');
?>