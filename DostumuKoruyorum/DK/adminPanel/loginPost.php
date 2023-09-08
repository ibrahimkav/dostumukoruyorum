<?php
require "base.php";

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$username = $obj->username;
$password = $obj->password;

if (empty($username)) {
    $errors = $errors . "Kullanıcı Adı boş olamaz. </br>";
}

if (strlen($username) > 100) {
    $errors = $errors . "Kullanıcı Adı en fazla 100 karakter olabilir.</br>";
}

if (empty($password)) {
    $errors = $errors . "Şifre boş olamaz. </br>";
}

if (strlen($password) > 100) {
    $errors = $errors . "Şifre en fazla 100 karakter olabilir.</br>";
}


if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
} else {


    $data = [
        "username" => $username//,
        //"password" => $password
    ];

    $statement = $db->prepare(
        "SELECT * FROM admin WHERE username = :username AND isActive=1" // AND password = :password AND 
    );

    $statement->execute($data);
    $result = $statement -> fetch();
    $row_cnt = $statement->rowCount();

    if($row_cnt > 0){

        $hast_password = password_verify($password, $result["password"]);
        if($hast_password)
        {
            session_start();

            $_SESSION['id'] = $result["id"];
            $_SESSION['username'] = $result["username"];
            $_SESSION['password'] = $result["password"];


            $form_data["success"] = true;
            $form_data["posted"] = "Başarı ile giriş yaptınız yönlendiriliyorsunuz.";
        }
        else
        {
            $form_data["success"] = false;
            $form_data["errors"] =  "Lütfen giriş bilgilerinizi kontrol ediniz.";
        }
    }else{
        $form_data["success"] = false;
        $form_data["errors"] =  "Lütfen giriş bilgilerinizi kontrol ediniz.";
    }

}

echo json_encode($form_data);

?>