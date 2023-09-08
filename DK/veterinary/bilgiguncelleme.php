<?php
	include "header2.php";

	$data = [
		"id" => $_SESSION["veterinaryId"],
	];
	
	$statement = $db->prepare(
		"SELECT * FROM veterinary WHERE id = :id "
	);
	
	$statement->execute($data);
	$result = $statement->fetch();
	
	$businessname = $result["businessname"];
	$x = $result["x"];
	$y = $result["y"];
	$phone = $result["phone"];
	$email = $result["email"];
	$address = $result["address"];


?>

								<h1 style="text-align:left;    margin-left: -90px;">Bilgi Güncelleme</h1>
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
								<a href="veterinary/bilgiguncelleme.php" class="d-flex align-items-center">
									<img alt="Logo" src="veterinary/assets/media/logos/yeni.png" class="h-20px" />
								</a>
							</div>
					
						</div>
					</div>
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<div class="container-xxl" id="kt_content_container">
							<div class="card mb-5 mb-xl-10">
								<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
									<div class="card-title m-0">
										<h3 class="fw-bolder m-0">Veteriner Bilgi Düzenleme</h3>
									</div>
								</div>
								<div id="kt_account_profile_details" class="collapse show">
									<div id="kt_account_profile_details_form" class="form">
										<div class="card-body border-top p-9">
											<div class="row mb-6">
											
											</div>
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label required fw-bold fs-6">X-Y Konumu</label>
												<div class="col-lg-8">
													<div class="row">
														<div class="col-lg-6 fv-row">
															<input type="text" id="x" name="x" value="<?php echo $x; ?>" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="X Konumu"/>
														</div>
														<div class="col-lg-6 fv-row">
															<input type="text" id="y" name="y" value="<?php echo $y; ?>" class="form-control form-control-lg form-control-solid" placeholder="Y Konumu"/>
														</div>
													</div>
												</div>
											</div>
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label required fw-bold fs-6">İş Yeri Adı</label>
												<div class="col-lg-8 fv-row">
													<input type="text" id="businessname" name="businessname" value="<?php echo $businessname; ?>" class="form-control form-control-lg form-control-solid" placeholder="İş Yeri Adı"/>
												</div>
											</div>
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label fw-bold fs-6">
													<span class="required">Telefon</span>
													
												</label>
												<div class="col-lg-8 fv-row">
													<input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" class="form-control form-control-lg form-control-solid" placeholder="(___) ___-__-__"/>
												</div>
											</div>
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label fw-bold fs-6">E Posta Adresi</label>
												<div class="col-lg-8 fv-row">
													<input type="text" id="email" name="email" value="<?php echo $email; ?>" class="form-control form-control-lg form-control-solid" placeholder="E Posta Adresi"/>
												</div>
											</div>
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label fw-bold fs-6">Adres Bilgileri</label>
												<div class="col-lg-8 fv-row">
													<input type="textarea" id="address" name="address" value="<?php echo $address; ?>" class="form-control form-control-lg form-control-solid" placeholder="Adres Bilgileri"/>
												</div>
											</div>
										</div>
										<div class="card-footer d-flex justify-content-end py-6 px-9">
											<button type="submit" class="btn btn-primary" name="sendVetAccount" id="sendVetAccount">Değişiklikleri Kaydet</button>
										</div>
</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


<script>
    $(document).ready(function() {
    $('#phone').mask('(000) 000-00-00');
    $('#phone').mask('(000) 000-00-00', {
      placeholder: "(___) ___-__-__"
    });
  });
  $(document).on('click', '#sendVetAccount', function(e) {
    swal({
      title: "Emin misin?",
      text: "Girdiğiniz bilgilerden emin misiniz?",
      type: "warning",
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır",
      showCancelButton: true
    }).then((result) => {
      if (result.value) {
        var x = document.getElementById('x').value;
        var y = document.getElementById('y').value;
        var businessname = document.getElementById('businessname').value;
        var phone = document.getElementById('phone').value;
        var email = document.getElementById('email').value;  
		var address = document.getElementById('address').value;     
        
        var dataPost = {
          "x": x,
          "y": y,
          "businessname": businessname,
          "phone": phone,
          "email": email,
          "address": address
		};
        var dataString = JSON.stringify(dataPost);
        $.ajax({
          url: '/veterinary/bilgiguncellemePost.php',
          data: {
            myData: dataString
          },
          type: 'POST',
          success: function(response) {
		    console.warn(response);
            const obj = JSON.parse(response);
            console.warn(response);
            console.warn(obj);
            if (obj.success == true) {
              swal('Başarılı!', obj.posted, 'success')
			  window.location.reload();
            } else {
              var errors = obj.errors;
              swal('Hata!', errors, 'error')
            }
          }
        });
      } 
      else if (result.dismiss === 'cancel') {
       
      }
    })
  });
</script>

<?php 
include "footer2.php";
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
