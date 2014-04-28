<?php 
require_once('dbconnection.php'); 
mysqli_select_db($conn, $dbname); 
$sort = $_GET['sortID'];
switch ($sort) {
	case "1":
	$sort = "item.item_price DESC";
	break;
	case "2":
	$sort = "item.item_price";
	break;
	default:
	$sort = "item.item_name";
	break;
}
$query_Products = "
SELECT items.ITEM_NUM, item.item_name, item.item_price, item.item_image, companies.company
FROM items
RIGHT JOIN item
ON items.ITEM_NUM=item.ITEM_NUM
LEFT JOIN companies
on items.CO_ID=companies.CO_ID
ORDER BY ". $sort ."
"; 
$Products = mysqli_query($conn, $query_Products) or die(mysqli_error()); 
$row_Products = mysqli_fetch_assoc($Products); 
$totalRows_Products = mysqli_num_rows($Products); 
?>
<?php $thisPage="catalog"; $page_title="Products"; ?>
<?php include 'includes/header.php'; ?>
<div id="page-content">
<div id="sort">
Sort By:
<div id="sort-by">
<div <?php if ($_GET['sortID'] == "") { echo "class='selected'"; } ?> sort-value="">Name</div>
<div <?php if ($_GET['sortID'] == "1") { echo "class='selected'"; } ?> sort-value="1">Price - High to Low</div>
<div <?php if ($_GET['sortID'] == "2") { echo "class='selected'"; } ?> sort-value="2">Price - Low to High</div>
</div>
</div>
 <?php do { ?>
  <a class="product-cell" href="details.php?recordID=<?php echo $row_Products['ITEM_NUM']; ?>">
   <img src="products/<?php echo $row_Products['item_image']; ?>" />
   <div class="product-info">
     <span class="product-title"><?php echo $row_Products['item_name']; ?></span>
     <span class="product-co"><?php echo $row_Products['company']; ?></span>
   </div>
   <span class="product-price">$<?php echo $row_Products['item_price']; ?></span>
  </a>
  <?php } while ($row_Products = mysqli_fetch_assoc($Products)); ?>
  <div class="clear"></div>
</div>
<script src="master-page.js" type="text/javascript"></script>
<?php
mysqli_free_result($Products);
?>
<?php include 'includes/footer.php'; ?>