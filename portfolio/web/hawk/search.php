<?php 
require_once('dbconnection.php'); 
mysqli_select_db($conn, $dbname); 
$searchterm = $_POST['search']; 
$searchterm = strip_tags($searchterm);
$searchterm = trim ($searchterm);
$products_Query = "
SELECT items.ITEM_NUM, item.item_name, item.item_price, item.item_description, item.item_image, companies.company, categories.category
    FROM items
    RIGHT JOIN item
    ON items.ITEM_NUM=item.ITEM_NUM
    LEFT JOIN companies
    on items.CO_ID=companies.CO_ID
    LEFT JOIN categories
    on items.CAT_ID=categories.CAT_ID
    Where item.item_name LIKE '%" . $searchterm . "%'
    OR companies.company LIKE '%" . $searchterm . "%'
    OR categories.category LIKE'%" . $searchterm . "%'"; 
$searchterm . "%'"; 
$products_res = mysqli_query($conn, $products_Query) or die(mysql_error()); 
$row_Products_res = mysqli_fetch_assoc($products_res); 
$totalRows_Products_res = mysqli_num_rows($products_res); 
?>
<?php $page_title= $searchterm; ?>
<?php include 'includes/header.php'; ?>
<div id="page-content">
<?php 
if ($totalRows_Products_res == 0)  
{
echo "Sorry, but we can not find an entry to match your query: <strong>$searchterm</strong></div>";
}
else {
?> 
<div id="search-header">Your search results for: <span><?php echo $searchterm ?></span></div>
<div class="clear"></div>
 <?php do { ?>
  <a class="product-cell" href="details.php?recordID=<?php echo $row_Products_res['ITEM_NUM']; ?>">
   <img src="products/<?php echo $row_Products_res['item_image']; ?>" />
   <div class="product-info">
     <span class="product-title"><?php echo $row_Products_res['item_name']; ?></span>
     <span class="product-co"><?php echo $row_Products_res['company']; ?></span>
   </div>
   <span class="product-price">$<?php echo $row_Products_res['item_price']; ?></span>
  </a>
  <?php } while ($row_Products_res = mysqli_fetch_assoc($products_res)); ?>
  <div class="clear"></div>
</div>
<?php 
mysqli_free_result($products_res); 
}
?>
<?php include 'includes/footer.php'; ?>