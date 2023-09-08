<?php
include 'header.php';
include 'sessionUserControl.php';

$id = 1;

if (isset($_GET["id"])) {
  if (is_numeric($id)) {
    $id = $_GET["id"];
    if ($id <= 0) {
      echo "<script>window.location.href = '/index.php';</script>";
    }
  }
}

$userId = $_SESSION["id"];

$data = [
  "id" => $id,
  "uid" => $userId
];

$statement = $db->prepare("SELECT * FROM animals WHERE id = :id AND userId = :uid");
$statement->execute($data);
$firstRow = $statement->fetch(PDO::FETCH_ASSOC);



$petname = "";
$breed = "";
$birthOfdate = "";
$vaccine1 = "";
$date1 = "";
$vaccine2 = "";
$date2 = "";
$vaccine3 = "";
$date3 = "";
$vaccine4 = "";
$date4 = "";
$gender = "";
$isActive = -1;
$dateOfBirth = -1;

if ($firstRow) {
  $petname = $firstRow['petname'];
  $breed = $firstRow['breed'];
  $birthOfdate = $firstRow['birthOfdate'];
  $vaccine1 = $firstRow['vaccine1'];
  $date1 = $firstRow['date1'];
  $vaccine2 = $firstRow['vaccine2'];
  $date2 = $firstRow['date2'];
  $vaccine3 = $firstRow['vaccine3'];
  $date3 = $firstRow['date3'];
  $vaccine4 = $firstRow['vaccine4'];
  $date4 = $firstRow['date4'];
  $gender = $firstRow['gender'];
  $isActive = $firstRow['isActive'];
  $dateOfBirth = $firstRow['dateOfBirth'];

} else {
  echo "<script>window.location.href = '/index.php';</script>";
}
?>

<div class="row d-flex d-xl-flex justify-content-center justify-content-xl-center" style="margin-top: 50px;margin-left: 150px;margin-right: 150px;padding-right: 90px;padding-left: 90px;">
  <div class="col-sm-9 col-lg-9 col-xl-11 col-xxl-9 bg-white shadow-lg" style="border-radius: 5px;padding-left: 202px;padding-right: 202px;margin-left: 0px;margin-right: -56px;">
    <div class="p-5" style="padding-left: 8px;margin-left: -100px;margin-right: -100px;">
      <div class="text-center">
        <h2 class="text-dark mb-4">Dijital Pasaport Güncelleme</h2><br>
      </div>

      <div class="pet">
        <div class="row">
          <div class="mb-3">
            <label class="form-label" for="from-label">Evcil Hayvanınızın Adı </label><span class="required-input">*</span>
            <input class="form-control form-control-user" value="<?php echo $petname; ?>" type="text" name="petname" id="petname">
            <br>
          </div>
          <div class="col-12 col-sm-6 col-md-12 col-lg-6">
            <div class="form-group mb-3"><label class="form-label" for="breed">Irkı</label><span class="required-input">*</span>
              <input class="form-control form-control-user" value="<?php echo $breed; ?>" type="text" name=" breed" id="breed">
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-12 col-lg-6">
            <div class="form-group mb-3"><label class="form-label" for="gender">Cinsiyeti</label> <select id="gender" class="form-control">
                <option value="1">Erkek</option>
                <option value="2">Kız</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <div class="form-label">
              <label class="form-label" for="date">Doğum Tarihi</h1></label><span class="required-input">*</span>
              <input class="form-control form-control-user" value="<?php echo $dateOfBirth; ?>" type="date" id="dateOfBirth" name="dateOfBirth" placeholder="__/__/____">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-sm-6 col-md-12 col-lg-6">
            <div class="form-group mb-3"><label class="form-label" for="breed">Aşı 1</label><span class="required-input">*</span>
              <input class="form-control form-control-user" value="<?php echo $vaccine1; ?>" type="text" name=" vaccine1" id="vaccine1" placeholder="Aşının Adı">
              <input class="form-control form-control-user" value="<?php echo $date1; ?>" type="date" id="date1" name="date1" placeholder="">
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-12 col-lg-6">
            <div class="form-group mb-3"><label class="form-label" for="breed">Aşı 2</label><span class="required-input">*</span>
              <input class="form-control form-control-user" value="<?php echo $vaccine2; ?>" type="text" name=" vaccine2" id="vaccine2" placeholder="Aşının Adı">
              <input class="form-control form-control-user" value="<?php echo $date2; ?>"type="date" id="date2" name="date2" placeholder="">
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-12 col-lg-6">
            <div class="form-group mb-3"><label class="form-label" for="breed">Aşı 3</label><span class="required-input">*</span>
              <input class="form-control form-control-user" value="<?php echo $vaccine3; ?>" type="text" name=" vaccine3" id="vaccine3" placeholder="Aşının Adı">
              <input class="form-control form-control-user" value="<?php echo $date3; ?>"type="date" id="date3" name="date3" placeholder="">
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-12 col-lg-6">
            <div class="form-group mb-3"><label class="form-label" for="breed">Aşı 4</label><span class="required-input">*</span>
              <input class="form-control form-control-user" value="<?php echo $vaccine4; ?>" type="text" name=" vaccine4" id="vaccine4" placeholder="Aşının Adı">
              <input class="form-control form-control-user" value="<?php echo $date4; ?>"type="date" id="date4" name="date4" placeholder="">
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-12 col-lg-6">
            <div class="form-group mb-3"><label class="form-label" for="isActive">Aktiflik</label> <select id="isActive" class="form-control">
                <option value="1">Aktif</option>
                <option value="2">Pasif</option>
              </select>
            </div>
          </div>
        </div>
        <br>

        <button class="btn btn-primary d-block btn-user w-100" type="sendPasaport" id="sendPasaport" style="background: #1f4037;">Kaydet</button>
      </div>
    </div>
  </div>
