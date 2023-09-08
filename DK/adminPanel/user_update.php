<?php
require 'base.php';

$errors = "";
$form_data = array();
$obj = json_decode($_POST["myData"]);

$id = $obj->id;
$firstname = $obj->firstname;
$lastname = $obj->lastname;
$fullname = $firstname." ".$lastname;
$tckno = $obj->tckno;
$email = $obj->email;
$gender = $obj->gender;
$dateOfBirth = $obj->dateOfBirth;
$isDeleted = $obj->isDeleted;
$address = $obj->address;
$phone = $obj->phone;
$isActive = $obj->isActive;

if (empty($firstname)) { 
    $errors = $errors."İsminiz boş olamaz.<br>";
}
if (empty($lastname)) { 
    $errors = $errors."Soyisminiz boş olamaz.<br>";
}
if (empty($tckno)) { 
    $errors = $errors."TC'niz boş olamaz.<br>";
}
if (empty($email)) { 
    $errors = $errors."Email boş olamaz.<br>";
}

if ($isActive != 1 && $isActive != 0) { 
    $errors = $errors."Lütfen geçerli bir aktiflik durumu seçiniz.<br>";
}

$data = [
    'id' => $id,
    'tckno' => $tckno,
    'email' => $email,
];

$statement = $db->prepare('SELECT COUNT(*) AS control FROM user WHERE id != :id AND (tckno = :tckno OR email = :email)');
$statement->execute($data);
$result = $statement->fetch();

$control = $result["control"];
if ($control != 0) {
    $errors = $errors."Belirtilen TC veya email ile başka bir kayıt mevcut.<br>";
}

if (!empty($errors)) { 
    $form_data['success'] = false;
    $form_data['errors'] = $errors;
} else { 
    $data = [
        'id' => $id,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'fullname' => $fullname,
        'tckno' => $tckno,
        'email' => $email,
        'gender' => $gender,
        'dateOfBirth' => $dateOfBirth,
        'address' => $address !== '' ? $address : null,
        'phone' => $phone,
        'isActive' => $isActive,
        'isDeleted' => $isDeleted
    ];

    $statement = $db->prepare('UPDATE user SET firstname = :firstname, lastname = :lastname, fullname = :fullname, tckno = :tckno, email = :email, gender = :gender, dateOfBirth = :dateOfBirth, address = :address, phone = :phone, isActive = :isActive, isDeleted = :isDeleted WHERE id = :id');
    $statement->execute($data);

    session_start();
    $admin_id = $_SESSION['id'];

    $logs_data = [
        'admin_id' => $admin_id,
        'logs' => $firstname.'adlı user da düzenleme yapıldı.'
    ];
    
    $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
    $logs_statement-> execute($logs_data);

    $form_data['success'] = true;
    $form_data['posted'] = 'Kullanıcı güncellendi.';
}

echo json_encode($form_data);
?>
