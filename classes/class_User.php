<?php

require_once "class_Database.php";
class User extends Database
{
    function createAdminUserIfNotExist()
    {
        $username = 'admin';
        $password = '0admin0';
        $email = 'admin@ecommerce.com';
        $role = '0';

        $connection = $this->connect();

        $query = ("SELECT username FROM users WHERE username='$username'");
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) <= 0) {
            $query = "INSERT INTO users (username, password, email, role)";
            $query .= " VALUES('$username', '$password', '$email', '$role')";

            mysqli_query($connection, $query);
            $connection->query($query);
        }
        $this->disconnect($connection);
    }
}

?>