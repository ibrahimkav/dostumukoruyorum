<?php
session_start();
session_destroy();

$cookie_name = "user";

setcookie($cookie_name, "", time()  - (86400 * 30));


    header("location: index.php");
    exit();
?>