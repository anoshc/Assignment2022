<?php
require_once "class_Database.php";


class Product extends Database
{
    // properties example, add more properties if needed
    public $product_Name;
    public $description;
    public $price;
    public $image;


    // a method example, add other methods if needed. 
    public function addProductToDB()
    {
        $connection = $this->connect();
        $product_Name = $connection->real_escape_string($this->product_Name);
        $description = $connection->real_escape_string($this->description);
        $price = $connection->real_escape_string($this->price);

        $query = "INSERT INTO products (product_name, description, price, image_name)";
        $query .= "VALUES('$product_Name', '$description', '$price', '$this->image')";

        return mysqli_query($connection, $query);
    }

    public function getData()
    {
        return $this->readFromTable('products');
    }

    public function deleteProduct($id)
    {
        $connection = $this->connect();
        $query = "DELETE FROM products WHERE product_id='$id'";
        return mysqli_query($connection, $query);
    }

    function productsList()
    {

        $connection = $this->connect();

        $query = ("SELECT * FROM products");
        $result = mysqli_query($connection, $query);

        $productList = mysqli_num_rows($result) <= 0;
        $this->disconnect($connection);

        return $productList;
    }
}
