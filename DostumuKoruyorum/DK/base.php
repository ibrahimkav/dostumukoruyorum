<?php 

require 'connect.php';

if($_SERVER['HTTP_HOST'] != "localhost"){
if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
    $redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $redirect_url");
    exit();
}


$cookie_name = "user";

if(isset($_COOKIE[$cookie_name])){

    $cookie_value = $_COOKIE[$cookie_name];
    $decoded_value = base64_decode($cookie_value);

     if(empty($_SESSION["id"]) ){

        $data = [
            "id" => $id,
        ];
    
        $statement = $db->prepare(
            "SELECT * FROM `user` WHERE `id` = :id and isDeleted = 0 and isActive = 1"
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
        
        }



     }

}




}
?>
