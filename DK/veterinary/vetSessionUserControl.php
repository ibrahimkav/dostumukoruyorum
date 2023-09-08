<?php

session_start();

if (isset($_SESSION['veterinaryId']) == false){
  echo "<script>window.location.href = '/login.php';</script>";
}

?>