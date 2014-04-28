<?php
ob_start();
session_start();
require_once ('includes/config.inc.php');
$page_title = 'Login';
$err_array = array();
if (isset($_POST['submitted'])) {
     require_once(MYSQL);
     if (!empty($_POST['email'])) {
       $e = mysqli_real_escape_string($dbc, $_POST['email']);
     } else {
       $e = FALSE;
       array_push($err_array,"You forgot to enter your email address");
     }
     if (!empty($_POST['pass'])) {
       $p = mysqli_real_escape_string($dbc, $_POST['pass']);
     } else {
       $p = FALSE;
       array_push($err_array,"You forgot to enter your password");
       }
       if ($e && $p) {
     $q = "SELECT user_id, first_name, user_level FROM users WHERE(email='$e' AND pass=SHA1('$p')) AND active IS NULL";
     $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: " . mysqli_error($dbc));
     if (@mysqli_num_rows($r) == 1) {
     $_SESSION = mysqli_fetch_array($r, MYSQLI_ASSOC);
     mysqli_free_result($r);
     mysqli_close($dbc);
     $url = BASE_URL . 'index.php';
     header("Location: $url");
     exit();
      } else {
      array_push($err_array,"Either the email address and password entered do not match those on file or you have not yet activated your account.");
     }
} else {
     array_push($err_array,"Please try again");
     }
     mysqli_close($dbc);
}
include ('includes/header.php');
?>
<h3 class="page-header">Login</h1>
<p>New User? <a href="register.php">Register Here.</a></p>
<div class="error-list">
  <ul>
  <?php
  foreach ($err_array as $errorList) {
    echo "<li>$errorList</li>";
  }
  ?>
  </ul>
</div>
<form action="login.php" method="post">
<div class="form-group">
<label for="email" >Email Address</label> 
     <input type="text" name="email" size="20" maxlength="40" class="form-control"/>
     </div>
<div class="form-group">
<label for="email" >Password</label> 
     <input type="password" name="pass" size="20" maxlength="20" class="form-control"/>
     </div>
     <p><small>Your browser must allow cookies in order to log in.</small></p>
     <button type="submit" name="submit" class="btn btn-default" />Login</button>
     <input type="hidden" name="submitted" value="TRUE" />
</form>
<p>Forgot Password? <a href="forgot_password.php">Reset it Here.</a></p>
<?php include ('includes/footer.php');
?>