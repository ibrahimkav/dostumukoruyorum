<?php
require "base.php";

session_start();

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$password = $obj->password;
$newpassword = $obj->newpassword;
$newpasswordagain = $obj->newpasswordagain;

$oldpasswordtrue = false;


$password = md5($password);
$newpassword = md5($newpassword);
$newpasswordagain = md5($newpasswordagain);

if (empty($password)) {
    $errors = $errors . "Mevcut Şifre boş olamaz. </br>";
}

if (empty($newpassword)) {
    $errors = $errors . "Yeni Şifre boş olamaz. </br>";
}

if (strlen($newpassword) > 100) {
    $errors = $errors . "Şifre en fazla 100 karakter olabilir.</br>";
}


if ($newpassword != $newpasswordagain) {
    $errors = $errors . "Yen şifreler uyuşmuyor.</br>";
}

if ( $_SESSION['password'] != $password ) {
    $errors = $errors . "Eski şifre doğru değil </br>";
}
else{
    $oldpasswordtrue = true;
}

if($oldpasswordtrue == true){
    if ( $_SESSION['password'] == $newpassword ) {
        $errors = $errors . "Yeni Şifre ve Mevcut Şifre aynı olamaz. </br>";
    }
}


if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
}
 else {

    $id = $_SESSION['id'];
    
    $data = [
        "newpassword" => $newpassword,
        "id" => $id,
  
    ];
    $statement = $db->prepare(
        "UPDATE `user` SET `password` = :newpassword where  `id` = :id "
    );
    $statement->execute($data);
    $_SESSION['password'] ==  $newpassword;
    $form_data["success"] = true;
    $form_data["posted"] = "...Şifreniz Güncellendi...";
}


echo json_encode($form_data);

?>
