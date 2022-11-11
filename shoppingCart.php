<?php
include "functions.php";
require_once "classes/class_Product.php";

$product = new Product();

displayNavBar();

// Displays the current items in the shopping cart. 
// Cookie can be used to store product ID and quantity of the products in the shopping cart. 

if (checkIfItemInCart()) {
    $items = getFromFile('shoppingCart.json');

    $total = 0;
    foreach ($items as $item) {

        $result = $product->get($item['product_id']);
        $pid = $result['product_id'];
        $pName = $result['product_name'];
        $pPrice = $result['price'];
        $qty =  $item['quantity'];

        echo ' pName ' . $pName;
        echo ' pPrice ' . $pPrice;
        echo ' qty ' . $qty;
        echo ' total ' .  $qty * $pPrice . '<br>';

        $total += $qty * $pPrice;
    }

    echo ' your total is ' .  $total . '<br>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ecommerce - Shopping Cart </title>
</head>

<body>

    <?php



    // Add a button for "Pay", when clicked, a form should appear for the customer to fill in his details, with a final button named "confirm Pay", which adds the order onto the database. 
    // After the order has been added to the database, cookie for the shopping cart should be destroyed. 


    ?>




</body>

</html>