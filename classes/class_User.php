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

    function userNameAvailable($username)
    {

        $connection = $this->connect();

        $query = ("SELECT username FROM users WHERE username='$username'");
        $result = mysqli_query($connection, $query);

        $isUsernameAvailable = mysqli_num_rows($result) <= 0;
        $this->disconnect($connection);

        return $isUsernameAvailable;
    }

    function emailAvailable($email)
    {

        $connection = $this->connect();

        $query = ("SELECT username FROM users WHERE email='$email'");
        $result = mysqli_query($connection, $query);

        $isEmailAvailable = mysqli_num_rows($result) <= 0;
        $this->disconnect($connection);

        return $isEmailAvailable;
    }

    function register($username, $email, $password)
    {
        $connection = $this->connect();

        $username = $connection->real_escape_string($username);
        $email = $connection->real_escape_string($email);
        $password = $connection->real_escape_string($password);

        $password = md5($password);

        $query = "INSERT INTO users (username, email, password, role)";
        $query .= "VALUES('$username', '$email', '$password', '1')";
        return mysqli_query($connection, $query);
    }

    function login($username, $password)
    {

        $connection = $this->connect();
        $username = $connection->real_escape_string($username);
        $password = $connection->real_escape_string($password);
        $password = md5($password);


        $query = ("SELECT username, email, role FROM users WHERE username='$username' AND password='$password'");
        $result = mysqli_query($connection, $query);


        $count = mysqli_num_rows($result);

        // if $count is greater then 0 then save user information in session
        // hint -> $row = mysqli_fetch_assoc($result);


        return $count;
    }
}
