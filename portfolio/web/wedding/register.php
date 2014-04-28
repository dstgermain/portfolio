<?php
ob_start();
session_start();
require_once ('includes/config.inc.php');
$page_title = 'Register';

$err_last = "none"; $err_first = "none"; $err_email = "none"; $err_pass1 = "none"; $err_pass2 = "none"; $confirmation = NULL; $err_array = array();

if (isset($_POST['submitted'])) {
     require_once (MYSQL);
     $trimmed = array_map('trim', $_POST);
     $fn = $ln = $e = $p = FALSE;
     
     if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
       $fn = mysqli_real_escape_string($dbc, $trimmed['first_name']);
       $err_first = "valid";
     } else {
       array_push($err_array,"Please enter your First Name");
       $err_first = "error";
     }
     if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
       $ln = mysqli_real_escape_string($dbc, $trimmed['last_name']);
       $err_last = "valid";
     } else {
       array_push($err_array,"Please enter your Last Name");
       $err_last = "error";
     }
     if (preg_match ('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $trimmed['email'])) {
       $e = mysqli_real_escape_string($dbc, $trimmed['email']);
       $err_email = "valid";
     } else {
       array_push($err_array,"Please enter a valid Email Address");
       $err_email = "error";
     }
     
     if (preg_match ('/^\w{4,20}$/',$trimmed['password1']) ) {
       if ($trimmed['password1']==$trimmed['password2']) {
         $p = mysqli_real_escape_string($dbc, $trimmed['password1']);
         $err_pass1 = "valid";
       } else {
         array_push($err_array,"Your Passwords do not match");
         $err_pass2 = "error";
       }
     } else {
       array_push($err_array,"Enter a valid Password (4-20 - numbers and letters)");
       $err_pass1 = "error";
     }
     
     if ($fn && $ln && $e && $p) {
       $q = "SELECT user_id FROM users WHERE email='$e '";
       $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: " . mysqli_error($dbc));
       if (mysqli_num_rows($r) == 0) {
         $a = md5(uniqid(rand(), true));
         $q = "INSERT INTO users (email, pass, first_name, last_name, active, registration_date) VALUES ('$e', SHA1('$p'), '$fn', '$ln', '$a', NOW() )";
         $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
         if (mysqli_affected_rows($dbc)==1) {
           $url_activate = "activate.php?x=". urlencode($e) . "&y=$a";
            header("Location: $url_activate");
            exit();
           //$body = "Thank you for registering for Susannah and Daniels wedding site. To activate your account, please click on this link:\n\n";
           //$body .= BASE_URL . 'activate.php?x= '. urlencode($e) . "&y=$a";
           //mail($trimmed['email'],'Registration Confirmation', $body, 'From: wedding@susannahanddan.com');
           //$confirmation = '<h3>Thank you for registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account.</h3>';
     include ('includes/footer.php');
     exit();
  } else {
     array_push($err_array,"You could not be registered due to a server error, We appologize for the inconvience.");
}
} else {
     array_push($err_array,"That Email Address was already registered.");
   }
} else {
     array_push($err_array,"Please re-enter your passwords and try again.");
   }
   mysqli_close($dbc);
}
include "includes/header.php";
?>

<h3 class="page-header">Contact Us</h3>
<div class="error-list">
  <ul>
  <?php
  if(isset($confirmation)) {
    echo $confirmation;
  }
  foreach ($err_array as $errorList) {
    echo "<li>$errorList</li>";
  }
  ?>
  </ul>
</div>
<form action="register.php" method="post">
<div class="form-group">
<label for="first_name" >First Name</label>
<input type="text" name="first_name" size="20" maxlength="20" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>" class="form-control <?php echo $err_first ?>" />
</div>
<div class="form-group">
<label for="last_name">Last Name</label>
<input type="text" name="last_name" size="20" maxlength="40" value="<?php if (isset($trimmed['last_name'])) echo
 $trimmed['last_name']; ?>" class="form-control <?php echo $err_last ?>"/>
</div>
<div class="form-group">
<label for="email">Email Address:</label>
<input type="text" name="email" size= "30" maxlength="80" value= "<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" class="form-control <?php echo $err_email ?>" /> 
</div>
<div class="form-group">
<label for="email">Password:</label> 
<small>Use only letters and numbers. Must be between 4 and 20 characters long.</small>
<input type="password" name="password1" size="20" maxlength="20" class="form-control <?php echo $err_pass1 ?>"/>
</div>
<div class="form-group">
<label for="email">Confirm Password:</label>
      <input type="password" name="password2" size="20" maxlength="20" class="form-control <?php echo $err_pass2 ?>" />
</div>
<button type="submit" name="submit" class="btn btn-default">Register</button>
     <input type="hidden" name="submitted" class="btn btn-default" value="TRUE" />
</form>

<?php
include ('includes/footer.php');
?>