<?php
require_once "class_Database.php";

echo "In class: Product<br>";

class Product extends Database{
    // properties example, add more properties if needed
    protected $product_Name;
    protected $description;
    
    
    // a method example, add other methods if needed. 
     protected function addProductToDB(){
        
    }
    
    
}



?>