<?php 
    require  'base.php';

    $errors = ""; 
    $form_data = array(); 
    $obj = json_decode($_POST["myData"]);

    $email = $obj->email;
    $isActive = $obj->isActive;
    $id = $obj->id;

    if (empty($email)) { 
        $errors = $errors."E Mail boş olamaz. </br>";
    }

    if ($isActive != 1 && $isActive != 0) { 
        $errors = $errors."Lütfen geçerli bir aktiflik durumu seçiniz.</br>";
    }

    if (!empty($errors)) { 
        $form_data['success'] = false;
        $form_data['errors']  = $errors;
    }
    else { 
		
        $data = [
            'email' => $email,
            'isActive' => $isActive,
            'id' => $id
        ];
 

        $statement = $db->prepare('update `subscribe` set `email` = :email,`isActive` = :isActive where id = :id');
        $statement-> execute($data);

        session_start();
        $admin_id = $_SESSION['id'];

        $logs_data = [
            'admin_id' => $admin_id,
            'logs' => $email.'adlı subscribe da düzenleme yapıldı.'
        ];
        
        $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
        $logs_statement-> execute($logs_data);

        $form_data['success'] = true;
        $form_data['posted'] = 'Abone Düzenlendi.';
    }


    echo json_encode($form_data);

?>