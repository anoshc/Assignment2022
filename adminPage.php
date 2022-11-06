<?php
include "functions.php";
require "classes/class_Product.php";
displayNavBar();

if (isset($_POST['submit'])) {
    $product = new Product();

    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // step 1 - check if any of the value from form is empty, if yes give error message to user and stop the process

    if (empty($product_name)) {
        header("location: adminPage.php?error=Password is required");
        exit();
    } else if (empty($description)) {
        //$_POST = array();
        echo "Description is required";
        return;
    } else if (empty($price)) {
        //$_POST = array();
        echo "Price is required";
        return;
    }

    $result = $product->addProductToDB($product_name, $description, $price);
    if ($result > 0) {
        header('location: adminPage.php');
        exit();
    } else {
        header("location: adminPage.php?error=Incorrect username or password");
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <title>Ecommerce - Admin Area </title>
</head>

<body>

    <h2>Create new product</h2>

    <form action="adminPage.php" method="post">
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <div class="input-group">
            <label for="product_name">Product name</label>
            <input type="text" id="product_name" name="product_name"><br>
        </div>
        <div class="input-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description"><br>
        </div>
        <div class="input-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" /><br>
        </div>
        <div class="input-group">
            <button type="submit" id="submit" name="submit" class="button">
                Submit
            </button>
        </div>
    </form>

    <?php

    // Have a table to display current products

    // Add a form  to create a new product

    // Add functionality to delete an existing product



    ?>



</body>

</html>