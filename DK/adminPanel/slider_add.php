<?php 
    require  'base.php';
    
    $errors = ""; 
    $form_data = array(); 
    $obj = json_decode($_POST["myData"]);

    $head = $obj->head;
    $explanation = $obj->explanation;
    $isActive = $obj->isActive;

    if (empty($head)) { 
        $errors = $errors."Slider adı boş olamaz.</br>";
    }
    if (empty($explanation)) { 
        $errors = $errors."Slider Açıklaması boş olamaz.</br>";
    }
    if ($isActive != 1 && $isActive != 0) { 
        $errors = $errors."Lütfen geçerli bir aktiflik durumu seçiniz.</br>";
    }
    
    $statement = $db->prepare('SELECT COUNT(0) AS control FROM slider  WHERE head = :head and id != :id');
    $statement-> execute($data);
    $result = $statement -> fetch();

    $control = $result["control"];
    if($control != 0)
    {
        $errors = $errors."$head adında bir kayıt mevcut.</br>";
    }


    if (!empty($errors)) { 
        $form_data['success'] = false;
        $form_data['errors']  = $errors;
    }
    else { 
		
        $data = [
            'head' => $head,
            'explanation' => $explanation,
            'isActive' => $isActive
        ];
 

        $statement = $db->prepare('INSERT INTO `slider` (`head`,`explanation`,`isActive`,`createdDate`) VALUES(:head,:explanation,:isActive,NOW())');
        $statement-> execute($data);

        session_start();
        $admin_id = $_SESSION['id'];

        $logs_data = [
            'admin_id' => $admin_id,
            'logs' => $head.' adlı slider sisteme kaydedildi.'
        ];
        
        $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
        $logs_statement-> execute($logs_data);

        $form_data['success'] = true;
        $form_data['posted'] = 'Slider eklendi.';
          
    }


    echo json_encode($form_data);

?>