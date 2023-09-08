<?php
	include "header2.php";

	$id = 1;

	$veterinaryId = $_SESSION["veterinaryId"];

	if (isset($_GET["id"])) {
		if (is_numeric($id)) {
			$id = $_GET["id"];
			if($id <= 0){
			  echo "<script>window.location.href = '/veterinary/hastalar/.php';</script>";
			}
		}
	}
	
	$data = [
		"id" => $id,
		"veterinaryId" => $veterinaryId
	];
	
	$statement = $db->prepare("SELECT * FROM patients WHERE veterinaryId = :veterinaryId AND id = :id");
	$statement->execute($data);
	$firstRow = $statement->fetch(PDO::FETCH_ASSOC);
	
	
	
	$hayvandi = "";
	$hastacinsi = "";
	$rahatsizlik = "";
	$durum = "";
	$ownerName = "";
	$ownerName = "";
	$kayit_baslangic = "";
	$kayit_bitis = "";
	
	
	if ($firstRow) {
	$hayvandi = $firstRow['hayvanadi'];
	$hastacinsi = $firstRow['hastacinsi'];
	$rahatsizlik = $firstRow['rahatsizlik'];
	$durum = $firstRow['durum'];
	$ownerName = $firstRow['ownerName'];
	$ownerPhone = $firstRow['ownerPhone'];
	$kayit_baslangic = $firstRow['kayit_baslangic'];
	$kayit_bitis = $firstRow['kayit_bitis'];
	
	} else {
		echo "<script>window.location.href = '/veterinary/hastalar/.php';</script>";
	}



?>	

                <h1 style="text-align:left;    margin-left: -90px;">Kayıt Düzenle
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
								<a href="veterinary/hastalar.php" class="d-flex align-items-center">
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
										<h3 class="fw-bolder m-0">Hasta Kayıt Düzenle</h3>
									</div>
								</div>
								<div id="kt_account_profile_details" class="collapse show">
									<div id="kt_account_profile_details_form" class="form">
										<div class="card-body border-top p-9">
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label required fw-bold fs-6">Hasta Adı</label>
												<div class="col-lg-8 fv-row">
													<input type="text" name="hayvanismi" id="hayvanadi" class="form-control form-control-lg form-control-solid" value="<?php echo $hayvandi; ?>" placeholder="Hasta Adı"/>
												</div>
											</div>											
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label required fw-bold fs-6">Hasta Cinsi</label>
												<div class="col-lg-8 fv-row">
													<select name="durum_id" aria-label="ıd" id="hastacinsi" data-control="select2" class="form-select form-select-solid form-select-lg">
														<option value="">Seçiniz..</option>
														<option value="kedi"><b>Kedi</b></option>
														<option value="kopek"><b>Köpek</b></option>
														<option value="kus"><b>Kuş</b></option>
													</select>
												</div>
											</div>
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label required fw-bold fs-6">Rahatsızlığı</label>
												<div class="col-lg-8 fv-row">
													<input type="text" name="rahatsizlik" id="rahatsizlik" class="form-control form-control-lg form-control-solid" value="<?php echo $rahatsizlik; ?>" placeholder="Rahatsızlığı Açıklayın"/>
												</div>
											</div>
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label required fw-bold fs-6">Durumu</label>
												<div class="col-lg-8 fv-row">
													<select name="durum_id" aria-label="ıd" data-control="select2" id="durum" class="form-select form-select-solid form-select-lg">
														<option value="">Seçiniz...</option>
														<option value="1">
														<b>Aktif</b>&#160;-&#160;İşlem Yapılıyor</option>
														<option value="2">
														<b>Pasif</b>&#160;-&#160;Beklemeye Alındı</option>
														<option value="3">
														<b>Kayıt Kapandı</b>&#160;-&#160;İşlem Kapandı</option>
													</select>
												</div>
											</div>
											<br><br>

											<div class="card-title m-0">
												<h3 class="fw-bolder m-0">Hasta Sahibi Bilgileri</h3>
											</div><br>
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label required fw-bold fs-6">Ad Soyad</label>
												<div class="col-lg-8 fv-row">
													<input type="text" name="fullname" id="fullname" value="<?php echo $ownerName; ?>" class="form-control form-control-lg form-control-solid" placeholder="Ad Soyad"/>
												</div>
											</div>
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label fw-bold fs-6">
													<span class="required">Telefon</span>
												</label>
												<div class="col-lg-8 fv-row">
													<input type="tel" name="phone" id="phone" value="<?php echo $ownerPhone ?>" class="form-control form-control-lg form-control-solid" placeholder="(___) ___-__-__"/>
												</div>
											</div>
									
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label required fw-bold fs-6">Kayıt Başlangıç Tarihi</label>
												<div class="col-lg-8 fv-row">
													<input class="form-control form-control-user" type="date" id="kayit_baslangic" name="kayit_baslangic" placeholder="">

												</div>
											</div>
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label required fw-bold fs-6">Kayıt Bitiş Tarihi</label>
												<div class="col-lg-8 fv-row">
													<input class="form-control form-control-user" type="date" id="kayit_bitis" name="kayit_bitis" placeholder="">

												</div>
											</div>
										</div>
										<div class="card-footer d-flex justify-content-end py-6 px-9">
											<a href="javascript:;" class="btn btn-primary" id="sendHasta">Değişiklikleri Kaydet</a>
										</div>
