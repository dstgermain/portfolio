<?php 
require_once('dbconnection.php');

$query_entries = "SELECT post_id, post_title, post_date, post_body FROM portfolio_post ORDER BY post_id DESC";
$items = mysqli_query($conn, $query_entries) or die(mysqli_error());
$row_entries = mysqli_fetch_assoc($items); 
$totalRows_entries = mysqli_num_rows($items);

$query_sidebar = "SELECT sidebar_Content, sidebar_title FROM portfolio_post_sidebar";
$widget = mysqli_query($conn, $query_sidebar) or die(mysqli_error());
$row_widget = mysqli_fetch_assoc($widget); 
$totalRows_widget = mysqli_num_rows($widget);

$page = 'inspiration';
include 'includes/_header.php'; 
include 'includes/_navigation.php';
?>
<div id="main-content" role="main">
	<div class="wrapper inspiration">
		<div class="column-double left">
		<?php do { ?>
			<div class="portfolio-entry">
				<h3><?php echo $row_entries['post_title'] ?></h3>
				<h4><?php echo $row_entries['post_date'] ?></h4>
				<div class="portfolio-description">
					<?php 
						$output = "";
						$string = strip_tags($row_entries['post_body'], '<a><div><img><h1><h2><h3><blockqoute>');
						$words_count = explode(" ", $string);
					    for ($i = 1; $i < 60; $i++) {
					        $output .= $words_count[$i] . " ";
					    }
					    echo "<p>" . $output . "&hellip; <a href='inspiration_entry.php?post=" . $row_entries['post_id'] . "'>Read More</a></p>";
					?>
				</div>
			</div>
		<?php } while ($row_entries = mysqli_fetch_assoc($items)); ?>
		</div>
		<div class="column left">
		<?php do { ?>
			<div class="widget">
				<h4><?php echo $row_widget['sidebar_title'] ?></h4>
				<div class="widget-content">
				<?php echo $row_widget['sidebar_Content'] ?>
				</div>
			</div>
		<?php } while ($row_widget = mysqli_fetch_assoc($widget)); ?>
		</div>
	</div>
</div>
<?php include 'includes/_footer.php'; ?>