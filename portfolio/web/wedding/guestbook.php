<?php 
ob_start();
session_start();
require_once ('includes/config.inc.php');
require_once (MYSQL);
$updated = $updateUser = "";
$idUpdate = null;
if (isset($_POST['submitted'])) {
$trimmed = array_map('trim', $_POST);
$idUpdate = mysqli_real_escape_string($dbc, $trimmed['userId']);
$att = mysqli_real_escape_string($dbc, $trimmed['attending']);
$meal = mysqli_real_escape_string($dbc, $trimmed['meal']);
$qu = "UPDATE user_rsvp SET user_rsvp='$att', user_meal='$meal' WHERE user_id='$idUpdate'";
$update = mysqli_query ($dbc, $qu) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
if (mysqli_affected_rows($dbc) > 0) {
$updated = "<span class='text-success'>Updated</span>";
} else {
$updated = "<span class='text-warning'>An Error Occured try again</span>";
}
} 

$q = "SELECT user_rsvp.user_id, user_rsvp.user_rsvp, user_rsvp.user_meal, users.first_name, users.last_name FROM user_rsvp INNER JOIN users ON user_rsvp.user_id=users.user_id WHERE user_rsvp.user_rsvp=0";
$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: " . mysqli_error($dbc));
$row = mysqli_fetch_assoc($r);
$count = mysqli_num_rows($r);

include "includes/header.php";
?>
<h3 class="page-header">Guestbook</h3>
<p>This list only contains attending guests</p>
<p>Guests attending: <?php echo $count; ?></p>
<table class="table table-striped">
<thead>
<th>Last Name</th>
<th>First Name</th>
<th>Meal</th>
<?php 
if (isset($_SESSION['user_id'])) {
echo "<th>Edit</th>";
}
?>
</thead>
<tbody>
<?php Do {
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
}?>
<?php 
echo "<tr><td valign='middle'>" . $row['last_name'] . "</td><td valign='middle'>" . $row['first_name'] . "</td><td valign='middle'><img src='" . $ml . "'/><td/>";
if (isset($updated) && $idUpdate == $row['user_id']) {
$updateUser = $updated;
}
if ((isset($_SESSION['user_level']) && $_SESSION['user_level'] == 1) || (isset($_SESSION['user_id']) && $row['user_id'] == $_SESSION['user_id'])) {
echo "<td valign='middle' class='relative'>
<button class='btn btn-default' data-edit='0'>Edit</button>
<div data-edit-info='1'>
<form action='guestbook.php' method='post'>
<div class='form-group'>
<label>Attending: </label>
<input type='radio' name='attending' value='0' checked >YES 
<input type='radio' name='attending' value='1'>NO
</div>
<div class='form-group'>
<label>Meal: </label>
<select name='meal'>
<option value='0'>Meat</option>
<option value='1'>Fish</option>
<option value='2'>Vegetarian</option>
</select>
</div>
<input name='userId' type='text' class='hidden' value=".$row['user_id'].">
<button type='submit' class='btn btn-default'>Update</button>
<input type='hidden' name='submitted' class='btn btn-default' value='TRUE' />
</form>
</div>".$updateUser."</td>";
} else {
echo "<td></td>";
}
echo "</tr>";
?>
<?php } while ($row = mysqli_fetch_assoc($r)); ?>
</tbody>
</table>
<script type="text/javascript" src="content/scripts/guest_book.js"></script>
<?php include "includes/footer.php";?>