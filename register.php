<?php
require "functions.php";
require_once "classes/class_User.php";
displayNavBar();

if (isset($_POST['register-btn'])) {
    $user = new User();

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // step 1 - check if any of the value from form is empty, if yes give error message to user and stop the process

    if (empty($username)) {
        $_POST = array();
        echo "Username is required";
        return;
    }
    if (empty($email)) {
        $_POST = array();
        echo "Email is required";
        return;
    }
    if (empty($password)) {
        $_POST = array();
        echo "Password is required";
        return;
    }

    // step 2 - check if email and username is available

    if (!$user->userNameAvailable($username) || !$user->emailAvailable($email)) {
        // error message to user
        $_POST = array();
        echo "not available";
        return;
    }

    // step 3 - alt er okay, register

    $result = $user->register($username, $email, $password);
    header('location: thankyou.php');
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <title>Register</title>
</head>

<body>
    <form action="register.php" method="post">
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </div>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="register-btn">Register</button>
        </div>
        <p>Already a member? <a href="login.php">Login</a></p>
    </form>
</body>

</html>