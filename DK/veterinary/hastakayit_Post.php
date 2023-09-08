<?php
require "../base.php";

session_start();

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$hayvanadi = $obj->hayvanadi;
$hastacinsi = $obj->hastacinsi;
$rahatsizlik = $obj->rahatsizlik;
$fullname = $obj->fullname;
$phone = $obj->phone;
$kayit_baslangic = $obj->kayit_baslangic;
$durum = $obj->durum;

if ($hayvanadi <= 0) {
    $errors .= "Hayvan Adı olamaz.<br>";
}

if ($hastacinsi <= 0) {
    $errors .= "Hayvan Cinsi boş olamaz.<br>";
}

if (empty($rahatsizlik)) {
    $errors = $errors . "Hayvanın Rahatsızlığı boş olamaz. </br>";
}

if ($durum != 1 && $durum != 2 && $durum != 3) {
    $errors .= "Durumu seçiniz.<br>";//buraya ne koyacağımı bilemedim 
}

if ($fullname <= 0) {
    $errors .= "Ad Soyad boş olamaz.<br>";
}

if (empty($phone)) {
    $errors = $errors . "Telefon Numarası boş olamaz. </br>";
}
if (strlen($phone) > 100) {
    $errors = $errors . "Geçerli bir telefon numarası giriniz.</br>";
}


if($kayit_baslangic <=0){
    $errors .= "Kayıt Tarihi boş olamaz. </br>";
}


if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
    } 
    else {
    $id = $_SESSION['veterinaryId'];

    $data = [
        "id" => $id,
        "hayvanadi" => $hayvanadi,
        "hastacinsi" => $hastacinsi,
        "rahatsizlik" => $rahatsizlik,
        "durum" => $durum,
        "fullname" => $fullname,
        "phone" => $phone,
        "kayit_baslangic" => $kayit_baslangic,
    ];
    
    $statement = $db->prepare(
    "INSERT INTO patients (veterinaryId, hayvanadi, hastacinsi, rahatsizlik, durum, kayit_baslangic, isActive, createdDate, ownerName, ownerPhone)
    VALUES (:id,  :hayvanadi, :hastacinsi, :rahatsizlik, :durum, :kayit_baslangic, 1, NOW(), :fullname, :phone);"
    );
   
    $statement->execute($data);
    
    $form_data["success"] = true;
    $form_data["posted"] = "...Hasta Kaydedildi...";
}

echo json_encode($form_data);

?>