</div>



<?php 

	echo "<script>document.getElementById('hastacinsi').value = '$hastacinsi'</script>";
	echo "<script>document.getElementById('durum').value = '$durum'</script>";

   ?>

<script>

  var tarih = "<?php echo  $kayit_baslangic; ?>";
  var formatliTarih = tarih.split(" ")[0];

  document.getElementById('kayit_baslangic').value = formatliTarih;

   tarih = "<?php echo  $kayit_bitis; ?>";
   formatliTarih = tarih.split(" ")[0];

  document.getElementById('kayit_bitis').value = formatliTarih;



	$(document).ready(function() {
    $('#phone').mask('(000) 000-00-00');
    $('#phone').mask('(000) 000-00-00', {
      placeholder: "(___) ___-__-__"
    });
  });
  $(document).on('click', '#sendHasta', function(e) {
    swal({
      title: "Emin misin?",
      text: "Girdiğiniz bilgilerden emin misiniz?",
      type: "warning",
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır",
      showCancelButton: true
    }).then((result) => {
      if (result.value) {
        var hayvanadi = document.getElementById('hayvanadi').value;
        var hastacinsi = document.getElementById('hastacinsi').value;
        var rahatsizlik = document.getElementById('rahatsizlik').value;
		var durum = document.getElementById('durum').value;
        var fullname = document.getElementById('fullname').value;
        var phone = document.getElementById('phone').value;
        var kayit_baslangic = document.getElementById('kayit_baslangic').value;
		var kayit_bitis = document.getElementById('kayit_bitis').value;
        var dataPost = {
          "id": <?php echo $id; ?>,
          "hayvanadi": hayvanadi,
          "hastacinsi": hastacinsi,
          "rahatsizlik": rahatsizlik,
		  "durum" : durum,
		  "fullname" :fullname,
		  "phone" :phone,
		  "kayit_baslangic" :kayit_baslangic,
		  "kayit_bitis" :kayit_bitis
        };
        var dataString = JSON.stringify(dataPost);
        $.ajax({
          url: '/veterinary/hastakayit_duzenlemePost.php',
          data: {
            myData: dataString
          },
          type: 'POST',
          success: function(response) {
			console.warn(response);
            const obj = JSON.parse(response);
            console.warn(response);
            if (obj.success == true) {
              swal('Başarılı!', obj.posted, 'success')
              setTimeout(window.location.href = "/veterinary/hastalar.php", 1500);
            } else {
              var errors = obj.errors;
              swal('Hata!', errors, 'error')
            }
          }
        });
      } else if (result.dismiss === 'cancel') {
       
      }
    })
  });
</script>

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
<?php
include "footer2.php";
?>





