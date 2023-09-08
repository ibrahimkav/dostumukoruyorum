<?php
require "base.php";

session_start();

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$breed = $obj->breed;
$time = $obj->time;
$il = $obj->il;
$ilce = $obj->ilce;
$address = $obj ->address;
$directions =$obj ->directions;
$x =$obj ->x;
$y =$obj ->y;

$id = $_SESSION['id'];

if ($id <= 0) {
    $errors .= "İlk önce giriş yapmanız gerekmektedir..<br>";
}

if (empty($breed)) {
    $errors = $errors . "Hayvan Irkı boş olamaz. </br>";
}

if (empty($time)) {
    $errors = $errors . "Saat boş olamaz. </br>";
}

if ($il <= 0) {
    $errors .= "İl boş olamaz.<br>";
}

if ($ilce <= 0) {
    $errors .= "İlçe boş olamaz.<br>";
}

if (empty($address)) {
    $errors = $errors . "Adres boş olamaz. </br>";
}

if (empty($directions)) {
    $errors = $errors . "Açıklamalar boş olamaz. </br>";
}

if(!is_numeric($x) || !is_numeric($y)){
    $errors = $errors . "X yada Y sayısal bir değer olmak zorundadır..</br>";
}


if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
    } 
    else {
 

        $data = [
            "id" => $id,
            "breed" => $breed,
            "time" => $time,
            "ilId" => $il,
            "ilceId" => $ilce,
            "address" => $address,
            "directions" => $directions,
            "x" => $x,
            "y" => $y
        ];
        
        $statement = $db->prepare(
            "INSERT INTO `yardim` (`breed`, `time`, `ilId`, `ilceId`, `address`, `directions`, `createDate`, `x`, `y`, `userId`) 
            VALUES(:breed, :time, :ilId, :ilceId, :address, :directions, NOW(), :x, :y, :id)"
        );
        
        $statement->execute($data);
    
    $form_data["success"] = true;
    $form_data["posted"] = "...Yardım Oluşturuldu...";
}

echo json_encode($form_data);

?>
