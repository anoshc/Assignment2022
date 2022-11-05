<?php
require_once "classes/class_User.php";
$user = new User();

if ($user->logout()) {
    header("location: index.php");
}
