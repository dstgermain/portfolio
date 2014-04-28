<?php
ob_start();
session_start();
require_once ('includes/config.inc.php');
$page_title = 'Forgot Your Password';
include ('includes/header.php');
$err_array = array();
if (isset($_POST['submitted'])) {
  require_once(MYSQL);
  $uid = FALSE;
  if (!empty($_POST['email'])) {
    $q = 'SELECT user_id FROM users WHERE email="'. mysqli_real_escape_string($dbc, $_POST['email']). '"';
    $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: " . mysqli_error($dbc));
    if (mysqli_num_rows($r) == 1) {
      list($uid) = mysqli_fetch_array($r, MYSQLI_NUM);
      } else {
     array_push($err_array,"The submitted email address does not match those on file");
     }
} else {
     array_push($err_array,"You forgot to enter your email address");
}
if ($uid) {
     $p = substr ( md5(uniqid(rand(),true)), 3, 10);
     $q = "UPDATE users SET pass=SHA1('$p') WHERE user_id=$uid LIMIT 1";
$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
if (mysqli_affected_rows($dbc)==1) {
      $body = "Your password to log into Susannah and Daniels Wedding site has been temporarily changed to '$p'. Please log in using this password and this email address. Then you may change your password to something more familiar.";
mail ($_POST['email'], 'Your temporary password.', $body, 'From: admin@sitename.com');
echo '<p>Your password has been changed. You will receive the new, temporary password at the email address with which you registered. Once you have logged in with this password, you may change it by clicking on the "Change Password" link.</p>';
mysqli_close($dbc);
exit();
 } else {
       array_push($err_array,"Your password could not be changed due to a system error. We apologize for any inconvenience.");
     }
   } else {
     array_push($err_array,"Please try again.");
   }
   mysqli_close($dbc);
}
?>

<h3 class="page-header">Reset Your Password</h3>
<div class="error-list">
  <ul>
  <?php
  foreach ($err_array as $errorList) {
    echo "<li>$errorList</li>";
  }
  ?>
  </ul>
</div>
<p>Enter your email address below and your password will be reset.</p>
<form action="forgot_password.php" method="post">
     <div class="form-group">
     <label for="email">Email Address:</label>
     <input type="text" name="email" size="20" maxlength="40" value="<?php if (isset($_POST ['email'])) echo $_POST ['email']; ?>" class="form-control"/>
     </div>
     <button type="submit" name="submit" class="btn btn-default">Reset My Password</button>
     <input type="hidden" name="submitted" value="TRUE" />
</form>

<?php 
include ('includes/footer.php');
?>