<?php
require "base.php";

$errors = "";
$form_data = [];
$obj = json_decode($_POST["myData"]);

$comment = $obj->comment;
$topicId = $obj->id;


session_start();

$id = $_SESSION['id'];


if($id < 0){
    $errors = $errors . "Giriş yapmanız gerekmektedir.</br>";
}

if($topicId < 0){
    $errors = $errors . "Konusuz yorum olamaz.</br>";
}


$commentControl = str_replace(" ","",$comment);

if (empty($commentControl) || !isset($commentControl)) {
    $errors = $errors . "Yorum boş kalamaz. </br>";
}



if (!empty($errors)) {
    $form_data["success"] = false;
    $form_data["errors"] = $errors;
} else {


    
    $data = [
        "userId" => $id,
        "comment" => $comment,
        "topicId" => $topicId,
    ];

    $statement = $db->prepare(
        "INSERT INTO topicComment (topicId,userId,COMMENT,createdDate,isDeleted) VALUES(:topicId,:userId,:comment,NOW(),0)"
    );
    $statement->execute($data);

    $form_data["success"] = true;
    $form_data["posted"] = "Yorum başarıyla eklendi.";
}

echo json_encode($form_data);

?>
