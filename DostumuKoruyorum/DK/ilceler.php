<?php
include "connect.php";
$id  =  $_GET['id'];
$statement = $db->prepare("SELECT * FROM ilce where ilId=:id");
$statement->execute(['id'=>$id]);
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($results);
echo $json;




?>