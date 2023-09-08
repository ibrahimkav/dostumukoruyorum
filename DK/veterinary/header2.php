<?php
require "../base.php";
require "vetSessionUserControl.php";

?>

<head>
		<base href="../">
		<title>DK</title>
		<link rel="shortcut icon" href="veterinary/assets/media/logos/beyaz_icon.ico" />
		<link href="veterinary/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>


	<body id="kt_body" class="sidebar-enabled">
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				<div id="kt_aside" class="aside py-9" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
					<div class="aside-logo flex-column-auto px-9 mb-9" id="kt_aside_logo">
						<a href="veterinary/raporlar.php">
							<img alt="Logo" src="veterinary/assets/media/logos/yeni.png" class="h-150px logo" />
						</a>
					</div>
					<div class="aside-menu flex-column-fluid ps-5 pe-3 mb-9" id="kt_aside_menu">
						<div class="w-100 hover-scroll-overlay-y d-flex pe-2" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu, #kt_aside_menu_wrapper" data-kt-scroll-offset="100">
							<div class="menu menu-column menu-rounded fw-bold my-auto" id="#kt_aside_menu" data-kt-menu="true">
								<div class="menu-item">
									<a class="menu-link active" href="veterinary/raporlar.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Raporlar</span>
									</a>
								</div>

								<div class="menu-item">
									<a class="menu-link" href="veterinary/hastalar.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Hastalar</span>
									</a>
								</div>

								<div class="menu-item">
									<a class="menu-link" href="veterinary/bilgiguncelleme.php">
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
									<a class="menu-link" href="veterinary/yardimlar.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Yardımlar</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link" href="/logout.php">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Çıkış Yap</span>
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
									<a class="text-gray-800 text-hover-primary fs-6 fw-bolder lh-1"><?php echo $_SESSION["businessname"]; ?></a>
									<span class="text-muted fw-bold d-block fs-7 lh-1">Veteriner</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<div id="kt_header" class="header">
						<div class="container d-flex align-items-center justify-content-between" id="kt_header_container">
							<div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-5 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
							