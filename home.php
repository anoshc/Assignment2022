<?php
require "session.php";

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>

<body>
    <h2>Welcome <?php echo $_SESSION['username']; ?></h2>
    <h3><a href="logout.php">Log out</a></h3>
</body>

</html>