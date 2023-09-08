<?php
require "base.php";

session_start();

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$petname = $obj->petname;
$breed = $obj->breed;
$gender = $obj->gender;
$dateOfBirth = $obj->dateOfBirth;
$vaccine1 = $obj->vaccine1;
$vaccine2 = $obj->vaccine2;
$vaccine3 = $obj->vaccine3;
$vaccine4 = $obj->vaccine4; 
$date1 = $obj->date1;
$date2 = $obj->date2;
$date3 = $obj->date3;
$date4 = $obj->date4;

$id = $_SESSION['id'];

if ($id <=  0) {
    $errors .= "Giriş yapınız..<br>";
}

if (empty($petname)) {
    $errors = $errors . "Hayvan Adı boş olamaz. </br>";
}

if (strlen($petname) > 100) {
    $errors .= "Hayvan Adı en fazla 100 karakter olabilir.<br>";
}

if (empty($breed)) {
    $errors = $errors . "Irk boş olamaz. </br>";
}

if (strlen($breed) > 100) {
    $errors .= "Irk en fazla 100 karakter olabilir.<br>";
}

if ($gender != 1 && $gender != 2) {
    $errors .= "Geçerli bir cinsiyet  belirtliniz. <br>";
}

if (empty($gender)) {
    $errors = $errors . "Cinsiyet boş olamaz. </br>";
}

if ($gender != 1 && $gender != 2) {
    $errors = $errors . "Geçerli bir cinsiyet seçiniz. </br>";
}

if (empty($dateOfBirth)) {
    $errors = $errors . "Doğum Tarihi boş olamaz. </br>";
}

if (!empty($vaccine1) && strlen($vaccine1) > 100) {
    $errors .= "Aşı en fazla 100 karakter olabilir. </br>";
}
if (!empty($vaccine2) && strlen($vaccine2) > 100) {
    $errors .= "Aşı en fazla 100 karakter olabilir. </br>";
}
if (!empty($vaccine3) && strlen($vaccine3) > 100) {
    $errors .= "Aşı en fazla 100 karakter olabilir. </br>";
}
if (!empty($vaccine4) && strlen($vaccine4) > 100) {
    $errors .= "Aşı en fazla 100 karakter olabilir. </br>";
}

if (empty($vaccine1) && empty($vaccine2) && empty($vaccine3) && empty($vaccine4)) {
    $errors = $errors . "En az bir aşı bilgisi doldurulmalıdır. </br>";
}
else {
    if (!empty($vaccine1) && empty($date1)) {
        $errors .= "Aşı tarihi boş olamaz. </br>";
    }
    if (!empty($vaccine2) && empty($date2)) {
        $errors .= "Aşı tarihi boş olamaz. </br>";
    }
    if (!empty($vaccine3) && empty($date3)) {
        $errors .= "Aşı tarihi boş olamaz. </br>";
    }
    if (!empty($vaccine4) && empty($date4)) {
        $errors .= "Aşı tarihi boş olamaz. </br>";
    }
}



if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
    } 
    else {

    $data = [
        "id" => $id,
        "petname" => $petname,
        "breed" => $breed,
        "gender" => $gender,
        "dateOfBirth" => $dateOfBirth,
        "vaccine1" => $vaccine1,
        "vaccine2" => $vaccine2,
        "vaccine3" => $vaccine3,
        "vaccine4" => $vaccine4,
        "date1" => $date1,
        "date2" => $date2,
        "date3" => $date3,
        "date4" => $date4,
    ];
    
    $statement = $db->prepare(
        "INSERT INTO animals 
        (userId,petname,isActive,breed,gender,vaccine1,vaccine2,vaccine3,vaccine4,date1,date2,date3,date4,createdDate,dateOfBirth)
        VALUES(:id,:petname,1,:breed,:gender,:vaccine1,:vaccine2,:vaccine3,:vaccine4,:date1,:date2,:date3,:date4,NOW(),:dateOfBirth)"
    );    
    
    $statement->execute($data);
    
    $form_data["success"] = true;
    $form_data["posted"] = "...Pasaportunuz Eklendi...";
}

echo json_encode($form_data);

?>
