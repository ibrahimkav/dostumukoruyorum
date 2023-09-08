<?php 
    require  'base.php';

    $errors = ""; 
    $form_data = array(); 
    $obj = json_decode($_POST["myData"]);

    $email = $obj->email;

    $isActive = $obj->isActive;

    if (empty($email)) { 
        $errors = $errors."Email boş olamaz. </br>";
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
            'isActive' => $isActive
        ];
 

        $statement = $db->prepare('INSERT INTO `subscribe` (`email`,`isActive`,`createdDate`) VALUES(:email,:isActive,NOW())');
        $statement-> execute($data);

        session_start();
        $admin_id = $_SESSION['id'];

        $logs_data = [
            'admin_id' => $admin_id,
            'logs' => $email.' adlı subscribe sisteme kaydedildi.'
        ];
        
        $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
        $logs_statement-> execute($logs_data);

        $form_data['success'] = true;
        $form_data['posted'] = 'Abone eklendi.';
    }


    echo json_encode($form_data);

?>