<?php
require "base.php";

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$konu = $obj->konu;
$icerik = $obj->icerik;
$category = $obj->category;


session_start();

$id = $_SESSION['id'];


if($id < 0){
    $errors = $errors . "Giriş yapmanız gerekmektedir.</br>";
}

if (empty($konu)) {
    $errors = $errors . "Konu başlığı boş kalamaz. </br>";
}


if (empty($icerik) || $icerik == "" || !isset($icerik)) {
    $errors = $errors . "İçerik boş olamaz. </br>";
}

if ($category < 0) {
    $errors = $errors . "Kategori boş olamaz</br>";
}



if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
} else {


    
    $data = [
        "id" => $id,
        "konu" => $konu,
        "icerik" => $icerik,
        "category" => $category
    ];

    $statement = $db->prepare(
        "INSERT INTO topic (userId,categoryId,title,SUBJECT,createdDate,isActive,isDeleted) VALUES(:id,:category,:konu,:icerik,NOW(),1,0)"
    );
    $statement->execute($data);

    $form_data["success"] = true;
    $form_data["posted"] = "Konu başarıyla açıldı.";
}

echo json_encode($form_data);

?>
