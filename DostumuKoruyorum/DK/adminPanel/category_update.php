<?php 
    require  'base.php';

    $errors = ""; 
    $form_data = array(); 
    $obj = json_decode($_POST["myData"]);

    $categoryName = $obj->categoryName;
    $categoryDescription = $obj->categoryDescription;
    $isActive = $obj->isActive;
    $id = $obj->id;

    if (empty($categoryName)) { 
        $errors = $errors."Kategori adı boş olamaz. </br>";
    }
    if (empty($categoryDescription)) { 
        $errors = $errors."Kategori Açıklaması boş olamaz.</br>";
    }
    if ($isActive != 1 && $isActive != 0) { 
        $errors = $errors."Lütfen geçerli bir aktiflik durumu seçiniz.</br>";
    }

    $data = [
        'categoryName' => $categoryName,
        'id' => $id
    ];

    $statement = $db->prepare('SELECT COUNT(0) AS control FROM category  WHERE categoryName = :categoryName and id != :id');
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
            'categoryDescription' => $categoryDescription,
            'isActive' => $isActive,
            'id' => $id
        ];
 

        $statement = $db->prepare('update `category` set `categoryName` = :categoryName,`categoryDescription` = :categoryDescription,`isActive` = :isActive where id = :id');
        $statement-> execute($data);

        session_start();
        $admin_id = $_SESSION['id'];

        $logs_data = [
            'admin_id' => $admin_id,
            'logs' => $categoryName.' de düzenleme yapıldı.'
        ];
        
        $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
        $logs_statement-> execute($logs_data);

        $form_data['success'] = true;
        $form_data['posted'] = 'Kategori Düzenlendi.';
    }


    echo json_encode($form_data);

?>