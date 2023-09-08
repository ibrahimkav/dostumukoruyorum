<?php
require "../base.php";

session_start();

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$id = $obj->id;
$hayvanadi = $obj->hayvanadi;
$hastacinsi = $obj->hastacinsi;
$rahatsizlik = $obj->rahatsizlik;
$fullname = $obj->fullname;
$phone = $obj->phone;
$kayit_baslangic = $obj->kayit_baslangic;
$kayit_bitis = $obj->kayit_bitis;
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
    $errors .= "Kayı Tarihi boş olamaz. </br>";
}

if($kayit_bitis <=0){
    $errors .= "Kayıt bitiş Tarihi boş olamaz. </br>";
}



if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
    } 
    else {
    $veterinaryId = $_SESSION['veterinaryId'];

    $data = [
        "id" => $id,
        "hayvanadi" => $hayvanadi,
        "hastacinsi" => $hastacinsi,
        "rahatsizlik" => $rahatsizlik,
        "durum" => $durum,
        "fullname" => $fullname,
        "phone" => $phone,
        "kayit_baslangic" => $kayit_baslangic,
        "kayit_bitis" => $kayit_bitis,
        "veterinaryId" => $veterinaryId
    ];
    
    $statement = $db->prepare(
        "UPDATE patients 
        SET patients.hayvanadi = :hayvanadi, 
            patients.hastacinsi = :hastacinsi, 
            patients.rahatsizlik = :rahatsizlik, 
            patients.durum = :durum, 
            patients.ownerPhone = :phone, 
            patients.kayit_baslangic = :kayit_baslangic, 
            patients.kayit_bitis = :kayit_bitis, 
            patients.ownerName = :fullname 
        WHERE id = :id AND veterinaryId = :veterinaryId"
    );
    $statement->execute($data);
    $form_data["success"] = true;
    $form_data["posted"] = "...Değişiklikleriniz Kaydedildi...";
}

echo json_encode($form_data);

?>
