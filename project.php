<?php 
require_once('dbconnection.php');
$id = (int)$_GET['proj'];
$query_project = "SELECT portfolio.item_ID, portfolio.item_site, portfolio.item_name, portfolio.item_desc, portfolio.item_url, portfolio.item_img, portfolio_cat.cat_name  FROM portfolio INNER JOIN portfolio_cat ON portfolio.item_cat=portfolio_cat.item_cat WHERE portfolio.item_ID=" . $id;
$items = mysqli_query($conn, $query_project) or die(mysqli_error());
$row_entries = mysqli_fetch_assoc($items); 
$totalRows_entries = mysqli_num_rows($items);

$page = 'portfolio';
include 'includes/_header.php'; 
include 'includes/_navigation.php';
?>
<div id="main-content" role="main">
	<div class="wrapper portfolio">
		<div class="column right">
			<h3><?php echo $row_entries["item_name"]; ?></h3>
			<h4><?php echo $row_entries["cat_name"]; ?></h4>
			<p><?php echo $row_entries["item_desc"]; ?></p>
			<p><?php if(isset($row_entries["item_site"])) echo "<a href='" . $row_entries["item_site"] . "' target='_blank'>Visit Site</a>."; ?></p>
		</div>
		<div class="column-double left">
			<div id="main-image">
				<img src="<?php echo $row_entries["item_url"] ?>" class="responsive"/>
			</div>
			<div id="secondary-images">
				
			</div>
		</div>
	</div>
</div>
<?php include 'includes/_footer.php'; ?>