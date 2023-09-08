<?php 

require 'connect.php';

if($_SERVER['HTTP_HOST'] != "localhost"){
if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
    $redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $redirect_url");
    exit();
}
}

?>
