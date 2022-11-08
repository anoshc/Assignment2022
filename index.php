<?php
include "functions.php";
require_once "classes/class_User.php";
require_once "classes/class_Product.php";

displayNavBar();
$user = new User();
$user->createAdminUserIfNotExist();

$product = new Product();
$products = $product->getData();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style/main.css">

</head>

<body>

    <?php
    // Have a table to display current products


    if (count($products) > 0) {

        for ($i = 0; $i < count($products); $i++) {

    ?>

            <div class="card">
                <img src="data/<?php echo $products[$i]['image_name']; ?>" width="200" height="200" />
                <a href="productPage.php?id=<?php echo $products[$i]['product_id']; ?>">
                    <?php echo $products[$i]['product_name']; ?></a>
            </div>
    <?php

        }
    }


    ?>

</body>

</html>