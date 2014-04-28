<?php 
require_once('dbconnection.php');
$id = (int)$_GET['post'];
$query_entries = "SELECT post_id, post_title, post_date, post_body FROM portfolio_post WHERE post_id=". $id;
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
			<div class="portfolio-entry">
				<h3><?php echo $row_entries['post_title'] ?></h3>
				<h4><?php echo $row_entries['post_date']; ?></h4>
				<div class="portfolio-description">
					<?php echo $row_entries['post_body']; ?>
				</div>
			</div>
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