<?php
require "base.php";

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$fullname = $obj->fullname;
$email = $obj->email;
$phonenumber = $obj->phonenumber;
$comment = $obj->comment;

if (empty($fullname)) {
    $errors = $errors . "İsim Soyisim boş olamaz. </br>";
}

if (strlen($fullname) > 100) {
    $errors = $errors . "İsim Soyisim en fazla 100 karakter olabilir.</br>";
}

if (empty($email)) {
    $errors = $errors . "Eposta adresi boş olamaz.</br>";
} else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors = $errors . "Geçersiz Eposta adresi.</br>";
    }
}

if (strlen($email) > 100) {
    $errors = $errors . "Eposta en fazla 100 karakter olabilir.</br>";
}


if (empty($comment)) {
    $errors = $errors . "Yorum alanı boş olamaz. </br>";
}

if (empty($phonenumber)) {
    $errors = $errors . "Telefon numarası boş olamaz. </br>";
}

if (strlen($phonenumber) > 100) {
    $errors = $errors . "Geçerli bir telefon numarası giriniz.</br>";
}


$searchVal = array("-", "(", ")"," ");
 
$replaceVal = array("", "", "","");

$phoneNumber = "0".str_replace($searchVal,$replaceVal,$phonenumber);

if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
} else {
   
    $data = [
        "fullname" => $fullname,
        "email" => $email,
        "phonenumber" => $phoneNumber,
        "comment" => $comment,
    ];

    $statement = $db->prepare(
        "INSERT INTO `contact` (`fullname`,`email`,`phonenumber`,`comment`) VALUES(:fullname,:email,:phonenumber,:comment)"
    );
    $statement->execute($data);

    $form_data["success"] = true;
    $form_data["posted"] = "Yorumlarınız başarılı bir şekilde gönderilmiştir.";
}

echo json_encode($form_data);

?>
