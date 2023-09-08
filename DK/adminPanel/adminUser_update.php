<?php 
    require  'base.php';

    $errors = ""; 
    $form_data = array(); 
    $obj = json_decode($_POST["myData"]);

    $username = $obj->username;
    $password = $obj->password;
    $isActive = $obj->isActive;
    $id = $obj->id;

    if (empty($username)) { 
        $errors = $errors."Admin adı boş olamaz. </br>";
    }
    if (empty($password)) { 
        $errors = $errors."Şifre kısmı boş olamaz.</br>";
    }
    if ($isActive != 1 && $isActive != 0) { 
        $errors = $errors."Lütfen geçerli bir aktiflik durumu seçiniz.</br>";
    }


    if (!empty($errors)) { 
        $form_data['success'] = false;
        $form_data['errors']  = $errors;
    }
    else {
        $hash_password = password_hash($password, PASSWORD_DEFAULT); 
		
        $data = [
            'username' => $username,
            'password' => $hash_password,
            'isActive' => $isActive,
            'id' => $id
        ];
        

        $statement = $db->prepare('update `admin` set `username` = :username,`password` = :password,`isActive` = :isActive where id = :id');
        $statement-> execute($data);
        
        session_start();
        $admin_id = $_SESSION['id'];

        $logs_data = [
            'admin_id' => $admin_id,
            'logs' => $username.' de düzenleme yapıldı.'
        ];
        
        $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
        $logs_statement-> execute($logs_data);

        $form_data['success'] = true;
        $form_data['posted'] = 'Admin Düzenlendi.';
    }


    echo json_encode($form_data);

?>