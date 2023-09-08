<?php
require  'base.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->prepare('SELECT * FROM admin WHERE username = :username AND isActive = 1');
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result && password_verify($password, $result['password'])) {
        session_start();
        $_SESSION['username'] = $result['username'];
        $_SESSION['admin_id'] = $result['admin_id'];
        $post = 'Yönlendiriliyorsunuz.';
        header('Location: adminUser.php');
        exit();
    } else {
        $error = 'Kullanıcı adı veya şifre hatalı.';
        sleep(1);
    }
}

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Admin Panel Giriş</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="admin.css">
</head>