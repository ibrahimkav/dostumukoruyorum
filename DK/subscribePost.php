<?php

require  'base.php';

$errors = ""; 
$form_data = array(); 
$obj = json_decode($_POST["myData"]);

$email = $obj->email;

if (empty($email)) { 
    $errors = $errors."Eposta adresi boş olamaz.";
}else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors = $errors . "Geçersiz email adresi.";
    }
}

if (strlen($email) > 100) {
    $errors = $errors . "Eposta adresi en fazla 100 karakter olabilir.";
}

$data = [
    'email' => $email
];

$statement = $db->prepare(
    "SELECT COUNT(0) AS control FROM subscribe  WHERE email = :email"
    );
$statement-> execute($data);
$result = $statement -> fetch();

$control = $result["control"];
if($control != 0)
{
    $errors = $errors."$email adında bir kayıt mevcut.";
}

if (!empty($errors)) { 
    $form_data['success'] = false;
    $form_data['errors']  = $errors;
}
else { 
    
    $data = [
        'email' => $email,
    ];


    $statement = $db->prepare(
        "INSERT INTO `subscribe` (`email`) VALUES(:email)"
        );
    $statement-> execute($data);

    $form_data['success'] = true;
    $form_data['posted'] = 'Haber Bültenine abone olduğunuz için Teşekkür Ederiz';
}


echo json_encode($form_data);
?>