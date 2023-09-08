<?php

session_start();

if (isset($_SESSION['id']) == false){
  echo "<script>window.location.href = '/login.php';</script>";
}

?>