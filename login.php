<?php
require "functions.php";
require "classes/class_User.php";
displayNavBar();
session_start();


if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = new User();


    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        header("location: login.php?error=Username is required");
        exit();
    } else if (empty($password)) {
        header("location: login.php?error=Password is required");
        exit();
    } else {

        $result = $user->login($username, $password);


        if ($result > 0) {
            $_SESSION['username'] = $username;
            header('location: home.php');
        } else {
            header("location: login.php?error=Incorrect username or password");
            exit();
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce - Login </title>
    <link rel="stylesheet" href="style/main.css">
</head>

<body>
    <header>
        <h2>Login</h2>
    </header>

    <form action="login.php" method="post">
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="login-btn">Login</button>
        </div>
        <p>Not a member? <a href="register.php">Sign up</a></p>
    </form>

    <?php

    // First add a method in the User class for creating an admin account. This method should run only once, the first time, this page is loaded. Essentially, do a check on the database to check if an admin account exist. 

    // Implement login functionality here

    // Implement registration functionality instead, if a register hyperlink is clicked. 

    // HINT : You can toggle between login form or registration form on the same page, based on whether the register link was clicked or not. The login form should have a button to switch to the register form, while the register form should have a button switching back to the login form. 

    ?>

</body>

</html>