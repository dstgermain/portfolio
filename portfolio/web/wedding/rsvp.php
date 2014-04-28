<?php 
ob_start();
session_start();
require_once ('includes/config.inc.php');
$page_title = 'Register';
$at = $ml = "";
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
if (isset($_SESSION['first_name'])) {
require_once (MYSQL);
$id = $_SESSION['user_id'];
$q = "SELECT user_id FROM user_rsvp WHERE user_id='$id '";
$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: " . mysqli_error($dbc));
if (mysqli_num_rows($r) != 0) {
$q = "SELECT user_rsvp, user_meal FROM user_rsvp WHERE user_id='$id '";
$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: " . mysqli_error($dbc));
$row = mysqli_fetch_assoc($r); 
$formCompleted = true;
switch ($row['user_rsvp']){
case 0:
$at = "<span class='text-success'>Attending</span>";
break;
case 1:
$at = "<span class='text-warning'>Not Attending</span>";
break;
default:
$at = "<span class='text-warning'>Not Specified</span>";
}
switch ($row['user_meal']) {
case 0:
$ml = "content/images/chick.png";
break;
case 1:
$ml = "content/images/fish.png";
break;
case 2:
$ml = "content/images/veg.png";
break;
default:
$ml = "content/images/blank-meal.png";
;
}
}
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
echo "<p>Your Currently listed as: " . $at . "<br/>The meal you have chosen was: <img src='" . $ml . "'/></p>";
}
?>
<form action="rsvp.php" method="post">
<div class="form-group">
<label for="attending">Attending</label><br/>
<input type="radio" name="attending" value="0" checked <?php echo $form_disabled?>/><span class="cursive lrg">Yes</span>
<input type="radio" name="attending" value="1" <?php echo $form_disabled?>/><span class="cursive lrg">No</span><br/>
</div>
<div class="form-group">
<label for="food">Food</label><br/>
<input type="radio" name="food" value="0" checked <?php echo $form_disabled?>/><img src="content/images/chick.png" alt="Meat" class="rsvp-img"/>
<input type="radio" name="food" value="1" <?php echo $form_disabled?>/><img src="content/images/fish.png" alt="Fish" class="rsvp-img"/>
<input type="radio" name="food" value="2" <?php echo $form_disabled?>/><img src="content/images/veg.png" alt="Veg" class="rsvp-img"/><br/><br/>
<button type="submit" name="submit" class="btn btn-default" <?php echo $form_disabled?>>RSVP</button>
<input type="hidden" name="submitted" class="btn btn-default" value="TRUE" />
</div>
</form>
<?php include "includes/footer.php";?>