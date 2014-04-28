<?php require_once('dbconnection.php');
mysqli_select_db($conn, $dbname);
$recordID = $_GET['recordID'];
$query_Product_Details = "
    SELECT items.ITEM_NUM, item.item_name, item.item_price, item.item_description, item.item_image, companies.company, categories.category
    FROM items
    RIGHT JOIN item
    ON items.ITEM_NUM=item.ITEM_NUM
    LEFT JOIN companies
    on items.CO_ID=companies.CO_ID
    LEFT JOIN categories
    on items.CAT_ID=categories.CAT_ID
	WHERE items.ITEM_NUM = $recordID";
$Product_Details = mysqli_query($conn, $query_Product_Details) or die(mysqli_error());
$row_Product_Details= mysqli_fetch_assoc($Product_Details);
$totalRows_Product_Details = mysqli_num_rows($Product_Details);
$product_Name = $row_Product_Details['item_name'];
?>
<?php $thisPage="catalog"; $page_title= $product_Name; ?>
<?php include 'includes/header.php'; ?>
  <div id="page-content">
    <div id="item-image"><img src="products/<?php echo $row_Product_Details['item_image']; ?>" /> </div>
    <div id="item-description">
      <p class="item-name"><?php echo $row_Product_Details['item_name']; ?>
      <span class="item-co"><?php echo $row_Product_Details['company']; ?></span>
      </p>
      <p class="item-price">$<?php echo $row_Product_Details['item_price']; ?></p>
      <p class="item-desc"><?php echo $row_Product_Details['item_description']; ?>
      <span class="item-cat">Category: <?php echo $row_Product_Details['category']; ?></span>
      </p>
    </div>
    <div class="clear"></div>
  </div>
  <?php
mysqli_free_result($Product_Details);
?>
  <?php include 'includes/footer.php'; ?>