<?php 
require 'base.php';

$errors = "";
$form_data = array();
$obj = json_decode($_POST["myData"]);

$firstname = $obj->firstname;
$lastname = $obj->lastname;
$fullname = $obj->fullname;
$tckno = $obj->tckno;
$email = $obj->email;
$password = $obj->password;
$gender = $obj->gender;
$dateOfBirth = $obj->dateOfBirth;
$isDeleted = $obj->isDeleted;
$createdDate = $obj->createdDate;
$address = $obj->address;
$phone = $obj->phone;
$X = $obj->X;
$Y = $obj->Y;
$isVeterinary = $obj->isVeterinary;
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
if (empty($password)) { 
    $errors = $errors."Şifre boş olamaz.<br>";
}

if ($isActive != 1 && $isActive != 0) { 
    $errors = $errors."Lütfen geçerli bir aktiflik durumu seçiniz.<br>";
}

$data = [
    'tckno' => $tckno,
    'email' => $email,
    'password' => $password,
];

$statement = $db->prepare('SELECT COUNT(*) AS control FROM user WHERE tckno = :tckno AND email = :email AND password = :password');
$statement->execute($data);
$result = $statement->fetch();

$control = $result["control"];
if ($control != 0) {
    $errors = $errors."$tckno adında bir kayıt mevcut.<br>";
}

if (!empty($errors)) { 
    $form_data['success'] = false;
    $form_data['errors'] = $errors;
} else { 
    $data = [
        'firstname' => $firstname,
        'lastname' => $lastname,
        'fullname' => $fullname,
        'tckno' => $tckno,
        'email' => $email,
        'password' => $password,
        'gender' => $gender,
        'dateOfBirth' => $dateOfBirth,
        'createdDate' => $createdDate,
        'address' => $address !== '' ? $address : null,
        'phone' => $phone,
        'X' => $X !== '' ? $X : null,
        'Y' => $Y !== '' ? $Y : null,
        'isVeterinary' => $isVeterinary !== '' ? $isVeterinary : null,
        'isActive' => $isActive,
        'isDeleted' => $isDeleted
    ];

    $statement = $db->prepare('INSERT INTO `user` (`firstname`, `lastname`, `fullname`, `tckno`, `email`, `password`, `gender`, `dateOfBirth`, `createdDate`, `address`, `phone`, `X`, `Y`, `isVeterinary`, `isActive`, `isDeleted`) VALUES (:firstname, :lastname, :fullname, :tckno, :email, :password, :gender, :dateOfBirth, :createdDate, :address, :phone, :X, :Y, :isVeterinary, :isActive, :isDeleted, NOW())');
    $statement->execute($data);

    session_start();
    $admin_id = $_SESSION['id'];

    $logs_data = [
        'admin_id' => $admin_id,
        'logs' => $firstname.' adlı user sisteme kaydedildi.'
    ];
    
    $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
    $logs_statement-> execute($logs_data);

    $form_data['success'] = true;
    $form_data['posted'] = 'Kullanıcı eklendi.';
}

echo json_encode($form_data);
?>
