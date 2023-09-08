<?php
require "base.php";

require "PHPMailer-master/src/Exception.php";
require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$email = $obj->email;
$email_con = true;


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

if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
} else {
  


    $data = [
        "email" => $email,
    ];
    
    $statement = $db->prepare(
        "SELECT COUNT(0) AS control FROM lostPassword WHERE email = :email"
    );
    
    $statement->execute($data);
    $result = $statement->fetch();
    $control = $result["control"];
    if($control > 0){

        $data = [
            "email" => $email,
        ];
        
        $statement = $db->prepare(
            "DELETE FROM lostPassword WHERE email = :email"
        );
        
        $statement->execute($data);
        $result = $statement->fetch();
    }


    $code = mt_rand(1000000, 9999999);

    $data = [
        "email" => $email,
        "code" => $code,
    ];
    
    $statement = $db->prepare(
        "INSERT INTO lostPassword (lostPassword.`email`,lostPassword.`code`) VALUES(:email,:code)"
    );
    
    $statement->execute($data);
    $result = $statement->fetch();

    header('Content-Type: text/html; charset=utf-8');

    $encryptedEmail = base64_encode($email);

    $resetLink =
        "Merhaba şifrenizi değiştirmek için gerekli link:  https://dostumukoruyorum.com/sifre_sifirla.php?email=" . urlencode($encryptedEmail)." Doğrulama Kodunuz : $code ";
    
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.outlook.com"; 
    $mail->SMTPAuth = true;
    $mail->Username = "dostumukoruyorum@outlook.com"; 
    $mail->Password = "m52koruyorumdostumu"; 
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      
	
    $mail->setFrom("dostumukoruyorum@outlook.com", "Dostumu Koruyorum"); 
    $mail->addAddress($email); 
    
    $mail->Subject = "Şifre Sıfırlama";
    $mail->CharSet = 'UTF-8';
    $mail->Body =
        "Şifrenizi sıfırlamak için aşağıdaki linke tıklayın: " . $resetLink;
    
    $posted = "";
    
    if ($mail->send()) {
       $posted =  "Şifre sıfırlama linki e-posta adresinize gönderildi.";
    } else {
        $posted =  "E-posta gönderimi başarısız oldu. Hata: " . $mail->ErrorInfo;
    }

    $form_data["success"] = true;
    $form_data["posted"] = "...Eposta adresinize link gönderildi...";
}

echo json_encode($form_data);

?>
