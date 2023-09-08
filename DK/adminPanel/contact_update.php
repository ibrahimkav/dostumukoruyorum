<?php 
    require  'base.php';

    $errors = ""; 
    $form_data = array(); 
    $obj = json_decode($_POST["myData"]);

    $fullname = $obj->fullname;
    $email = $obj->email;
    $phonenumber = $obj->phonenumber;
    $comment = $obj->comment;
    $isActive = $obj->isActive;
    $id = $obj->id;

    if (empty($fullname)) { 
        $errors = $errors."İsim ve soyisim boş olamaz. </br>";
    }
    if (empty($email)) { 
        $errors = $errors."Email Açıklaması boş olamaz.</br>";
    }
    if (empty($phonenumber)) { 
        $errors = $errors."Telefon numarası boş olamaz.</br>";
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
            'fullname' => $fullname,
            'email' => $email,
            'phonenumber' => $phonenumber,
            'comment' => $comment,
            'isActive' => $isActive,
            'id' => $id
        ];
 

        $statement = $db->prepare('update `contact` set `fullname` = :fullname,`email` = :email,`phonenumber` = :phonenumber,`comment` = :comment,`isActive` = :isActive where id = :id');
        $statement-> execute($data);

        session_start();
        $admin_id = $_SESSION['id'];

        $logs_data = [
            'admin_id' => $admin_id,
            'logs' => $fullname.' adlı kullanıcının contact tablosunda güncelleme yapıldı.'
        ];
        
        $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
        $logs_statement-> execute($logs_data);

        $form_data['success'] = true;
        $form_data['posted'] = 'İletişim Düzenlendi.';
    }


    echo json_encode($form_data);

?>