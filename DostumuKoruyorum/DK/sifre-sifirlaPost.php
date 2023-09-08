<?php
require "base.php";

session_start();

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$password = $obj->password;
$code = $obj->code;


$encodedEmail = $obj->encodedEmail;
$email = urldecode($encodedEmail);
$email = base64_decode($email);


if (empty($password)) {
    $errors = $errors . " Şifre boş olamaz. </br>";
}

$password = md5($password);

$email_con = true;


if (empty($code) || $code <= 0) {
    $errors = $errors . "Doğrulama kodu boş olamaz. </br>";
}


if (empty($email)) {
    $errors = $errors . "Email boş olamaz. </br>";
    $email_con = false;
}
else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors = $errors . "Geçersiz email adresi.</br>";
        $email_con = false;
    }
}


if($email_con == true){

    $data = [
        "email" => $email,
    ];
    
    $statement = $db->prepare(
        "SELECT COUNT(0) AS control FROM user WHERE email = :email"
    );
    
    $statement->execute($data);
    $result = $statement->fetch();
    
    $control = $result["control"];

    if ($control == 0) {
        $errors = $errors . "Böyle bir kullanıcı bulunmamaktadır. </br>";
    }

}


$data = [
    "email" => $email,
];

$statement = $db->prepare(
    "SELECT code  FROM lostPassword WHERE email = :email"
);

$statement->execute($data);
$result = $statement->fetch();
$codeDB = $result["code"];


if ($codeDB != $code) {
    $errors = $errors . "Doğrullama kodu yanlış. </br>";
}

if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
}
 else {
    
    $data = [
        "newpassword" => $password,
        "email" => $email
    ];

    $statement = $db->prepare(
        "UPDATE `user` SET `password` = :newpassword where  `email` = :email "
    );

    $statement->execute($data);
    $form_data["success"] = true;
    $form_data["posted"] = "...Şifreniz Güncellendi...";
}


echo json_encode($form_data);

?>
