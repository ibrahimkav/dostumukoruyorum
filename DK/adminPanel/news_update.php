<?php 
    require  'base.php';

    $errors = ""; 
    $form_data = array(); 
    $obj = json_decode($_POST["myData"]);

    $head = $obj->head;
    $desc = $obj->desc;
    $content = $obj->content;
    $isActive = $obj->isActive;
    $id = $obj->id;

    if (empty($head)) { 
        $errors = $errors."News adı boş olamaz. </br>";
    }
    if (empty($desc)) { 
        $errors = $errors."News Açıklaması boş olamaz.</br>";
    }
    if (empty($content)) { 
        $errors = $errors."News içerik boş olamaz.</br>";
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
            'head' => $head,
            'desc' => $desc,
            'content' => $content,
            'isActive' => $isActive,
            'id' => $id
        ];
 

        $statement = $db->prepare('update `news` set `head` = :head,`desc` = :desc,`content` = :content,`isActive` = :isActive where id = :id');
        $statement-> execute($data);

        session_start();
        $admin_id = $_SESSION['id'];

        $logs_data = [
            'admin_id' => $admin_id,
            'logs' => $head.' de news tablosunda düzenleme yapıldı.'
        ];
        
        $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
        $logs_statement-> execute($logs_data);

        $form_data['success'] = true;
        $form_data['posted'] = 'News Düzenlendi.';
    }


    echo json_encode($form_data);

?>