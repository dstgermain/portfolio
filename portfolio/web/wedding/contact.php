<?php 
ob_start();
session_start();
include "includes/header.php";

$err_last = "none"; $err_first = "none"; $err_email = "none"; $err_message = "none";
                                                              $first_name = NULL;
                                                              $last_name = NULL;
                                                              $email = NULL;
                                                              $message = NULL;
                                                              $confirmation = NULL;
                                                              $email_valid = false;
$err_array = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST["first_name"])) {
    $first_name = $_POST["first_name"];
    $err_first = "valid";
  } else {
    $err_first = "error";
    array_push($err_array,"Please enter your First Name");
  }


  if (!empty($_POST["last_name"])) {
    $last_name = $_POST["last_name"];
    $err_last = 'valid';
  } else {
    $last_name = NULL;
    $err_last = 'error';
    array_push($err_array,"Please enter your Last Name");
  }


  if (preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $_POST['email'])) {
    $email = $_POST["email"];
    $err_email = 'valid';
    $email_valid = true;
  } else {
    $email = NULL;
    $err_email = 'error';
    array_push($err_array,"Please enter a valid Email");
  }
  
  if (!empty($_POST["email"])) {
    $email = $_POST["email"];
  } 

  if (!empty($_POST["message"])) {
    $message = $_POST["message"];
    $err_message = 'valid';
  } else {
    $message = NULL;
    $err_message = 'error';
    array_push($err_array,"Please enter a Message");
  }
  
  if (isset($first_name) && isset($last_name) && $email_valid && isset($message)) {
    $to = "info@danstgermain.com";
    $subject = "Wedding Contact Form";
    $message_body = 
   "Name: " . $first_name . $last_name . "\n".
   "Email: " . $email . "\n".
   "Message: " . $message . "\n";
    $headers = "From: info@danstgermain.com \r\n";
    $headers .= "Cc: ". $email. "\r\n";
    mail($to,$subject,$message_body,$headers);
    $confirmation = "<li class='header'>Success! Your Message has been sent</li>";
  } else {
    $confirmation = "<li class='header'>Check the form for errors listed bellow:</li>";
  }
}
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <div class="form-group">
    <label for="first_name">Name</label>
    <input type="text" name="first_name" class="form-control <?php echo $err_first ?>" value="<?php if (isset($first_name)) echo $first_name ?>"/>
  </div>
  <div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" name="last_name" class="form-control <?php echo $err_last ?>" value="<?php if (isset($last_name)) echo $last_name ?>"/>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" name="email" class="form-control <?php echo $err_email ?>" value="<?php if (isset($email)) echo $email ?>"/>
  </div>
  <div class="form-group">
    <label for="message">Message</label>
    <textarea name="message" class="form-control <?php echo $err_message ?>"><?php if (isset($message)) echo $message ?></textarea>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
<?php include "includes/footer.php";?>