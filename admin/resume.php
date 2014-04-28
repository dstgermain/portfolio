<?php 
	require_once('../dbconnection.php');

	$query_Items = "SELECT exp_ID, employer_name, employer_location, date_start, date_end, job_title, job_description, job_list  FROM resume_entries ORDER BY exp_ID";
	$items = mysqli_query($conn, $query_Items) or die(mysqli_error());	

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
		.table {
			
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
									<th>ID</th>
									<th>Employee Name</th>
									<th>Location</th>
									<th>Start</th>
									<th>End</th>
									<th>Job Title</th>
									<th>Description</th>
									<th>List</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($arr as $item) : ?>
								<tr>
									<td name="id" value="<?php echo $item["id"]; ?>"><?php echo $item["id"]; ?></td>
									<td><?php echo $item["name"]; ?></td>
									<td><?php echo $item["location"]; ?></td>
									<td><?php echo $item["start"]; ?></td>
									<td><?php echo $item["end"]; ?></td>
									<td><?php echo $item["title"]; ?></td>
									<td><?php echo $item["desc"]; ?></td>
									<td><?php echo $item["list"]; ?></td>
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
        url: "single_resume.php",
        data: {id:projID},
        success: function(data){
			$(".col-sm-9").unblock();
			$(".table.table-striped").hide();
            $(".col-sm-9").append(data);
            $(".close-update").on("click", function(){
				$(".table.table-striped").show();
				$("#insert").hide();
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
	        url: "insert_resume.php",
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