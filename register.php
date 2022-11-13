<?php
require "functions.php";
require_once "classes/class_User.php";
displayNavBar();

?>

<div class="container">

    <?php

    if (isset($_POST['register-btn'])) {
        $user = new User();

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // step 1 - check if any of the value from form is empty, if yes give error message to user and stop the process

        if (empty($username)) {
            header("location: register.php?error=Username is required");
            exit();
        }
        if (empty($email)) {
            header("location: register.php?error=Email is required");
            exit();
        }
        if (empty($password)) {
            header("location: register.php?error=Password is required");
            exit();
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
        <?php getHeader(); ?>
    </head>

    <body>
        <header>
            <h3>Sign up</h3>
        </header>

        <form action="register.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" name="register-btn">Register</button>
            </div>
            <p>Already a member? <a href="login.php">Login</a></p>
        </form>

</div>

<?php getFooter(); ?>
</body>

</html>