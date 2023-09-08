
<?php
require "../base.php";

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$email = $obj->email;
$password = $obj->password;


if (strlen($email) > 100) {
    $errors = $errors . "Email en fazla 100 karakter olabilir.</br>";
}

if (empty($email)) {
    $errors = $errors . "Email boş olamaz.</br>";
} else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors = $errors . "Geçersiz email adresi.</br>";
    }
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


    $hashedPassword = md5($password);

    $data = [
        "email" => $email,
        "password" => $hashedPassword
    ];

    
    $statement = $db->prepare(
        "SELECT * FROM `user` WHERE `email` = :email AND `password` = :password and isDeleted = 0 and isActive = 1 and isVeterinary = 1"
    );
    
    $statement->execute($data);
    $result = $statement -> fetch();
    $row_cnt = $statement->rowCount();

    if($row_cnt > 0){
        
        session_start();
        $_SESSION['id'] = $result["id"];
        $_SESSION['firstname'] = $result["firstname"];
        $_SESSION['lastname'] = $result["lastname"];
        $_SESSION['fullname'] = $result["fullname"];
        $_SESSION['lastname'] = $result["lastname"];
        $_SESSION['tckno'] = $result["tckno"];
        $_SESSION['phone'] = $result["phone"];
        $_SESSION['address'] = $result["address"];
        $_SESSION['password'] = $result["password"];
        $_SESSION['dateOfBirth'] = $result["dateOfBirth"];
        $_SESSION['isVeterinary'] = $result["isVeterinary"];



        $data = [
            "userId" => $result["id"]
        ];
    
        
        $statement = $db->prepare(
            "SELECT * FROM veterinary WHERE userId = :userId"
        );
        
        $statement->execute($data);
        $result = $statement -> fetch();
        $row_cnt = $statement->rowCount();


        $_SESSION['veterinaryId'] = $result["id"];
        $_SESSION['businessname'] = $result["businessname"];
        $_SESSION['email'] = $result["email"];
        $_SESSION['phone'] = $result["phone"];
        $_SESSION['vetX'] = $result["x"];
        $_SESSION['vetY'] = $result["y"];
        $_SESSION['address'] = $result["address"];
    
    
        $form_data["success"] = true;
        $form_data["posted"] = "Başarı ile giriş yaptınız yönlendiriliyorsunuz.";
    }else{
        $form_data["success"] = false;
        $form_data["errors"] =  "Lütfen giriş bilgilerinizi kontrol ediniz.";
    }
   
}

echo json_encode($form_data);

?>
