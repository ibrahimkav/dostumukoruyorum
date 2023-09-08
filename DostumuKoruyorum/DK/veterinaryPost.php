<?php
require "base.php";


session_start();

$errors = "";
$form_data = [];
$test = $_POST["businessname"];

$businessname =  $_POST["businessname"];
$email =$_POST["email"];
$address =$_POST["address"];
$phonenumber =$_POST["phonenumber"];
$Xdirection = $_POST["Xdirection"];
$Ydirection =$_POST["Ydirection"];

$name ="";
$error = "";
$size = 0;


$id = $_SESSION["id"];


if($id <= 0){
    $errors = $errors . "Giriş yapmanız gerekmektedir. </br>";
}

if(isset($_FILES['file'])){
    $name = $_FILES['file']['name'];
    $error = $_FILES['file']['error'];
    $size = $_FILES['file']['size'];
}


if (empty($businessname)) {
    $errors = $errors . "İşyeri İsmi boş olamaz. </br>";
}

if (strlen($businessname) > 200) {
    $errors = $errors . "İşyeri İsmi en fazla 200 karakter olabilir.</br>";
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


if (empty($phonenumber)) {
    $errors = $errors . "Telefon numarası boş olamaz. </br>";
}

if (strlen($phonenumber) > 100) {
    $errors = $errors . "Geçerli bir telefon numarası giriniz.</br>";
}

$addressControl = str_replace(" ","",$address);


if (empty($address)  || !isset($addressControl) ) {
    $errors = $errors . "Adres boş olamaz. </br>";
}


if ($name == "" ) {
    $errors = $errors . "Sertifika  boş olamaz. </br>";
}

if(!is_numeric($Xdirection) || !is_numeric($Ydirection)){
    $errors = $errors . "X yada Y sayısal bir değer olmak zorundadır..</br>";
}

$data = [
    "id" => $id,
];

$statement = $db->prepare(
    "SELECT COUNT(0) AS control FROM veterinary WHERE userId = :id"
);

$statement->execute($data);
$result = $statement->fetch();

$control = $result["control"];
if ($control != 0) {
    $errors = $errors . "Daha önce bir başvurunuz bulunmaktadır. </br>";
}


$searchVal = array("-", "(", ")"," ");
 
$replaceVal = array("", "", "","");

$phoneNumber = "0".str_replace($searchVal,$replaceVal,$phonenumber);

if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
} else {
   
    move_uploaded_file("uploads/", $name);


    $data = [
        "businessname" => $businessname,
        "email" => $email,
        "phone" => $phonenumber,
        "address" => $address,
        "Xdirection" =>$Xdirection,
        "Ydirection" =>$Ydirection,
        "file" =>$name,
        "userId" =>$id
    ];

    $statement = $db->prepare(
        "INSERT INTO `veterinary` (`businessname`,`email`,`phone`,`address`,`x`,`y`,`file`,`userId`,`createdDate`,`approved`) 
        VALUES(:businessname,:email,:phone,:address,:Xdirection,:Ydirection,:file,:userId,NOW(),1)"
    );
    $statement->execute($data);

    $data = [
        "id" =>$id
    ];

    $statement = $db->prepare(
        "UPDATE vetpet.user SET vetpet.`user`.`isVeterinary` = 1 WHERE vetpet.`user`.`id` = :id"
    );
    $statement->execute($data);

    $form_data["success"] = true;
    $form_data["posted"] = "Başvurunuz başarılı bir şekilde gönderilmiştir. Onaylandığında size bildirim gelicektir.";
}

echo json_encode($form_data);

?>
