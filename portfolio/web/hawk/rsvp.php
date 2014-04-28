<?php 
ob_start();
session_start();
require_once ('includes/config.inc.php');
$page_title = 'Register';
$formCompleted = false;
if (isset($_POST['submitted'])) {
require_once (MYSQL);
     $id = $_SESSION['user_id'];
     $q = "SELECT user_id FROM user_rsvp WHERE user_id='$id '";
     $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: " . mysqli_error($dbc));
     if (mysqli_num_rows($r) == 0) {
       $trimmed = array_map('trim', $_POST);
       $att = mysqli_real_escape_string($dbc, $trimmed['attending']);
       $meal = mysqli_real_escape_string($dbc, $trimmed['food']);
       $q = "INSERT INTO user_rsvp (user_id, user_rsvp, user_meal) VALUES ('$id', $att, $meal)";
       $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
     } else {
       $trimmed = array_map('trim', $_POST);
       $att = mysqli_real_escape_string($dbc, $trimmed['attending']);
       $meal = mysqli_real_escape_string($dbc, $trimmed['food']);
       $q = "UPDATE user_rsvp SET user_rsvp='$att', user_meal='$meal' WHERE user_id='$id'";
       $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
     }
} else {
require_once (MYSQL);
$id = $_SESSION['user_id'];
$q = "SELECT user_id FROM user_rsvp WHERE user_id='$id '";
$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: " . mysqli_error($dbc));
if (mysqli_num_rows($r) != 0) {
$q = "SELECT user_rsvp, user_meal FROM user_rsvp WHERE user_id='$id '";
$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: " . mysqli_error($dbc));
$row = mysqli_fetch_assoc($r); 
$formCompleted = true;
}
}
$form_disabled = "disabled";
if (isset($_SESSION['first_name'])) {
 $form_disabled = "";
}
include "includes/header.php";
?>

<h3 class="page-header">RSVP</h3>
<?php 
if ($form_disabled != "") {
echo "<p>You must be logged in to RSVP.</p>";
}
if ($formCompleted == true) {
echo "<p>Your Currently listed as" . $row['user_rsvp'];</p>";
}
?>
<form action="rsvp.php" method="post">
<div class="form-group">
<label for="attending">Attending</label><br/>
<input type="radio" name="attending" value="0" checked <?php echo $form_disabled?>/>Yes<br/>
<input type="radio" name="attending" value="1" <?php echo $form_disabled?>/>No<br/>
</div>
<div class="form-group">
<label for="food">Food</label><br/>
<input type="radio" name="food" value="1" <?php echo $form_disabled?>/>Meat<br/>
<input type="radio" name="food" value="1" <?php echo $form_disabled?>/>Fish<br/>
<input type="radio" name="food" value="2" <?php echo $form_disabled?>/>Vegetarian<br/><br/>
<button type="submit" name="submit" class="btn btn-default" <?php echo $form_disabled?>>RSVP</button>
<input type="hidden" name="submitted" class="btn btn-default" value="TRUE" />
</div>
</form>
<?php include "includes/footer.php";?>