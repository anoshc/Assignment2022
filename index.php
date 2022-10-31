<?php
include "functions.php";
displayNavBar();
?>

<?php
include "myFunctions.php";
/* if (!isLoggedIn()){
    $_SESSION['msg'] = "You have to log in";
    header('location: login.php');
} */
?>

<?php
require_once "classes/class_User.php";
$user = new User();
$user->createAdminUserIfNotExist();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

<header>
    <h2>Home Page</h2>
</header>

<div class="content">
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success">
            <h3>
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
        <?php endif ?>
        <div class="profileInfo">
            <div>
                <?php if (isset($_SESSION['user'])) : ?>
                <?php echo  $_SESSION['user']['username']; ?>
                <?php echo ucfirst($_SESSION['user']['role']); ?>
                <br>
                <a href="index.php?logout='1'">Logout</a>   
                <?php endif ?> 
            </div>
        </div>
</div>
    
</body>
</html>
