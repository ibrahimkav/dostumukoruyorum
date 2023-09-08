<?php
require "base.php";

session_start();

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$adres = $obj->adres;
$x = $obj->x;
$y = $obj->y;


if (empty($adres)) {
    $errors = $errors . "Adres boş olamaz.</br>";
}

if (strlen($adres) < 10) {
    $errors = $errors . "Adres 10 karatkerden az olamaz</br>";
}

if (empty($x)) {
    $errors = $errors . "X boş olamaz.</br>";
}

if (empty($y)) {
    $errors = $errors . "Y boş olamaz.</br>";
}

if(!is_numeric($x) || !is_numeric($y)){
    $errors = $errors . "X yada Y sayısal bir değer olmak zorundadır..</br>";
}


if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
}
 else {

    $id = $_SESSION['id'];
    
    $data = [
        "id" => $id,
        "address" => $adres,
        "X" => $x,
        "Y" => $y,
  
    ];
    $statement = $db->prepare(
        "UPDATE `user` SET `address` = :address,`X` = :X , `Y` = :Y where  `id` = :id "
    );
    $statement->execute($data);
    $form_data["success"] = true;
    $form_data["posted"] = "...Adresiniz Güncellendi...";
}


echo json_encode($form_data);

?>
