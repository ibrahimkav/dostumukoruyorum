<?php 
include "connect.php";

function ilGetir(){
    global $db;
    $sql="SELECT * FROM iller";
    $statement= $db->prepare($sql);
    $statement->execute();
    return $statement->fetchAll();
}


function ilceGetir($ilId){
    global $db;
    $sql ="SELECT * FROM ilce WHERE ilId = ?";
    $statement = $db->prepare($sql);
    $statement->execute([
        $ilId
    ]);
    return $statement->fetchAll();
}

if(isset($_GET["ilId"]))
    echo json_encode(ilceGetir($_GET["ilId"]));

?>