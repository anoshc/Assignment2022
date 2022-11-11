<?php
include "functions.php";
require_once "classes/class_User.php";
require_once "classes/class_Product.php";

displayNavBar();
$product = new Product();
//$products = $product->getData();

if (isset($_POST['addToCart-btn'])){

    $quantity = $_POST['quantity'];
    cart($productId, $quantity);
    setcookie('addToCart-btn', 1, time() + (86400 * 7), 'localhost', false, 'httponly');
    
}


if (!isset($_GET["id"])) {
    header('location: index.php');
    exit();
}

$productId = htmlspecialchars($_GET["id"]);

$result = $product->get($productId);


if ($result == null) {
    header('location: index.php');
    exit();
}

$pid = $result['product_id'];
$pName = $result['product_name'];
$pDes = $result['description'];
$pImage = $result['image_name'];
$pPrice = $result['price'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce - Product Page </title>
    <link rel="stylesheet" href="style/main.css">
</head>

<body>


    <!-- 
         Display specific information about product selected in the previous page.
        Note that the product page can only be accessed from the main page. 
     -->

    <h2>Product name: <?php echo $pName; ?></h2>
    <img src="data/<?php echo $pImage ?>" width="150" height="150" />
    <p>Product description: <?php echo $pDes; ?></p>
    <p>Product Price: <?php echo $pPrice; ?> KR</p>



    <!-- // Shopping cart information can be preserved in a cookie. If the user closes the browser and reopens the page, the shopping cart information can be repopulated from the cookie. 
    // Modify the shopping cart link in the navigation bar when an item is added to it.  -->


    <!-- Add a form : with a select field to choose quantity, and a submit button named "Add to cart", which will populate the shopping cart. -->
    <form action="productPage.php" method="post">
        <div class="qty-form">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity">
        </div>
        <div class="qty-form">
            <button type="submit" class="addToCart-btn" name="addToCart-btn">Add to cart</button>
        </div>
    </form>



</body>

</html>