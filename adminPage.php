<?php
include "functions.php";
require_once "classes/class_User.php";
require_once "classes/class_Product.php";
$user = new User();

if (!$user->isAdmin()) {
    header("location: index.php");
}

displayNavBar();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ecommerce - Admin Area </title>
    <link rel="stylesheet" href="style/main.css">

</head>

<body>

    <?php

    $product = new Product();
    $products = $product->getData()
    // Have a table to display current products
    ?>
    <header>
        <?php if ($products != null && count($products) > 0) { ?>
            <h2>All products</h2>
    </header>
<?php

            createTable($products);

            echo "<hr>";
        }


        //createTable();

        // Add a form  to create a new product


        if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price']) && $_FILES['my_file']['name'] != "") {


            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            if (empty($name)) {
                header("location: adminPage.php?error=Product name is required");
                exit();
            } else if (empty($description)) {
                header("location: adminPage.php?error=Description is required");
                exit();
            } else if (empty($price)) {
                header("location: adminPage.php?error=Price is required");
                exit();
            } else {

                $product->product_Name = $name;
                $product->description = $description;
                $product->price = $price;
                $product->image = uploadProductImage($_FILES);

                echo $product->image;

                $result = $product->addProductToDB();

                if ($result > 0) {
                    header('location: adminPage.php');
                    exit();
                } else {
                    header("location: adminPage.php?error=Something went wrong, try again");
                    exit();
                }
            }
        }

        // Add functionality to delete an existing product


        if (isset($_POST['product_id'])) {


            $product_id = $_POST['product_id'];

            if (!empty($product_id)) {

                $result = $product->deleteProduct($product_id);

                if ($result > 0) {
                    header('location: adminPage.php');
                    exit();
                } else {
                    header("location: adminPage.php?error=Something went wrong, try again");
                    exit();
                }
            }
        }

        if ($products != null && count($products) > 0) {



?>

    <header>
        <h2>Delete a product</h2>
    </header>
    <form action="adminPage.php" method="post">
        <div class="input-group">
            <label for="product_id">Product id</label>
            <input type="number" name="product_id" id="product_id">
        </div>

        <div class="input-group">
            <button type="submit" class="btn" name="login-btn">Delete</button>
        </div>
    </form>

    <hr>

<?php

        }


?>


<header>
    <h2>Create a new product</h2>
</header>

<form action="adminPage.php" method="post" enctype='multipart/form-data'>
    <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <div class="input-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
    </div>
    <div class="input-group">
        <label for="description">Description</label>
        <input type="text" name="description" id="description">
    </div>
    <div class="input-group">
        <label for="price">Price</label>
        <input type="number" name="price" id="price">
    </div>
    <div class="input-group">
        <label for="my_file">Product Image</label>
        <input type="file" name="my_file" id="my_file">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="login-btn">Create</button>
    </div>
</form>



</body>

</html>