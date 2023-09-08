<?php
require "base.php";

session_start();

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$firstname = $obj->firstname;
$lastname = $obj->lastname;
$tckno = $obj->tckno;
$phone = $obj->phone;
$email = $obj->email;

$id = $_SESSION['id'];


if ($id <= 0) {
    $errors .= "Giriş yapmanız gerekmektedir. <br>";
}

if (empty($firstname)) {
    $errors .= "Ad boş olamaz. <br>";
}

if (strlen($firstname) > 100) {
    $errors .= "Ad en fazla 100 karakter olabilir.<br>";
}

if (empty($lastname)) {
    $errors .= "Soyad boş olamaz. <br>";
}

if (strlen($lastname) > 100) {
    $errors .= "Soyad en fazla 100 karakter olabilir.<br>";
}

if (empty($tckno)) {
    $errors .= "Kimlik numarası boş olamaz. <br>";
}

if (empty($phone)) {
    $errors .= "Telefon numarası boş olamaz. <br>";
}

if (strlen($phone) > 100) {
    $errors .= "Geçerli bir telefon numarası giriniz.<br>";
}

if (empty($email)) {
    $errors .= "Email boş olamaz.<br>";
} else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors .= "Geçersiz email adresi.<br>";
    }
}

if (strlen($email) > 100) {
    $errors .= "Email en fazla 100 karakter olabilir.<br>";
}

function validateTCKNO($kimlikNumarasi) {
    if (strlen($kimlikNumarasi) != 11) {
        return false;
    }
  
    // İlk hane sıfır olamaz
    if ($kimlikNumarasi[0] == '0') {
        return false;
    }
  
    // Kimlik numarasının tamamının rakam olup olmadığını kontrol edelim
    if (!ctype_digit($kimlikNumarasi)) {
        return false;
    }
  
    // Kimlik numarasının doğruluğunu kontrol edelim
    $digit1 = $kimlikNumarasi[0];
    $digit2 = $kimlikNumarasi[1];
    $digit3 = $kimlikNumarasi[2];
    $digit4 = $kimlikNumarasi[3];
    $digit5 = $kimlikNumarasi[4];
    $digit6 = $kimlikNumarasi[5];
    $digit7 = $kimlikNumarasi[6];
    $digit8 = $kimlikNumarasi[7];
    $digit9 = $kimlikNumarasi[8];
    $digit10 = $kimlikNumarasi[9];
    $digit11 = $kimlikNumarasi[10];

    $sum1 = $digit1 + $digit3 + $digit5 + $digit7 + $digit9;
    $sum2 = $digit2 + $digit4 + $digit6 + $digit8;
    $sum3 = $sum1 * 7 - $sum2;
  
    if ($sum3 % 10 != $digit10) {
        return false;
    }
  
    $sum4 = $sum1 + $sum2 + $digit10;
    if ($sum4 % 10 != $digit11) {
        return false;
    }
  
    return true;
}


if(!validateTCKNO($tckno)){
    $errors .= "Lütfen geçerli bir T.C. Numarası giriniz.<br>";
}

$data = [
    "tc" => $tckno,
    "id" => $id
];

$statement = $db->prepare(
    "SELECT COUNT(0) AS control FROM user WHERE tckno = :tc and id != :id"
);

$statement->execute($data);
$result = $statement->fetch();

$control = $result["control"];
if ($control != 0) {
    $errors = $errors . "Bu T.C Numarası kullanılmaktadır. </br>";
}



if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
    } else {

    $data = [
        "firstname" => $firstname,
        "lastname" => $lastname,
        "tckno" => $tckno,
        "phone" => $phone,
        "email" => $email,
        "id" => $id,
    ];
    
    $statement = $db->prepare(
    "UPDATE `user` SET `firstname` = :firstname, `lastname` = :lastname, `tckno` = :tckno, `phone` = :phone, `email` = :email WHERE `id` = :id");
    
    $statement->execute($data);
    $form_data["success"] = true;
    $form_data["posted"] = "...Değişiklikleriniz Kaydedildi...";


    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['fullname'] = $firstname." ".$lastname;
    $_SESSION['tckno'] = $tckno;
    $_SESSION['phone'] = $phone;

}

echo json_encode($form_data);

?>
