<?php
include "functions.php";
displayNavBar();
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
    
</body>
</html>
