<?php
require "base.php";

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$firstname = $obj->firstname;
$lastname = $obj->lastname;
$email = $obj->email;
$password = $obj->password;
$gender = $obj->gender;
$dateOfBirth = $obj->dateOfBirth;
$phone = $obj->phone;
$consent = $obj->consent;
$tc = $obj->tc;

if ($consent == false) {
    $errors = $errors . "Açık Rıza Metni kabul edilmelidir. </br>";
}

if (empty($firstname)) {
    $errors = $errors . "Ad boş olamaz. </br>";
}

if (strlen($firstname) > 100) {
    $errors = $errors . "Ad en fazla 100 karakter olabilir.</br>";
}

if (empty($lastname)) {
    $errors = $errors . "Soyad boş olamaz. </br>";
}

if (strlen($lastname) > 100) {
    $errors = $errors . "Soyad en fazla 100 karakter olabilir.</br>";
}

if (empty($email)) {
    $errors = $errors . "Email boş olamaz.</br>";
} else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors = $errors . "Geçersiz email adresi.</br>";
    }
}

if (strlen($email) > 100) {
    $errors = $errors . "Email en fazla 100 karakter olabilir.</br>";
}

$data = [
    "email" => $email,
];

$statement = $db->prepare(
    "SELECT COUNT(0) AS control FROM user WHERE email = :email"
);

$statement->execute($data);
$result = $statement->fetch();

$control = $result["control"];
if ($control != 0) {
    $errors = $errors . "Bu Email kullanılmaktadır. </br>";
}

if (empty($password)) {
    $errors = $errors . "Şifre boş olamaz. </br>";
}

if (strlen($password) > 100) {
    $errors = $errors . "Şifre en fazla 100 karakter olabilir.</br>";
}

if ($gender != 1 && $gender != 2) {
    $errors = $errors . "Cinsiyet geçerli değil </br>";
}

if (empty($phone)) {
    $errors = $errors . "Telefon numarası boş olamaz. </br>";
}

if (strlen($phone) > 100) {
    $errors = $errors . "Geçerli bir telefon numarası giriniz.</br>";
}


$searchVal = array("-", "(", ")"," ");
 
$replaceVal = array("", "", "","");

$phoneNumber = "0".str_replace($searchVal,$replaceVal,$phone);

$data = [
    "phone" => $phone,
];

$statement = $db->prepare(
    "SELECT COUNT(0) AS control FROM user WHERE phone = :phone"
);

$statement->execute($data);
$result = $statement->fetch();

$control = $result["control"];
if ($control != 0) {
    $errors = $errors . "Bu Telefon Numarası kullanılmaktadır. </br>";
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


if(!validateTCKNO($tc)){
    $errors .= "Lütfen geçerli bir T.C. Numarası giriniz.<br>";
}

$data = [
    "tc" => $tc,
];

$statement = $db->prepare(
    "SELECT COUNT(0) AS control FROM user WHERE tckno = :tc"
);

$statement->execute($data);
$result = $statement->fetch();

$control = $result["control"];
if ($control != 0) {
    $errors = $errors . "Bu T.C Numarası kullanılmaktadır. </br>";
}




$hashedPassword = md5($password);


if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
} else {


    $searchVal = array("/");
 
    $replaceVal = array("-");
    
    $date  = str_replace($searchVal,$replaceVal,$dateOfBirth);
    
    $data = [
        "firstname" => $firstname,
        "lastname" => $lastname,
        "email" => $email,
        "password" => $hashedPassword,
        "gender" => $gender,
        "dateOfBirth" => $date,
        "phone" => $phoneNumber,
        "tc" => $tc,
    ];

    $statement = $db->prepare(
        "INSERT INTO `user` (`firstname`,`lastname`,`email`,`password`,`gender`,`dateOfBirth`,`phone`,`createdDate`,`tckno`) VALUES(:firstname,:lastname,:email,:password,:gender,:dateOfBirth,:phone,NOW(),:tc)"
    );
    $statement->execute($data);

    $form_data["success"] = true;
    $form_data["posted"] = "Sisteme kayıt olduğunuz için teşekkür ederiz.";
}

echo json_encode($form_data);

?>
