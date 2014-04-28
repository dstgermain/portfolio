<?php 
	//insert into db
	require_once('../dbconnection.php');
	$id = (int)$_POST["id"];
	$query_Items = "SELECT portfolio.item_ID, portfolio.item_name, portfolio.item_desc, portfolio.item_url, portfolio.item_img, portfolio_cat.cat_name, portfolio.item_cat  FROM portfolio INNER JOIN portfolio_cat ON portfolio.item_cat=portfolio_cat.item_cat WHERE portfolio.item_ID=" . $id;
	$query_cat = "SELECT * FROM portfolio_cat";
	$items = mysqli_query($conn, $query_Items) or die(mysqli_error());
	$cats = mysqli_query($conn, $query_cat) or die(mysqli_error());
	$list_cats = [];
	while ($cat = mysqli_fetch_array($cats)) {
	    $list_cats[] = $cat;
	}
	$update = mysqli_query($conn, $query_Items);
	if (!$update) {
		die(' Failed to update - '.$name);
	}
	mysqli_close($conn);
	$arr = [];
	while ($result = mysqli_fetch_array($items)) { 
		$arr[] = array(
			"id" => $result['item_ID'],
			"name" => $result['item_name'],
			"cat" => $result['cat_name'],
			"cat_id" => $result['item_cat'],
			"desc" => $result['item_desc'],
			"img" => $result['item_img'],
			"url" => $result['item_url'],
		);	
	}
	$html = '<form role="form" id="insert">';
	$html .= '<a href="#" class="close-update">&laquo; Back</a>';
	foreach($arr as $item) {
		$html .= '<input type="hidden" name="id" value="' . $item["id"] . '">';
		$html .= '<div class="form-group">';
		$html .= '<label for="name">Project Name</label>';
		$html .= '<input type="text" class="form-control input-lg" name="name" id="name" value="'.$item["name"].'">';
		$html .= '</div><div class="form-group"><label for="cat">Category</label>';	
		$html .= '<select class="form-control input-lg" name="cat" id="cat">';
		foreach($list_cats as $list_cat) {
			$html .= '<option value="'.$list_cat["item_cat"].'"'.'>'.$list_cat["cat_name"].'</option>';
		}
		$html .= '</select></div>';
		$html .= '<div class="form-group">';
		$html .= '<label for="descr">Description</label>';
		$html .= '<textarea class="form-control input-lg" name="descr" id="descr" rows="10">'.$item["desc"].'</textarea>';
		$html .= '</div>';
		$html .= '<div class="form-group">';
		$html .= '<label for="img">Image</label>';
		$html .= '<input type="text" class="form-control input-lg" name="img" id="img" value="'.$item["img"].'">';
		$html .= '</div><div class="form-group"><label for="url">Url</label>';
		$html .= '<input type="text" class="form-control input-lg" name="url" id="url" value="'.$item["url"].'">';
		$html .= '</div><button type="submit" class="btn btn-default">UPDATE</button>';
	}
	$html .= '</form><div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"><div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="myModalLabel">Success!</h4></div><div class="modal-body"></div></div></div></div>';
	echo $html;
	//if($item["cat_id"]===$list_cat["item_cat"]) "selected".
?>