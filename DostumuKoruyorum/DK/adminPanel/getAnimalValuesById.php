<?php
require  'base.php';


$id = $_GET["id"];

$data = [
    "id" => $id
];

$statement = $db->prepare(
    "SELECT * FROM animals WHERE id = :id"
);
$statement->execute($data);
$result = $statement -> fetch();

echo json_encode($result);


?>