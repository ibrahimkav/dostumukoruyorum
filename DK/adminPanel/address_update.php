<?php 
    require  'base.php';

    $errors = ""; 
    $form_data = array(); 
    $obj = json_decode($_POST["myData"]);

    $userId = $obj->userId;
    $ilId = $obj->ilId;
    $ilceId = $obj->ilceId;
    $directions = $obj->directions;
    $id = $obj->id;

    if (empty($userId)) { 
        $errors = $errors."Kullanıcı id boş olamaz. </br>";
    }
    if (empty($ilId)) { 
        $errors = $errors."İl Id boş olamaz.</br>";
    }
    if (empty($ilceId)) { 
        $errors = $errors."İlçe Id boş olamaz.</br>";
    }


    if (!empty($errors)) { 
        $form_data['success'] = false;
        $form_data['errors']  = $errors;
    }
    else { 
		
        $data = [
            'userId' => $userId,
            'ilId' => $ilId,
            'ilceId' => $ilceId,
            'directions' => $directions,
            'id' => $id
        ];
        

        $statement = $db->prepare('update `address` set `userId` = :userId,`ilId` = :ilId,`ilceId` = :ilceId,`directions` = :directions where id = :id');
        $statement-> execute($data);
        
        session_start();
        $admin_id = $_SESSION['id'];

        $logs_data = [
            'admin_id' => $admin_id,
            'logs' => $userId.' de düzenleme yapıldı.'
        ];
        
        $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
        $logs_statement-> execute($logs_data);

        $form_data['success'] = true;
        $form_data['posted'] = 'Adres Düzenlendi.';
    }


    echo json_encode($form_data);

?>