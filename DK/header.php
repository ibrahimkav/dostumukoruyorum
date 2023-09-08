<?php
error_reporting(E_ERROR | E_PARSE);
session_start();               

require 'base.php';

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Dostumu Koruyorum </title>
    <link rel="shortcut icon" href="assets/img/yeni.ico" />
    <meta charset="UTF-8">
    <meta name="description" content="Evcil Hayvan Platformu">
    <meta name="keywords" content="Evcil Hayvanlar, Veterinerler">
    <meta name="author" content="Dostumu Koruyorum">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css'>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


<body>

<section id="services" class="services" style="margin-top: 0px;">
        <nav class="navbar navbar-dark navbar-expand-xxl sticky-top pulse animated py-3" style="background: rgba(255,255,255,0.52);color: rgb(27,60,94);padding-left: 141px;padding-bottom: 15px;margin-left: -150px;margin-top: 0px;padding-top: 15px;margin-bottom: 0px;">
            <div class="container mt-3 ">
                
            
            <a class="navbar-brand d-flex align-items-center" href="index.php" style="margin-right: 10px;margin-left: -100px;padding-right: 0px;">
        
            <img class="mobil-img" src="assets/logo/dk_logo.png" style="width:150px"/>    
            </a>
                    <ul class="navbar-nav mx-auto">
                        
                        <li class="nav-item" style="margin-left: -202px;"><a class="nav-link active" href="index.php" style="margin-right: 0px;margin-left: 202px;"><span style="color: rgb(53, 69, 82);">AnaSayfa</span></a></li>
                        <li class="nav-item"><a class="nav-link active" href="contact.php" style="color: rgba(10,77,37,0.66);margin-right: 0px;">İletişim</a></li>
                        <li class="nav-item"><a class="nav-link active" href="yardim.php" style="color: rgba(10,77,37,0.66);margin-right: 0px;">Yardım</a></li>
                        <li class="nav-item"><a class="nav-link active" href="forum.php" style="color: rgba(10,77,37,0.66);margin-right: 0px;">Forum</a></li>
                        <li class="nav-item"><a class="nav-link active" href="veteriner_arama.php" style="color: rgba(10,77,37,0.66);margin-right: 0px;">Veterinerler</a></li>

                        <li class="nav-item"></li>
                    </ul>
                                    
                                    <?php
                                        if ($_SESSION["id"] == null) {
                                            echo  "<a class='nav-link active' data-bss-hover-animate='bounce' href='veterinary/veterinarylogin.php'><strong><span style='color: rgba(10, 77, 37, 0.66);'style='text-decoration: none'>Veteriner Girişi</span></strong></a>"."<br>";
                                            echo  "<div class='float-start float-md-end mt-5 mt-md-0 search-area'></div>";
                                            echo  "<button class='btn btn-primary' data-bss-hover-animate='bounce' type='button' style='background: #1f4037;box-shadow: 0px 0px;width: 102.5px;height: 49px;margin: 16px;backdrop-filter: opacity(0);border-color: #1f4037;margin-right: 19px;'>";
                                            echo  "<a class='nav-link active' data-bss-hover-animate='bounce' href='login.php'><strong><span style='color: #ffffff' style='text-decoration: none'>Giriş Yap</span></strong></a> ";
                                        }
                                        else{
                                            echo  "<div style='cursor:pointer;' onclick=\"window.location.href = '\\accountdetails.php'\"/> <i class='fa fa-user' aria-hidden='true'></i>
                                                    ".$_SESSION['firstname']." ".$_SESSION['lastname'].
                                                    "</div>";
                                        }
                                    ?>
                </div>
            </div>
        </nav>

  