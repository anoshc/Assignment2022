<?php
require "functions.php";
require_once "classes/class_User.php";
displayNavBar();

?>

<div class="container">

    <?php
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
                header('location: index.php');
                exit();
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
        <?php getHeader(); ?>
    </head>

    <body>
        <header>
            <h3>Login</h3>
        </header>

        <form action="login.php" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" name="login-btn">Login</button>
            </div>
            <p>Not a member? <a href="register.php">Sign up</a></p>
        </form>


</div>
<?php getFooter(); ?>
</body>

</html>