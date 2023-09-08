<?php
require 'base.php';

$errors = "";
$form_data = array();
$obj = json_decode($_POST["myData"]);

$head = $obj->head;
$explanation = $obj->explanation;
$isActive = $obj->isActive;
$id = $obj->id; // Eksik olan id değişkenini ekledik.

if (empty($head)) {
    $errors .= "Slider adı boş olamaz.</br>";
}
if (empty($explanation)) {
    $errors .= "Slider Açıklaması boş olamaz.</br>";
}
if ($isActive != 1 && $isActive != 0) {
    $errors .= "Lütfen geçerli bir aktiflik durumu seçiniz.</br>";
}

$data = [
    'head' => $head,
    'id' => $id
];

$statement = $db->prepare('SELECT COUNT(0) AS control FROM slider  WHERE head = :head and id != :id');
$statement->execute($data);
$result = $statement->fetch();

$control = $result["control"];
if ($control != 0) {
    $errors .= "$head adında bir kayıt mevcut.</br>";
}

if (!empty($errors)) {
    $form_data['success'] = false;
    $form_data['errors'] = $errors;
} else {
    $data = [
        'head' => $head,
        'explanation' => $explanation,
        'isActive' => $isActive,
        'id' => $id
    ];

    $statement = $db->prepare('UPDATE `slider` SET `head` = :head, `explanation` = :explanation, `isActive` = :isActive WHERE id = :id');
    $statement->execute($data);

    session_start();
    $admin_id = $_SESSION['id'];

    $logs_data = [
        'admin_id' => $admin_id,
        'logs' => $head.'adlı slider da düzenleme yapıldı.'
    ];
    
    $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
    $logs_statement-> execute($logs_data);

    $form_data['success'] = true;
    $form_data['posted'] = 'Slider Düzenlendi.';
}

echo json_encode($form_data);
?>
