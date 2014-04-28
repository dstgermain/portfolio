<?php 
	//insert into db
	require_once('../dbconnection.php');
	$id = (int)$_POST["id"];
	$query_Items = "SELECT exp_ID, employer_name, employer_location, date_start, date_end, job_title, job_description, job_list  FROM resume_entries WHERE exp_ID=" . $id;
	$items = mysqli_query($conn, $query_Items) or die(mysqli_error());
	$update = mysqli_query($conn, $query_Items);
	if (!$update) {
		die(' Failed to update - '.$name);
	}
	mysqli_close($conn);
	$arr = [];
	while ($result = mysqli_fetch_array($items)) { 
		$arr[] = array(
			"id" => $result['exp_ID'],
			"name" => $result['employer_name'],
			"location" => $result['employer_location'],
			"start" => $result['date_start'],
			"end" => $result['date_end'],
			"title" => $result['job_title'],
			"desc" => $result['job_description'],
			"list" => $result['job_list'],
		);
	}
	$html = '<form role="form" id="insert">';
	$html .= '<a href="#" class="close-update">&laquo; Back</a>';
	foreach($arr as $item) {
		$html .= '<input type="hidden" name="id" value="' . $item["id"] . '">';
		$html .= '<div class="form-group">';
		$html .= '<label for="name">Company</label>';
		$html .= '<input type="text" class="form-control input-lg" name="name" id="name" value="'.$item["name"].'">';
		$html .= '</div>';
		$html .= '<div class="form-group">';
		$html .= '<label for="img">Location</label>';
		$html .= '<input type="text" class="form-control input-lg" name="location" id="location" value="'.$item["location"].'"></div>';
		$html .= '<div class="form-group"><label for="url">Start</label>';
		$html .= '<input type="text" class="form-control input-lg" name="start" id="start" value="'.$item["start"].'"></div>';
		$html .= '<div class="form-group"><label for="url">End</label>';
		$html .= '<input type="text" class="form-control input-lg" name="end" id="end" value="'.$item["end"].'"></div>';
		$html .= '<div class="form-group"><label for="url">Title</label>';
		$html .= '<input type="text" class="form-control input-lg" name="title" id="title" value="'.$item["title"].'"></div>';
		$html .= '<div class="form-group">';
		$html .= '<label for="descr">Description</label>';
		$html .= '<textarea class="form-control input-lg" name="descr" id="descr" rows="5">'.$item["desc"].'</textarea>';
		$html .= '</div>';
		$html .= '<div class="form-group">';
		$html .= '<label for="descr">List <small>Enter ";" for seperate list items.</small></label>';
		$html .= '<textarea class="form-control input-lg" name="list" id="list" rows="5">'.$item["list"].'</textarea>';
		$html .= '</div>';
		$html .= '<button type="submit" class="btn btn-default">UPDATE</button>';
	}
	$html .= '</form><div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"><div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="myModalLabel">Success!</h4></div><div class="modal-body"></div></div></div></div>';
	echo $html;
	//if($item["cat_id"]===$list_cat["item_cat"]) "selected".
?>