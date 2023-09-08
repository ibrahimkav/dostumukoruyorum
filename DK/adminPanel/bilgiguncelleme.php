<?php
	include "header2.php";
?>

								<h1 class="d-flex flex-column text-dark fw-bolder my-0 fs-1">Bilgi Güncelleme</h1>
							</div>

							<div class="d-flex d-lg-none align-items-center ms-n2 me-2">
								<div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
									<span class="svg-icon svg-icon-1 mt-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
										</svg>
									</span>
								</div>
								<a href="admninPanel/bilgiguncelleme.php" class="d-flex align-items-center">
									<img alt="Logo" src="veterinary/assets/media/logos/yeni.png" class="h-20px" />
								</a>
							</div>
							<div class="d-flex align-items-center flex-shrink-0">
								<div id="kt_header_search" class="d-flex align-items-center w-125px w-md-150px w-lg-225px" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="menu" data-kt-menu-trigger="auto" data-kt-menu-permanent="true" data-kt-menu-placement="bottom-end">
									<form data-kt-search-element="form" class="w-100 position-relative" autocomplete="off">
										<input type="hidden" />
										<span class="svg-icon svg-icon-2 svg-icon-gray-700 position-absolute top-50 translate-middle-y ms-4">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black" />
												<path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black" />
											</svg>
										</span>
										<input type="text" class="form-control bg-transparent ps-13 fs-7 h-40px" name="search" value="" placeholder="Ne aramıştınız ?" data-kt-search-element="input" />
										<span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
											<span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
										</span>
										<span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-4" data-kt-search-element="clear">
											<span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
													<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
												</svg>
											</span>
										</span>
									</form>
								</div>
								<div class="d-flex d-none align-items-center ms-3 ms-lg-4">
									<div class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline btn-outline-secondary position-relative w-40px h-40px" id="kt_drawer_chat_toggle">
										<span class="svg-icon svg-icon-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="black" />
												<path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="black" />
											</svg>
										</span>
										<span class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<div class="container-xxl" id="kt_content_container">
							<div class="card mb-5 mb-xl-10">
								<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
									<div class="card-title m-0">
										<h3 class="fw-bolder m-0">Admin Bilgi Düzenleme</h3>
									</div>
								</div>
								<div id="kt_account_profile_details" class="collapse show">
									<form id="kt_account_profile_details_form" class="form">
										<div class="card-body border-top p-9">
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label fw-bold fs-6">Resim</label>
												<div class="col-lg-8">
												<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(assets/media/avatars/blank.png)">
														<div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/150-26.jpg)"></div>
														<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Resmi Değiştir">
															<i class="bi bi-pencil-fill fs-7"></i>
															<input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
															<input type="hidden" name="avatar_remove" />
														</label>
														<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Geri">
															<i class="bi bi-x fs-2"></i>
														</span>
														<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Resmi Sil">
															<i class="bi bi-x fs-2"></i>
														</span>
													</div>
												</div>
											</div>

											<div class="row mb-6">
												<label class="col-lg-4 col-form-label required fw-bold fs-6">Ad Soyad</label>
												<div class="col-lg-8">
													<div class="row">
														<div class="col-lg-6 fv-row">
															<input type="text" name="name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Adınız"/>
														</div>
														<div class="col-lg-6 fv-row">
															<input type="text" name="lastname" class="form-control form-control-lg form-control-solid" placeholder="Soyadınız"/>
														</div>
													</div>
												</div>
											</div>

											<div class="row mb-6">
												<label class="col-lg-4 col-form-label required fw-bold fs-6">Kullanıcı Adı</label>
												<div class="col-lg-8 fv-row">
													<input type="text" name="username" class="form-control form-control-lg form-control-solid" placeholder="Kullanıcı Adınız"/>
												</div>
											</div>

											<div class="row mb-6">
												<label class="col-lg-4 col-form-label fw-bold fs-6">
													<span class="required">Telefon</span>
													<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title=" Aktif kullancağınız numarayı yazın"></i>
												</label>
												<div class="col-lg-8 fv-row">
													<input type="tel" name="phone" class="form-control form-control-lg form-control-solid" placeholder="(___) ___-__-__"/>
												</div>
											</div>

											<div class="row mb-6">
												<label class="col-lg-4 col-form-label required fw-bold fs-6">Şifre</label>
												<div class="col-lg-8 fv-row">
													<input type="password" name="password" class="form-control form-control-lg form-control-solid" placeholder="Şifreniz"/>
												</div>
											</div>

										</div>
										<div class="card-footer d-flex justify-content-end py-6 px-9">
											<button type="reset" class="btn btn-light btn-active-light-primary me-2">Sil</button>
											<button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Değişiklikleri Kaydet</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>