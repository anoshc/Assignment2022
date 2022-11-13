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
    <?php getHeader(); ?>

</head>

<body>

    <div class="container">
        <div class="row">
            <?php
            // Have a table to display current products


            if (count($products) > 0) {

                for ($i = 0; $i < count($products); $i++) {

            ?>
                    <div class="col-sm-3 mr-5 mb-5">
                        <div class="card" style="width: 18rem;">
                            <img src="data/<?php echo $products[$i]['image_name']; ?>" class="card-img-top" />
                            <div class="card-body">
                                <h5 class="card-title"> <?php echo $products[$i]['product_name']; ?></a></h5>
                                <a class="btn btn-primary" href="productPage.php?id=<?php echo $products[$i]['product_id']; ?>">Details</a>
                            </div>
                        </div>
                    </div>

            <?php

                }
            }


            ?>
        </div>
    </div>
    <?php getFooter(); ?>


</body>

</html>