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

<table>
    <tr>
        <th>Product id</th>
        <th>Product name</th>
        <th>Image name</th>
        <th>Description</th>
        <th>Price</th>
    </tr>
<?php
// Have a table to display current products
$connection = $this->connect();
$sql = "SELECT * FROM products";
$result = $connection->query($sql);

if($result->num_rows > 0){
    while ($row = $result-> fetch_assoc()){
        echo "<tr><td>" . $row['$product_id'] . "</td><td>" . $row['product_Name'] . "</td><td>" . $row['image_name'] . "</td><td>" . $row['description'] . "</td><td>" . $row['price'] .  "</td><td>";
    }
} else{
    echo "no result";
}
$connection->close();
// Names of products should be a hyperlink, than when clicked, will lead the user to the specific product page  

?>
  </table>

  
</body>

</html>