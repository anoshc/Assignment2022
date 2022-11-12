<?php
require_once "class_Database.php";

class Customer extends Database
{

    public $firstname;
    public $lastname;
    public $address;
    public $country;

    public $customer_id;
    public $product_id;
    public $time;
    public $quantity;



public function customers($firstname, $lastname, $address, $country)
{
    $connection = $this->connect();


    $firstname = $connection->real_escape_string($firstname);
    $lastname = $connection->real_escape_string($lastname);
    $address = $connection->real_escape_string($address);
    $country = $connection->real_escape_string($country);


    $query = "INSERT INTO customers (firstname, lastname, address, country)";
    $query .= "VALUES('$firstname', '$lastname', '$address,', 'country')";
    return mysqli_query($connection, $query);
}

public function insertOrder($productID, $quantity){

    $connection = $this->connect();

    $productID = $_GET['productID'];
    $quantity = $_POST['quantity'];

    $query = "INSERT INTO orders (product_id, quantity)";
    $query .= "VALUES('$productID', '$quantity')";
    return mysqli_query($connection, $query);

}

}

?>