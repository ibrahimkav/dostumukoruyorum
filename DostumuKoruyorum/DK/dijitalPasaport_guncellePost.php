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
$aId = $obj->aId;
$isActive = $obj->isActive;


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

if ($isActive != 1 && $isActive != 2) {
    $errors .= "Geçerli bir aktiflik durumu belirtliniz. <br>";
}

if ($gender != 1 && $gender != 2) {
    $errors .= "Geçerli bir cinsiyet  belirtliniz. <br>";
}


if (empty($gender)) {
    $errors = $errors . "Cinsiyet boş olamaz. </br>";
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
    $id = $_SESSION['id'];

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
        "aId" => $aId,
        "isActive" => $isActive
    ];
    
    $statement = $db->prepare(
    "UPDATE animals 
    INNER JOIN user ON animals.userId = user.id 
    SET animals.petname = :petname, 
        animals.breed = :breed, 
        animals.gender = :gender, 
        animals.dateOfBirth = :dateOfBirth, 
        animals.vaccine1 = :vaccine1, 
        animals.vaccine2 = :vaccine2, 
        animals.vaccine3 = :vaccine3, 
        animals.vaccine4 = :vaccine4, 
        animals.date1 = :date1, 
        animals.date2 = :date2, 
        animals.date3 = :date3, 
        animals.date4 = :date4,
        animals.isActive = :isActive
    WHERE user.id = :id and animals.id = :aId"
);    
    $statement->execute($data);
    
    $form_data["success"] = true;
    $form_data["posted"] = "...Pasaportunuz Güncellendi...";
}

echo json_encode($form_data);

?>
