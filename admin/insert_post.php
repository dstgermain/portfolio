<?php 
	//insert into db
	require_once('../dbconnection.php');
	$date = $_POST["date"];
	$title = $_POST["title"];
	$body = $_POST["body"];
	$id = (int)$_POST["id"];
	$insert = "UPDATE portfolio_post SET post_title=\"".$title."\", post_date=\"".$date."\", post_body=\"".$body."\" WHERE post_id=".$id;
	$items = mysqli_query($conn, $insert) or die(mysqli_error());
	$rows = mysqli_affected_rows($conn);
	if (!$items) {
		die(' Failed to update - '.$title);
	}
	echo "Updated " . $title ." ( Rows Affected: ". $rows ." )";
	mysqli_close($conn);
?>