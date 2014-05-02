<?php 
	//insert into db
	require_once('../dbconnection.php');
	$id = (int)$_POST["id"];
	$query_Items = 'SELECT post_id, post_title, post_date, post_body FROM portfolio_post WHERE post_id=' . $id;
	$items = mysqli_query($conn, $query_Items) or die(mysqli_error());
	if (!$items) {
		die(' Failed to update - '.$name);
	}
	mysqli_close($conn);
	$arr = array();
	while ($result = mysqli_fetch_array($items)) { 
		$arr[] = array(
			"id" => $result['post_id'],
			"title" => $result['post_title'],
			"date" => $result['post_date'],
			"body" => $result['post_body'],
		);	
	}
	$html = '<form role="form" id="insert">';
	$html .= '<a href="#" class="close-update">&laquo; Back</a>';
	foreach($arr as $item) {
		$html .= '<input type="hidden" name="id" id="id" value="' . $item["id"] . '">';
		$html .= '<div class="form-group">';
		$html .= '<label for="name">Post Title</label>';
		$html .= '<input type="text" class="form-control input-lg" name="title" id="title" value="'.$item["title"].'">';
		$html .= '</div>';
		$html .= '<div class="form-group">';
		$html .= '<label for="img">Date</label>';
		$html .= '<input type="text" class="form-control input-lg" name="date" id="date" value="'.$item["date"].'"></div>';
		$html .= '<div class="form-group"><label for="url">Post Body</label>';
		$html .= '<textarea type="text" class="form-control input-lg" name="body" id="body" rows="10">'.$item["body"].'</textarea></div>';
		$html .= '<button type="submit" class="btn btn-default">UPDATE</button>';
	}
	$html .= '</form><div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"><div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="myModalLabel">Success!</h4></div><div class="modal-body"></div></div></div></div>';
	echo $html;
	//if($item["cat_id"]===$list_cat["item_cat"]) "selected".
?>