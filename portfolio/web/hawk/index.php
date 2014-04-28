  <?php require_once('dbconnection.php');
mysqli_select_db($conn, $dbname);
$query_Products = "SELECT * FROM items";
$products_Amnt = mysqli_query($conn, $query_Products) or die(mysqli_error());
$totalRows = mysqli_num_rows($products_Amnt);
$recordID = rand(1, $totalRows);
$query_Product_Details = "
    SELECT items.ITEM_NUM, item.item_name, item.item_price, item.item_image
    FROM items
    RIGHT JOIN item
    ON items.ITEM_NUM=item.ITEM_NUM
	WHERE items.ITEM_NUM = $recordID";
$Product_Details = mysqli_query($conn, $query_Product_Details) or die(mysqli_error());
$row_Product_Details= mysqli_fetch_assoc($Product_Details);
$totalRows_Product_Details = mysqli_num_rows($Product_Details);
$product_Name = $row_Product_Details['item_name'];
?>
  <?php $thisPage="home"; $page_title= "Home";?>
  <?php include 'includes/header.php'; ?>
  <div id="page-content">
  <!-- body content -->
  <a id="random-product" href="details.php?recordID=<?php echo $row_Product_Details['ITEM_NUM']; ?>">
  <div id="product" style="background:url(products/<?php echo $row_Product_Details['item_image']; ?>)">
    <div id="product-price">$<?php echo $row_Product_Details['item_price']; ?></div>
  </div>
  <div id="product-name"><?php echo $row_Product_Details['item_name']; ?></div>
  </a>
  <div class="page">
    <h3><?php echo $page_title; ?></h3>
    <p>Welcome to Hawk Concepts! Checkout our products all of which are proudly made in the USA. We also carry products from a few select brands that we trust.</p>
    <p>That a nice bike you've got there! Treat it right! Give it a some new shiny parts to make it stand out from all the other bikes out there. Got an old bike? Make it look new with our custom made parts designed to fit your old rust bucket. Need something we don't have? Send us an email we'll see what we can do!</p>
    <p>Why are you still reading this? Go buy some new parts, time to treat your motorcycle to something it wants for a change.</p>
  </div>
  <div class="clear"></div>
  </div>
  <?php include 'includes/footer.php'; ?>