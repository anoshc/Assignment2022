<?php
include "functions.php";
require_once "classes/class_Product.php";
displayNavBar();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ecommerce - Main Page </title>
</head>

<body>

    <?php

    $product = new Product();
    $products = $product->getData()
    // Have a table to display current products

    
    ?>

    
    <header>
        <?php if ($products != null && count($products) > 0) {
            echo '<td><a href="index.php?=' . $row['product_Name'] . '</a></td>';
        ?>
            <h2>All products</h2>
    </header>
<?php

            createTable($products);
        }
?>


<?php
// Have a table to display current products
// Names of products should be a hyperlink, than when clicked, will lead the user to the specific product page  

?>



</body>

</html>