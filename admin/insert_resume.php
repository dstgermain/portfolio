<?php 
	//insert into db
	require_once('../dbconnection.php');
	$name = $_POST["name"];
	$loc = $_POST["location"];
	$start = $_POST["start"];
	$end = $_POST["end"];
	$title = $_POST["title"];
	$desc = $_POST["desc"];
	$list = $_POST["list"];
	$id = (int)$_POST["id"];
	$insert = 'UPDATE resume_entries SET employer_name="'.$name.'", employer_location="'.$loc.'", date_start="'.$start.'", date_end="'.$end.'", job_title="'.$title.'", job_description="'.$desc.'", job_list="'.$list.'" WHERE exp_ID='.$id;
	$update = mysqli_query($conn, $insert);
	if (!$update) {
		die(' Failed to update - '.$name);
	}
	echo "Updated " . $name;
	mysqli_close($conn);
?>