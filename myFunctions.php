<?php

require 'classes/class_Database.php';

session_start();


if (isset($_POST['register-btn'])) {
    register();
}

function register()
{
    global $connection, $errors, $username, $email;

    $username = e($_POST['username']);
    $email = e($_POST['email']);
    $password = e($_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);

        if (isset($_POST['role'])) {
            $role = e($_POST['role']);
            $query = "INSERT INTO users(username, email, password, role)";
            $query .= "VALUES ('$username', '$email', '$password', '$role')";
            mysqli_query($connection, $query);
            $_SESSION['success'] = "New user successfully created";
            header('location: index.php');
        } else {
            $query = "INSERT INTO users (username, email, password, role)";
            $query .= "VALUES('$username', '$email', '$password', 'role')";
            mysqli_query($connection, $query);

            $logged_in_user_id = mysqli_insert_id($connection);

            $_SESSION['user'] = getUserById($logged_in_user_id);
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        }
    }
}

function getUserById($id){
    global $connection;
    $query = "SELECT * FROM users WHERE id=" . $id;
    $result = mysqli_query($connection, $query);

    $user = mysqli_fetch_assoc($result);
    return $user;
}

function e($val){
    global $connection;
    return mysqli_real_escape_string($connection, trim($val));
}

function displayError(){
    global $errors;

    if(count($errors) > 0){
        echo '<div class="error">';
        foreach ($errors as $error){
            echo $error .'<br>';
        }
        echo '</div>';
    }
}

function isLoggedIn()
{
    if (isset($_SESSION['user'])){
        return true;
    }else{
        return false;
    }
}

if (isset($_POST['login-btn'])){
    login();
}

function login(){
    global $connection, $username, $errors;

    $username = e($_POST['username']);
    $password = e($_POST['password']);

    if(empty($username)){
        array_push($errors, "Username is required");
    }
    if (empty($password)){
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0){
        $password= md5($password);

        $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
        $results = mysqli_query($connection, $query);

        if (mysqli_num_rows($results) == 1){
            $logged_in_user = mysqli_fetch_assoc($results);
            if ($logged_in_user['role'] == '0'){

                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success'] = "You are now logged in";
                header('location: adminPage.php');
            } else{
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success'] = "You are now logged in";
                header('location : index.php');
            }
        }else{
            array_push($errors, "Wrong username or password");
        }
    }

}

?>
