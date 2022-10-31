<?php
include "functions.php";
displayNavBar();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ecommerce - Login </title>
    <link rel="stylesheet" href="style/main.css">
</head>

<body>

    <header>
        <h2>Login</h2>
    </header>

    <form action="login.php" method="post">

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>

        <div class="input-group">
            <button type="submit" class="btn" name="login-btn">Login</button>
        </div>
        <p>
            Not a member? <a href="register.php">Sign up</a>
        </p>
    </form>

    <?php

    // First add a method in the User class for creating an admin account. This method should run only once, the first time, this page is loaded. Essentially, do a check on the database to check if an admin account exist. 

    // Implement login functionality here

    // Implement registration functionality instead, if a register hyperlink is clicked. 

    // HINT : You can toggle between login form or registration form on the same page, based on whether the register link was clicked or not. The login form should have a button to switch to the register form, while the register form should have a button switching back to the login form. 

    ?>

</body>

</html>