<?php
require "base.php";

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$tc = $obj->tc;
$password = $obj->password;
$remember = $obj->remember;


if (empty($password)) {
    $errors = $errors . "Şifre boş olamaz. </br>";
}

if (strlen($password) > 100) {
    $errors = $errors . "Şifre en fazla 100 karakter olabilir.</br>";
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


$hashedPassword = md5($password);



if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
} else {

    $data = [
        "tc" => $tc,
        "password" => $hashedPassword
    ];

    $statement = $db->prepare(
        "SELECT * FROM `user` WHERE `tckno` = :tc AND `password` = :password and isDeleted = 0 and isActive = 1"
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
        $_SESSION['tckno'] = $result["tckno"];
        $_SESSION['phone'] = $result["phone"];
        $_SESSION['address'] = $result["address"];
        $_SESSION['password'] = $result["password"];
        $_SESSION['dateOfBirth'] = $result["dateOfBirth"];
        $_SESSION['isVeterinary'] = $result["isVeterinary"];
    

        if($remember == 1){
             
            $cookie_name = "user";

            $cookie_value = base64_encode($result["id"]);
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 30 gün boyunca geçerli
        }
    
        $form_data["success"] = true;
        $form_data["posted"] = "Başarı ile giriş yaptınız yönlendiriliyorsunuz.";
    }else{
        $form_data["success"] = false;
        $form_data["errors"] =  "Lütfen giriş bilgilerinizi kontrol ediniz.";
    }
   
}

echo json_encode($form_data);

?>
