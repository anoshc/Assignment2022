<?php
include "functions.php";
require_once "classes/class_Product.php";
require_once "classes/class_Order.php";

$customers = new Customer();
$product = new Product();

displayNavBar();

// Displays the current items in the shopping cart. 
// Cookie can be used to store product ID and quantity of the products in the shopping cart. 

if (checkIfItemInCart()) {
    $items = getFromFile('shoppingCart.json');

    $total = 0;
    foreach ($items as $item) {

        $result = $product->get($item['product_id']);


        $displayArray[$idx]['Product name'] = $item[$pName];
        $displayArray[$idx]['Price'] = $item[$pPrice];
        $displayArray[$idx]['Quantity'] = $item[$qty];
        createTable($displayArray);


        $pName = $result['product_name'];
        $pPrice = $result['price'];
        $qty =  $item['quantity'];


        echo $pName;
        echo $pPrice;
        echo $qty;
        echo $qty * $pPrice . '<br>';

        $total += $qty * $pPrice;
    }

    echo ' your total is ' .  $total . '<br>';



    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['address']) && isset($_POST['country']) != "") {


        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $country = $_POST['country'];

        if (empty($firstname)) {
            header("location: shoppingCart.php?error=First name is required");
            exit();
        } else if (empty($lastname)) {
            header("location: shoppingCart.php?error=Last name is required");
            exit();
        } else if (empty($address)) {
            header("location: shoppingCart.php?error=Address is required");
            exit();
        } else if (empty($country)) {
            header("location: shoppingCart.php?error=Country is required");
            exit();
        } else {

            $customers->firstname = $firstname;
            $customers->lastname = $lastname;
            $customers->address = $address;
            $customers->country = $country;

            $result = $customers->customers($firstname, $lastname, $address, $country);

            if ($result > 0) {
                header('location: shoppingCart.php');
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
</head>

<body>

    <form action="shoppingCart.php" method="post">
        <div class="input-group">
            <button type="submit" class="pay-btn" name="confirm-btn">Pay</button>
        </div>
    </form>

    <form action="shoppingCart.php" method="post">

        <div class="input-group">
            <label for="firstname">First name</label>
            <input type="text" name="firstname" id="firstname" />
        </div>
        <div class="input-group">
            <label for="lastname">Last name</label>
            <input type="text" name="lastname" id="lastname" />
        </div>
        <div class="input-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" />
        </div>
        <div class="input-group">
            <label for="country">Country</label>
            <input type="country" name="country" id="country" />
        </div>
        <div class="input-group">
            <button type="submit" class="confirm-btn" name="confirm-btn">Confirm order</button>
        </div>
    </form>

    <?php
    // Add a button for "Pay", when clicked, a form should appear for the customer to fill in his details, with a final button named "confirm Pay", which adds the order onto the database. 
    // After the order has been added to the database, cookie for the shopping cart should be destroyed. 
    ?>




</body>

</html>