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

    public function add()
    {
        $connection = $this->connect();

        $firstname = $connection->real_escape_string($this->firstname);
        $lastname = $connection->real_escape_string($this->lastname);
        $address = $connection->real_escape_string($this->address);
        $country = $connection->real_escape_string($this->country);

        $query = "INSERT INTO customers (firstname, lastname, address, country)";
        $query .= "VALUES('$firstname', '$lastname', '$address','$country')";
        $res = mysqli_query($connection, $query);

        if ($res)
            $this->customer_id = $connection->insert_id;

        return $res;
    }

    public function insertOrder($productID, $quantity)
    {

        $time = time();
        $connection = $this->connect();
        $query = "INSERT INTO orders (product_id, quantity, customer_id, time)";
        $query .= "VALUES('$productID', '$quantity', '$this->customer_id', '$time')";
        return mysqli_query($connection, $query);
    }

    public function getData()
    {
        return $this->readFromTable('orders');
    }
}
