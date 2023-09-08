<?php 
    require  'base.php';

    $errors = ""; 
    $form_data = array(); 
    $obj = json_decode($_POST["myData"]);

    $petname = $obj->petname;
    $animalDescription = $obj->animalDescription;
    $breed = $obj->breed;
    $gender = $obj->gender;
    $dateOfBirth = $obj->dateOfBirth;
    $vaccine1 = $obj->vaccine1;
    $date1 = $obj->date1;
    $vaccine2 = $obj->vaccine2;
    $date2 = $obj->date2;
    $vaccine3 = $obj->vaccine3;
    $date3 = $obj->date3;
    $vaccine4 = $obj->vaccine4;
    $date4 = $obj->date4;
    $isActive = $obj->isActive;
    $id = $obj->id;

    if (empty($petname)) { 
        $errors = $errors."Hayvan adı boş olamaz. </br>";
    }
    if (empty($animalDescription)) { 
        $errors = $errors."Hayvan Açıklaması boş olamaz.</br>";
    }
    if (empty($breed)) { 
        $errors = $errors."Hayvan Doğum Sayısı boş olamaz.</br>";
    }
    if (empty($dateOfBirth)) { 
        $errors = $errors."Hayvan Doğum Tarihi boş olamaz.</br>";
    }
    if ($gender != 1 && $gender != 0) { 
        $errors = $errors."Lütfen geçerli bir cinsiyet seçiniz.</br>";
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
            'petname' => $petname,
            'animalDescription' => $animalDescription,
            'breed' => $breed !== '' ? $breed : null,
            'gender' => $gender,
            'dateOfBirth' => $dateOfBirth,
            'vaccine1' => $vaccine1 !== '' ? $vaccine1 : null,
            'date1' => $date1 !== '' ? $date1 : null,
            'vaccine2' => $vaccine2 !== '' ? $vaccine2 : null,
            'date2' => $date2 !== '' ? $date2 : null,
            'vaccine3' => $vaccine3 !== '' ? $vaccine3 : null,
            'date3' => $date3 !== '' ? $date3 : null,
            'vaccine4' => $vaccine4 !== '' ? $vaccine4 : null,
            'date4' => $date4 !== '' ? $date4 : null,
            'isActive' => $isActive,
            'id' => $id
        ];
        
        $statement = $db->prepare('UPDATE `animals` SET `petname` = :petname, `animalDescription` = :animalDescription, `breed` = :breed, `gender` = :gender, `dateOfBirth` = :dateOfBirth, `vaccine1` = :vaccine1, `date1` = :date1, `vaccine2` = :vaccine2, `date2` = :date2, `vaccine3` = :vaccine3, `date3` = :date3, `vaccine4` = :vaccine4, `date4` = :date4, `isActive` = :isActive WHERE `id` = :id');
        $statement->execute($data);

        session_start();
        $admin_id = $_SESSION['id'];

        $logs_data = [
            'admin_id' => $admin_id,
            'logs' => $petname.' de düzenleme yapıldı.'
        ];
        
        $logs_statement = $db->prepare('INSERT INTO `logs` (`admin_id`,`logs`,`createdDate`) VALUES(:admin_id,:logs,NOW())');
        $logs_statement-> execute($logs_data);
        
        $form_data['success'] = true;
        $form_data['posted'] = 'Hayvan Düzenlendi.';
        
    }


    echo json_encode($form_data);

?>