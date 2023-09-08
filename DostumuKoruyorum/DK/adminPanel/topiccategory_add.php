<?php 
    require  'base.php';

    $errors = ""; 
    $form_data = array(); 
    $obj = json_decode($_POST["myData"]);

    $categoryName = $obj->categoryName;
    $isActive = $obj->isActive;

    if (empty($categoryName)) { 
        $errors = $errors."Konu kategori adı boş olamaz. </br>";
    }
    if ($isActive != 1 && $isActive != 0) { 
        $errors = $errors."Lütfen geçerli bir aktiflik durumu seçiniz.</br>";
    }

    $data = [
        'categoryName' => $categoryName
    ];

    $statement = $db->prepare('SELECT COUNT(0) AS control FROM topiccategory  WHERE categoryName = :categoryName');
    $statement-> execute($data);
    $result = $statement -> fetch();

    $control = $result["control"];
    if($control != 0)
    {
        $errors = $errors."$categoryName adında bir kayıt mevcut.</br>";
    }


    if (!empty($errors)) { 
        $form_data['success'] = false;
        $form_data['errors']  = $errors;
    }
    else { 
		
        $data = [
            'categoryName' => $categoryName,
            'isActive' => $isActive
        ];
 

        $statement = $db->prepare('INSERT INTO `topiccategory` (`categoryName`,`isActive`,`createdDate`) VALUES(:categoryName,:isActive,NOW())');

        session_start();
        $admin_id = $_SESSION['id'];

        $logs_data = [
            'admin_id' => $admin_id,
            'logs' => $categoryName.' adlı topiccategory sisteme kaydedildi.'
        ];
        
        $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
        $logs_statement-> execute($logs_data);
        $statement-> execute($data);
        $form_data['success'] = true;
        $form_data['posted'] = 'Kategori eklendi.';
    }


    echo json_encode($form_data);

?>