<?php 
require_once('dbconnection.php');
$query_entries = "SELECT post_id, post_title, post_date, post_body FROM portfolio_post ORDER BY post_id DESC LIMIT 2";
$entries = mysqli_query($conn, $query_entries) or die(0);
$row_entries = mysqli_fetch_assoc($entries); 
$totalRows_entries = mysqli_num_rows($entries);

$query_Items = "SELECT portfolio.item_ID, portfolio.item_name, portfolio.item_desc, portfolio.item_url, portfolio.item_img, portfolio_cat.cat_name  FROM portfolio INNER JOIN portfolio_cat ON portfolio.item_cat=portfolio_cat.item_cat ORDER BY item_ID DESC LIMIT 6";
$items = mysqli_query($conn, $query_Items) or die(mysqli_error());
$id = array();
$name = array();
$desc = array();
$img = array();
$cat = array();
while ($result = mysqli_fetch_array($items)) { 
	$id[] = $result['item_ID'];
    $name[] = $result['item_name'];
    $desc[] = $result['item_desc'];
    $img[] = $result['item_img'];
    $cat[] = $result['cat_name'];
}
if (!empty($name)) {
	$colOne = array();
	$colTwo = array();
	$colThree = array();
	//first column
	for ($i=0;$i<6;$i++) {
		if (array_key_exists($i, $name)) {
			$arr = array(
				"id" => $id[$i],
				"name" => $name[$i],
				"desc" => $desc[$i],
				"img" => $img[$i],
				"cat" => $cat[$i]
				);
			if ($i===0||$i===3) {
				$colOne[] = $arr;
			} elseif ($i===1||$i===4) {
				$colTwo[] = $arr;
			} else {
				$colThree[] = $arr;
			}
		}
	}
}
$page = 'index';
include 'includes/_header.php'; 
include 'includes/_navigation.php';
?>
<script src="_script/jquery.dotdotdot.min.js" type="text/javascript"></script>
<script src="_script/index.js" type="text/javascript"></script>
<div id="main-content" role="main">
	<div class="wrapper">
	<?php if(!empty($colOne)): ?>
		<div id="col-one" class="column left">
		<?php foreach ($colOne as $item){ ?>
			<a href="project.php?proj=<?php echo $item["id"]; ?>">
				<div class="box">
					<div class="box-inner">
						<div class="box-thumb">
							<img src="<?php if(!is_null($item["img"]) && getimagesize($item["img"]) !== false) { echo $item["img"]; } else { echo "img/placeholder.gif"; } ?>" class="responsive"/>
						</div>
						<h3><?php if(!is_null($item["name"])) echo $item["name"]; ?></h3>
						<div class="box-description">
							<h4><?php if(!is_null($item["cat"])) echo $item["cat"]; ?></h4>
							<p>
								<?php if(!is_null($item["desc"])) echo $item["desc"]; ?>
							</p>
						</div>
					</div><!-- end .box-inner -->
				</div><!-- end .box -->
			</a>
		<?php } ?>
		</div>
	<?php endif; ?>
	<?php if(!empty($colTwo)): ?>
		<div id="col-two" class="column left">
		<?php foreach ($colTwo as $item){ ?>
			<a href="project.php?proj=<?php echo $item["id"]; ?>">
				<div class="box">
					<div class="box-inner">
						<div class="box-thumb">
							<img src="<?php if(!is_null($item["img"]) && getimagesize($item["img"]) !== false) { echo $item["img"]; } else { echo "img/placeholder.gif"; } ?>" class="responsive"/>
						</div>
						<h3><?php if(!is_null($item["name"])) echo $item["name"]; ?></h3>
						<div class="box-description">	
							<h4><?php if(!is_null($item["cat"])) echo $item["cat"]; ?></h4>
							<p>
								<?php if(!is_null($item["desc"])) echo $item["desc"]; ?>
							</p>
						</div>
					</div><!-- end .box-inner -->
				</div><!-- end .box -->
			</a>
		<?php } ?>
		</div>
	<?php endif; ?>
	<?php if(!empty($colThree)): ?>
		<div id="col-three" class="column left">
		<?php foreach ($colThree as $item){ ?>
			<a href="project.php?proj=<?php echo $item["id"]; ?>">
				<div class="box">
					<div class="box-inner">
						<div class="box-thumb">
							<img src="<?php if(!is_null($item["img"]) && getimagesize($item["img"]) !== false) { echo $item["img"]; } else { echo "img/placeholder.gif"; } ?>" class="responsive"/>
						</div>
						<h3><?php if(!is_null($item["name"])) echo $item["name"]; ?></h3>
						<div class="box-description">
							<h4><?php if(!is_null($item["cat"])) echo $item["cat"]; ?></h4>
							<p>
								<?php if(!is_null($item["desc"])) echo $item["desc"]; ?>
							</p>
						</div>
					</div><!-- end .box-inner -->
				</div><!-- end .box -->
			</a>
		<?php } ?>
		</div>
	<?php endif; ?>
	</div>
	<div class="wrapper">
		<div id="blog-posts">
		<h2>Recent Blog Posts</h2>
			<?php do { ?>
				<div class="index-blog">
					<div class="blog-inner">
						<h3><?php echo $row_entries['post_title'] ?></h3>
						<h4><?php echo $row_entries['post_date'] ?></h4>
						<div class="portfolio-description">
							<?php 
							    $output = "";
								$string = strip_tags($row_entries['post_body'], '<a><div><img><h1><h2><h3><blockqoute>');
								$words_count = explode(" ", $string);
							    for ($i = 1; $i < 30; $i++) {
							        $output .= $words_count[$i] . " ";
							    }
							    echo "<p>" . $output . "&hellip; <a href='inspiration_entry.php?post=" . $row_entries['post_id'] . "'>Read More</a></p>";
							?>
						</div>
					</div>
				</div>
			<?php } while ($row_entries = mysqli_fetch_assoc($entries)); ?>
		</div>
	</div>
</div><!-- end .content -->
<?php include 'includes/_footer.php'; ?>