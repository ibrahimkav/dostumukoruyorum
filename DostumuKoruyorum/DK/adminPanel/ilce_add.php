<?php 
    require  'base.php';

    $errors = ""; 
    $form_data = array(); 
    $obj = json_decode($_POST["myData"]);

    $ilId = $obj->ilId;
    $ilceAdi = $obj->ilceAdi;

    if (empty($ilId)) { 
        $errors = $errors."il Id adı boş olamaz. </br>";
    }
    if (empty($ilceAdi)) { 
        $errors = $errors."İlce Adı  boş olamaz.</br>";
    }

    $data = [
        'ilceAdi' => $ilceAdi
    ];

    $statement = $db->prepare('SELECT COUNT(0) AS control FROM ilce  WHERE ilceAdi = :ilceAdi');
    $statement-> execute($data);
    $result = $statement -> fetch();

    $control = $result["control"];
    if($control != 0)
    {
        $errors = $errors."$ilceAdi adında bir kayıt mevcut.</br>";
    }


    if (!empty($errors)) { 
        $form_data['success'] = false;
        $form_data['errors']  = $errors;
    }
    else { 
		
        $data = [
            'ilId' => $ilId,
            'ilceAdi' => $ilceAdi
        ];
 

        $statement = $db->prepare('INSERT INTO `ilce` (`ilId`,`ilceAdi`) VALUES(:ilId,:ilceAdi)');
        $statement-> execute($data);
        
        session_start();
        $admin_id = $_SESSION['id'];

        $logs_data = [
            'admin_id' => $admin_id,
            'logs' => $ilceAdi.' adlı ilce sisteme kaydedildi.'
        ];
        
        $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
        $logs_statement-> execute($logs_data);

        $form_data['success'] = true;
        $form_data['posted'] = 'İlce eklendi.';
    }


    echo json_encode($form_data);

?>