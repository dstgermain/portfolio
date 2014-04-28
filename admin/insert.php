<?php 
	//insert into db
	require_once('../dbconnection.php');
	$name = $_POST["name"];
	$descr = $_POST["descr"];
	$url = $_POST["url"];
	$cat = $_POST["cat"];
	$img = $_POST["img"];
	$id = (int)$_POST["id"];
	$insert = 'UPDATE portfolio SET item_name="'.$name.'", item_desc="'.$descr.'", item_url="'.$url.'", item_cat='.$cat.', item_img="'.$img.'" WHERE item_ID='.$id;
	$update = mysqli_query($conn, $insert);
	if (!$update) {
		die(' Failed to update - '.$name);
	}
	echo "Updated " . $name;
	mysqli_close($conn);
?>