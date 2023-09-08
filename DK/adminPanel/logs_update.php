<?php 
    require  'base.php';

    $errors = ""; 
    $form_data = array(); 
    $obj = json_decode($_POST["myData"]);

    $logs = $obj->logs;
    $id = $obj->id;

    if (empty($logs)) { 
        $errors = $errors."Log Açıklaması boş olamaz. </br>";
    }


    if (!empty($errors)) { 
        $form_data['success'] = false;
        $form_data['errors']  = $errors;
    }
    else { 
		
        $data = [
            'logs' => $logs,
            'id' => $id
        ];
        

        $statement = $db->prepare('update `logs` set `logs` = :logs where id = :id');
        $statement-> execute($data);
        
        session_start();
        $admin_id = $_SESSION['id'];

        $logs_data = [
            'admin_id' => $admin_id,
            'logs' => $id.'li log da düzenleme yapıldı.'
        ];
        
        $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
        $logs_statement-> execute($logs_data);

        $form_data['success'] = true;
        $form_data['posted'] = 'Admin Düzenlendi.';
    }


    echo json_encode($form_data);

?>