</div>


<script>
  // let today = new Date().toISOString().slice(0, 10);
 

  
  var tarih = "<?php echo  $dateOfBirth; ?>";
  var formatliTarih = tarih.split(" ")[0];

  document.getElementById('dateOfBirth').value = formatliTarih;

   tarih = "<?php echo  $date1; ?>";
   formatliTarih = tarih.split(" ")[0];

  document.getElementById('date1').value = formatliTarih;

  tarih = "<?php echo  $date2; ?>";
   formatliTarih = tarih.split(" ")[0];

  document.getElementById('date2').value = formatliTarih;
  
  tarih = "<?php echo  $date3; ?>";
   formatliTarih = tarih.split(" ")[0];

  document.getElementById('date3').value = formatliTarih;

  tarih = "<?php echo  $date4; ?>";
   formatliTarih = tarih.split(" ")[0];

  document.getElementById('date4').value = formatliTarih;

</script>


<script>
  $(document).on('click', '#sendPasaport', function(e) {
    swal({
      title: "Emin misin?",
      text: "Girdiğiniz bilgilerden emin misiniz?",
      type: "warning",
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır",
      showCancelButton: true
    }).then((result) => {
      if (result.value) {
        var petname = document.getElementById('petname').value;
        var breed = document.getElementById('breed').value;
        var gender = document.getElementById('gender').value;
        var dateOfBirth = document.getElementById('dateOfBirth').value;
        var vaccine1 = document.getElementById('vaccine1').value;
        var date1 = document.getElementById('date1').value;
        var vaccine2 = document.getElementById('vaccine2').value;
        var date2 = document.getElementById('date2').value;
        var vaccine3 = document.getElementById('vaccine3').value;
        var date3 = document.getElementById('date3').value;
        var vaccine4 = document.getElementById('vaccine4').value;
        var date4 = document.getElementById('date4').value;
        var isActive = document.getElementById('isActive').value;

        var dataPost = {
          "petname": petname,
          "breed": breed,
          "gender": gender,
          "dateOfBirth": dateOfBirth,
          "vaccine1": vaccine1,
          "date1": date1,
          "vaccine2": vaccine2,
          "date2": date2,
          "vaccine3": vaccine3,
          "date3": date3,
          "vaccine4": vaccine4,
          "date4": date4,
          "isActive": isActive,
          "aId": <?php echo $id; ?>,
        };
        var dataString = JSON.stringify(dataPost);
        $.ajax({
          url: 'dijitalPasaport_guncellePost.php',
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
              setTimeout(window.location.href = "dijitalPasaport.php", 1500);
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
<?php

if($gender > 0 ){
  echo "<script>document.getElementById('gender').value = $gender</script>";
  echo "<script>document.getElementById('isActive').value = $isActive</script>";
  }
 ?>

<?php
include 'service.php';
?>

<?php
include 'footer.php';
?>

<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/bs-init.js"></script>
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
</body>