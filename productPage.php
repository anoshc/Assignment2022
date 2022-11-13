<?php
include "functions.php";
require_once "classes/class_User.php";
require_once "classes/class_Product.php";

displayNavBar();
$product = new Product();
//$products = $product->getData();


if (!isset($_GET["id"]) && empty($_POST["pid"])) {
    header('location: index.php');
    exit();
}

$productId;

if (isset($_GET["id"])) {
    $productId = htmlspecialchars($_GET["id"]);
} else if (!empty($_POST["pid"])) {
    $productId = $_POST["pid"];
}

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

if (isset($_POST['addToCart-btn'])) {

    if (empty($_POST["quantity"])) {
        header('location: productPage.php?id=' . $pid);
        exit();
    }

    cart($pid, $_POST['quantity']);
    setcookie('cart', 1, time() + (86400 * 7), '/', false, 'httponly');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ecommerce - Product Page </title>
    <?php getHeader(); ?>
</head>

<body>


    <div class="container">
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
            <div class="qty-form form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" />
                <input type="hidden" name="pid" id="pid" value="<?php echo $pid; ?>" />
            </div>
            <div class="qty-form">
                <button type="submit" class="btn btn-primary" name="addToCart-btn">Add to cart</button>
            </div>
        </form>

    </div>


    <?php getFooter(); ?>
</body>

</html>