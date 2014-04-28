<?php 

require_once('dbconnection.php');
$query_projects = "SELECT portfolio.item_ID, portfolio.item_name, portfolio.item_img, portfolio_cat.cat_name  FROM portfolio INNER JOIN portfolio_cat ON portfolio.item_cat=portfolio_cat.item_cat ORDER BY portfolio.item_ID DESC";
$items = mysqli_query($conn, $query_projects) or die(mysqli_error());
$vector = array();
$multi = array();
$website = array();
$banner = array();
while ($result = mysqli_fetch_array($items)) {
	if ($result["cat_name"] === "Website Design & Development") {
		$website[] = array(
			"name"=>$result["item_name"],
			"img"=>$result["item_img"],
			"id"=>$result["item_ID"],
		);
	} elseif ($result["cat_name"] === "Multimedia & Flash") {
		$multi[] = array(
			"name"=>$result["item_name"],
			"img"=>$result["item_img"],
			"id"=>$result["item_ID"],
		);
	} elseif ($result["cat_name"] === "Web Banners") {
		$banner[] = array(
			"name"=>$result["item_name"],
			"img"=>$result["item_img"],
			"id"=>$result["item_ID"],
		);
	} else {
		$vector[] = array(
			"name"=>$result["item_name"],
			"img"=>$result["item_img"],
			"id"=>$result["item_ID"],
		);
	}
}

$page = 'portfolio';
include 'includes/_header.php'; 
include 'includes/_navigation.php';
?>
<div id="main-content" role="main">
	<div class="wrapper portfolio">
		<h3>Website Development</h2>
		<?php foreach ($website as $item): ?>
			<div class="column left">
				<a href="project.php?proj=<?php echo $item["id"] ?>" class="port-item">
					<img src="<?php echo $item["img"] ?>" class="responsive"/>
					<div class="item-name">
						<h3><?php echo $item["name"]?></h3>
					</div>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="wrapper portfolio">
		<h3>Vector Art Work</h2>
		<?php foreach ($vector as $item): ?>
			<div class="column left">
				<a href="project.php?proj=<?php echo $item["id"] ?>" class="port-item">
					<img src="<?php echo $item["img"] ?>" class="responsive"/>
					<div class="item-name">
						<h3><?php echo $item["name"]?></h3>
					</div>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="wrapper portfolio">
		<h3>Multimedia</h2>
		<?php foreach ($multi as $item): ?>
			<div class="column left">
				<a href="project.php?proj=<?php echo $item["id"] ?>" class="port-item">
					<img src="<?php echo $item["img"] ?>" class="responsive"/>
					<div class="item-name">
						<h3><?php echo $item["name"]?></h3>
					</div>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="wrapper portfolio">
		<h3>Web Banners</h2>
		<?php foreach ($banner as $item): ?>
			<div class="column left">
				<a href="project.php?proj=<?php echo $item["id"] ?>" class="port-item">
					<img src="<?php echo $item["img"] ?>" class="responsive"/>
					<div class="item-name">
						<h3><?php echo $item["name"]?></h3>
					</div>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<?php include 'includes/_footer.php'; ?>