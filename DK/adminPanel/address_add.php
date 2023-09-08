<?php 
    require  'base.php';

    $errors = ""; 
    $form_data = array(); 
    $obj = json_decode($_POST["myData"]);

    $userId = $obj->userId;
    $ilId = $obj->ilId;
    $ilceId = $obj->ilceId;
    $directions = $obj->directions;

    if (empty($userId)) { 
        $errors = $errors."Kullanıcı id boş olamaz. </br>";
    }
    if (empty($ilId)) { 
        $errors = $errors."İl Id boş olamaz.</br>";
    }
    if (empty($ilceId)) { 
        $errors = $errors."İlçe Id boş olamaz.</br>";
    }

    $data = [
        'userId' => $userId
    ];

    $statement = $db->prepare('SELECT COUNT(0) AS control FROM address  WHERE userId = :userId');
    $statement-> execute($data);
    $result = $statement -> fetch();

    $control = $result["control"];
    if($control != 0)
    {
        $errors = $errors."$userId adlı bir adres mevcut.</br>";
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
            'directions' => $directions
        ];
 

        $statement = $db->prepare('INSERT INTO `address` (`userId`,`ilId`,`ilceId`,`directions`,`createdDate`) VALUES(:userId,:ilId,:ilceId,:directions,NOW())');
        $statement-> execute($data);
        
        session_start();
        $admin_id = $_SESSION['id'];

        $logs_data = [
            'admin_id' => $admin_id,
            'logs' => $userId.' adlı adres sisteme kaydedildi.'
        ];
        
        $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
        $logs_statement-> execute($logs_data);

        $form_data['success'] = true;
        $form_data['posted'] = 'Adres eklendi.';
    }


    echo json_encode($form_data);

?>