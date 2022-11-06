<?php
require_once "class_Database.php";

echo "In class: Product<br>";

class Product extends Database{
    // properties example, add more properties if needed
    public $product_Name;
    public $description;
    public $price;
    
    
    // a method example, add other methods if needed. 
    public function addProductToDB($product_name, $description, $price){

        $connection = $this->connect();

        $product_name = $connection->real_escape_string($product_name);
        $description = $connection->real_escape_string($description);
        $price = $connection->real_escape_string($price);

        $query = "INSERT INTO products(product_name, description, price) ";
        $query .= "VALUES('$product_name', '$description', '$price')";

        $result = mysqli_query($connection, $query);

        if(!$result){
            die('Adding product failed' . mysqli_error($connection));
        } else{
            echo "New product added";
        }
    }
    
    
}



?>