<?php
include "functions.php";
require_once "classes/class_Product.php";
require_once "classes/class_Order.php";

$customers = new Customer();
$product = new Product();

displayNavBar();

// Displays the current items in the shopping cart. 
// Cookie can be used to store product ID and quantity of the products in the shopping cart. 
?>
<div class="container">


    <?php

    if (checkIfItemInCart()) {
        $items = getFromFile('shoppingCart.json');
        $total = 0;

    ?>
        <table class="form-group table table-striped">
            <tr class="thead-dark">
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total for this item</th>
            </tr>
            <?php

            foreach ($items as $item) {
            ?>
                <tr>
                    <?php
                    $result = $product->get($item['product_id']);

                    $pName = $result['product_name'];
                    $pPrice = $result['price'];
                    $qty =  $item['quantity'];
                    ?>
                    <td><?php echo $pName; ?></td>
                    <td><?php echo $pPrice; ?></td>
                    <td><?php echo $qty; ?></td>
                    <td><?php echo $qty * $pPrice; ?></td>
                    <?php
                    $total += $qty * $pPrice;
                    ?>
                </tr>
            <?php
            }
            ?>
        </table>

        <h5><?php echo ' Your total is ' . $total; ?></h5>


    <?php

        if (
            isset($_POST['confirm-btn']) &&
            isset($_POST['firstname']) &&
            isset($_POST['lastname']) &&
            isset($_POST['address']) &&
            isset($_POST['country'])
        ) {

            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $address = $_POST['address'];
            $country = $_POST['country'];

            if (empty($firstname)) {
                header("location: shoppingCart.php?error=First name is required");
                echo "First name is required";
                exit();
            } else if (empty($lastname)) {
                header("location: shoppingCart.php?error=Last name is required");
                echo "Last name is required";
                exit();
            } else if (empty($address)) {
                header("location: shoppingCart.php?error=Address is required");
                echo "Address is required";
                exit();
            } else if (empty($country)) {
                header("location: shoppingCart.php?error=Country is required");
                echo "Country is required";
                exit();
            } else {

                $customers->firstname = $firstname;
                $customers->lastname = $lastname;
                $customers->address = $address;
                $customers->country = $country;

                $result = $customers->add();

                if ($result) {

                    $items = getFromFile('shoppingCart.json');


                    foreach ($items as $item) {
                        $pid = $item['product_id'];
                        $qty = $item['quantity'];
                        $customers->insertOrder($pid, $qty);
                    }

                    removeFromCookie();
                    unlink('shoppingCart.json');
                    header('location: ordered.php');
                    exit();
                } else {
                    header("location: shoppingCart.php?error=Something went wrong, try again");
                    exit();
                }
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Ecommerce - Shopping Cart </title>
        <link rel="stylesheet" href="style/main.css">
        <?php getHeader(); ?>
    </head>

    <body>

        <!-- <form action="shoppingCart.php" method="post">
        <div class="input-group">
            <button type="submit" class="pay-btn" name="confirm-btn">Pay</button>
        </div>
    </form> -->

        <form action="shoppingCart.php" method="post">
            <div class="form-group">
                <label for="firstname">First name</label>
                <input type="text" name="firstname" id="firstname" class="form-control" />
            </div>
            <div class="form-group">
                <label for="lastname">Last name</label>
                <input type="text" name="lastname" id="lastname" class="form-control" />
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" />
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="country" name="country" id="country" class="form-control" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" name="confirm-btn">Confirm order</button>
            </div>
        </form>

        <?php
        // Add a button for "Pay", when clicked, a form should appear for the customer to fill in his details, with a final button named "confirm Pay", which adds the order onto the database. 
        // After the order has been added to the database, cookie for the shopping cart should be destroyed. 
        ?>


</div>
<?php getFooter(); ?>
</body>

</html>