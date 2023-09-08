<?php
error_reporting(E_ERROR | E_PARSE);
              
require 'base.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>
<head>
		<base href="../">
		<title>DK</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<link rel="shortcut icon" href="veterinary/assets/media/logos/beyaz_icon.ico" />
		<link href="veterinary/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
.swal2-popup {
  height: 400px; 
}
.swal2-icon.swal2-warning {
  font-size: 16px;
}

.swal2-title,
.swal2-content {
  font-size: 14px;
}
@media screen and (max-width: 600px) {

body {

}

}
</style>

</head>


	<body id="kt_body" class="sidebar-enabled">
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				<div id="kt_aside" class="aside py-9" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
					<div class="aside-logo flex-column-auto px-9 mb-9" id="kt_aside_logo">
						<a href="adminPanel/adminUser.php">
							<img alt="Logo" src="veterinary/assets/media/logos/yeni.png" class="h-150px logo" />
						</a>
					</div>
					<div class="aside-menu flex-column-fluid ps-5 pe-3 mb-9" id="kt_aside_menu">
						<div class="w-100 hover-scroll-overlay-y d-flex pe-2" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu, #kt_aside_menu_wrapper" data-kt-scroll-offset="100">
							<div class="menu menu-column menu-rounded fw-bold my-auto" id="#kt_aside_menu" data-kt-menu="true">
								<div class="menu-item">
									<a class="menu-link" href="adminPanel/adminUser.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Adminler</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link" href="adminPanel/categorys.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Kategoriler</span>
									</a>
								</div>

								<div class="menu-item">
									<a class="menu-link" href="adminPanel/animals.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Hayvanlar</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link" href="adminPanel/slider.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Slider</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link" href="adminPanel/user.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Kullanıcılar</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link" href="adminPanel/topiccategory.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Konu Kategorileri</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link" href="adminPanel/news.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">News</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link" href="adminPanel/subscribe.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Aboneler</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link" href="adminPanel/ilce.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">İlçeler</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link" href="adminPanel/address.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Adresler</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link" href="adminPanel/logs.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Loglar</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link" href="adminPanel/contact.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">İletişim</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link" href="adminPanel/bilgiguncelleme.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Bilgi Güncelleme</span>
									</a>
								</div>
								<div class="menu-item">
								&nbsp;&nbsp;&nbsp;</span>
										<span class="menu-title"><a onclick="window.location.href = 'adminPanel/logout.php'" href="javascript:;" class="btn btn-primary mt-2 yazi">&nbsp;
                                        <i class="fa fa-sign-out" aria-hidden="true"></i> Çıkış Yap </a></span>
									</a>
								</div>

							</div>
						</div>
					</div>
					
					<div class="aside-footer flex-column-auto px-9" id="kt_aside_footer">
						<div class="d-flex flex-stack">
							<div class="d-flex align-items-center">
								<div class="symbol symbol-circle symbol-40px">
									<img src="veterinary/assets/media/logos/yeni.png" alt="photo" />
								</div>
								<div class="ms-2">
									<a class="text-gray-800 text-hover-primary fs-6 fw-bolder lh-1">
									<?php  echo  "<div style='cursor:pointer;' onclick=\"window.location.href = '\\ adminPanel/bilgiguncelleme.php'\"/>
                                                    ".$_SESSION['username'].
                                                    "</div>";?> Hoşgeldin</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<div id="kt_header" class="header">
						<div class="container d-flex align-items-center justify-content-between" id="kt_header_container">
							<div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-5 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">

							