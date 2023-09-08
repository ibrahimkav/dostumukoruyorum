<?php
require "../base.php";

session_start();

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$x = $obj->x;
$y = $obj->y;
$businessname = $obj->businessname;
$phone = $obj->phone;
$email = $obj->email;
$address = $obj->address;


$id = $_SESSION["veterinaryId"];

if($id <= 0 ){
    $errors .= "Giriş yapmanız gerekmektedir. <br>";
}

if (!is_numeric($x)) {
    $errors .= "Lokasyon boş olamaz. <br>";
}

if (!is_numeric($y)) {
    $errors .= "Lokasyon boş olamaz. <br>";
}

if (empty($businessname)) {
    $errors .= "İş Yeri Adı boş olamaz. <br>";
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

if (empty($address)) {
    $errors .= "Adres boş olamaz. <br>";
}

if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
    } 
    else {

        $data = [
            "x" => $x,
            "y" => $y,
            "businessname" => $businessname,
            "phone" => $phone,
            "email" => $email,
            "address" => $address,
            "id" => $id
        ];
        
        $statement = $db->prepare(
            "UPDATE `veterinary` SET `x` = :x, `y` = :y, `businessname` = :businessname, `phone` = :phone, `email` = :email, `address` = :address WHERE `id` = :id"
        );
        
        $statement->execute($data);


        $_SESSION['businessname'] = $businessname;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['vetX'] = $x;
        $_SESSION['vetY'] = $y;
        $_SESSION['address'] = $address;
    
    $form_data["success"] = true;
    $form_data["posted"] = "...Değişiklikleriniz Kaydedildi...";
}

echo json_encode($form_data);

?>
