<?php
include "functions.php";
require_once "classes/class_User.php";
require_once "classes/class_Product.php";

displayNavBar();
$product = new Product();
$products = $product->getData();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ecommerce - Product Page </title>
    <link rel="stylesheet" href="style/main.css">
</head>

<body>

    <div class="row">
        <?php

        if (count($products) > 0) {

            for ($i = 0; $i < count($products); $i++) {
                echo $products[$i]['product_id'];
                echo $products[$i]['product_name'];
        ?>
                <img src="data/<?php echo $products[$i]['image_name']; ?>" width="100" height="100" />
                <?php
                echo $products[$i]['description'];
                echo $products[$i]['price'] . "<br>";
                ?>

    </div>
<?php
            }
        }



        // Display specific information about product selected in the previous page. 
        // Note that the product page can only be accessed from the main page. 
        // Add a form : with a select field to choose quantity, and a submit button named "Add to cart", which will populate the shopping cart. 
        // Shopping cart information can be preserved in a cookie. If the user closes the browser and reopens the page, the shopping cart information can be repopulated from the cookie. 
        // Modify the shopping cart link in the navigation bar when an item is added to it. 


?>



</body>

</html>