<?php 
    require  'base.php';

    $errors = ""; 
    $form_data = array(); 
    $obj = json_decode($_POST["myData"]);

    $ilId = $obj->ilId;
    $ilceAdi = $obj->ilceAdi;
    $id = $obj->id;

    if (empty($ilId)) { 
        $errors = $errors."il Id adı boş olamaz. </br>";
    }
    if (empty($ilceAdi)) { 
        $errors = $errors."İlce Adı  boş olamaz.</br>";
    }

    if (!empty($errors)) { 
        $form_data['success'] = false;
        $form_data['errors']  = $errors;
    }
    else { 
		
        $data = [
            'ilId' => $ilId,
            'ilceAdi' => $ilceAdi,
            'id' => $id
        ];
        

        $statement = $db->prepare('update `ilce` set `ilId` = :ilId,`ilceAdi` = :ilceAdi where id = :id');
        $statement-> execute($data);
        
        session_start();
        $admin_id = $_SESSION['id'];

        $logs_data = [
            'admin_id' => $admin_id,
            'logs' => $ilceAdi.' da düzenleme yapıldı.'
        ];
        
        $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
        $logs_statement-> execute($logs_data);

        $form_data['success'] = true;
        $form_data['posted'] = 'İlce Düzenlendi.';
    }


    echo json_encode($form_data);

?>