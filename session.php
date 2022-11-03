<?php

require "classes/class_User.php";
session_start();

$userid = "$username";
$_SESSION['userid'] = $username;

echo "Welcome $_SESSION[userid]";



// $sql = mysqli_query($connection, "SELECT username FROM users WHERE username='$username' ");
// $row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
// $login_session = $row['username'];

// if(!isset($_SESSION['username'])){
//     header("location: login.php");
//     die();
// }

?>