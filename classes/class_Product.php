<?php
require_once "class_Database.php";

echo "In class: Product<br>";

class Product extends Database{
    // properties example, add more properties if needed
    protected $product_Name;
    protected $description;
    
    
    // a method example, add other methods if needed. 
    protected function addProductToDB($product_name, $description, $price){

        $connection = $this->connect();

        $product_name = $connection->$product_name;
        $description = $connection->$description;
        $price = $connection->$price;

        $query = "INSERT INTO products(product_name, description, price) ";
        $query .= "VALUES('$product_name', '$description', '$price')";

        $result = mysqli_query($connection, $query);
        $resultcheck = mysqli_num_rows($result);

        if(!$result){
            die('Adding product failed' . mysqli_error($connection));
        } else{
            echo "New product added";
        }
    }
    
    
}



?>