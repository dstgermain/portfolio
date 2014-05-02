<?php 
	require_once('../dbconnection.php');

	$query_Items = "SELECT post_id, post_title, post_date, post_body FROM portfolio_post ORDER BY post_id DESC";
	$items = mysqli_query($conn, $query_Items) or die(mysqli_error());	

	$arr = array();
	while ($result = mysqli_fetch_array($items)) { 
		$arr[] = array(
			"id" => $result['post_id'],
			"name" => $result['post_title'],
			"date" => $result['post_date'],
			"body" => $result['post_body'],
		);	
	}
	//echo dirname(__FILE__);
	$edit = count($qy) > 1 && $qy[1][0] === "edit" ? true : false;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://code.jquery.com/jquery-2.1.1-rc1.min.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
		<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<style>
		.col-sm-9 {
			border-left: 1px solid #f0f0f0;
		}
		.nav li {
			border-bottom: 1px solid #f0f0f0;
		}
		.nav li:last-of-type {
			border-bottom: 0;
		}
		</style>
	</head>
	<body>
		<div class="container-fluid" style="margin-top: 20px;">
			<div class="row-fluid">
				<div class="col-sm-3">
					<nav>
						<ul class="nav">
							<li><a href="index.php">Project Entry</a></li>
							<li><a href="resume.php">Resume Entry</a></li>
							<li><a href="post.php">Post Entry</a></li>
						</ul>
					</nav>
				</div>
				<div class="col-sm-9">
					<form class="project-list"> 
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Title</th>
									<th>Date</th>
									<th>Body</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($arr as $item) : ?>
								<tr>
									<td><?php echo $item["name"]; ?></td>
									<td><?php echo $item["date"]; ?></td>
									<td>
										<?php 
											$output = "";
											$string = strip_tags($item['body'], '<a><div><img><h1><h2><h3><blockqoute>');
											$words_count = explode(" ", $string);
										    for ($i = 1; $i < 30; $i++) {
										        $output .= $words_count[$i] . " ";
										    }
										    echo "<p>" . $output . "</p>";
										?>
									</td>
									<td><a href="#" data-update="<?php echo $item["id"]; ?>">edit</a><br><a href="?id=<?php echo $item["id"]; ?>&delete=true">delete</a></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</div>
<script>
$("[data-update]").on("click", function() {
	"use strict";
	var projID = $(this).data("update");
	$(".col-sm-9").block({ message: "Please wait.." });
    $.ajax({
        type: "POST",
        url: "single_post.php",
        data: {id:projID},
        success: function(data){
			$(".col-sm-9").unblock();
			$(".table.table-striped").hide();
            $(".col-sm-9").append(data);
            $(".close-update").on("click", function(){
				location.reload();
            });
            updateFunction();
        }
    });
    return false;
});

function updateFunction() {
	"use strict";
	$("form#insert").submit(function() {
		$(this).block({ message: "Please wait.." });
		var dataString = $(this).serialize();
	    $.ajax({
	        type: "POST",
	        url: "insert_post.php",
	        data: dataString,
	        success: function(data){
				$("form#insert").unblock();
				$("[aria-labelledby=\"mySmallModalLabel\"]").modal("show");
	            $(".modal-body").append(data);
	        }
	    });
	    return false;
	});
}
</script>
	</body>
</html>