<?php 
  include 'header.php';
    include 'sessionUserControl.php';
?>
 <?php

$data = [
  "id" => $_SESSION["id"],
];

$statement = $db->prepare("SELECT * FROM user WHERE id = :id");
$statement->execute($data);
$firstRow = $statement->fetch(PDO::FETCH_ASSOC);

?>
<br><br><br>
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <?php include 'sidebar.php'; ?>
    </div>
    <div class="col-md-9">
      <div>
        <div class="row">
          <div class="card h-100">
            <div class="card-body">
              <div class="gutters container col-md-6">
                <div>
                  <h6 style="color:#1f4037!important; font-size:23px; text-align:center" class="mb-2 text-primary container">Hesap Detayları</h6>
                </div>
                <div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="firstname">Ad*</label>
                        <input type="text" id="firstname" name="firstname" value="<?= $firstRow['firstname'] ?>" placeholder="Adınız." class="form-control form-control-md">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastname">Soyad *</label>
                        <input type="text" id="lastname" name="lastname" value="<?= $firstRow['lastname'] ?>" placeholder="Soyadınız" class="form-control form-control-md">
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-3">
                    <label for="display-name">T.C. Kimlik Numarası* </label>
                    <input type="text"  id="tckno" name="tckno" value="<?= $firstRow['tckno'] ?>" maxlength="11" placeholder="T.C. Kimlik Numarası" class="form-control form-control-md mb-0">
                  </div>
                  <div class="form-group mb-3">
                    <label for="display-name">Telefon Numarası *</label>
                    <input type="text" id="phone" name="phone" value="<?= $firstRow['phone'] ?>" class="form-control form-control-md mb-0" placeholder="(___) ___-__-__" autocomplete="off">
                  </div>
                  <div class="form-group mb-6">
                    <label for="email_1">E-posta adresi *</label>
                    <input type="email" id="email" name="email" class="form-control form-control-md" placeholder="Email Adresiniz" value="<?= $firstRow['email'] ?>">
                  </div>
                  <br>
                  <button type="button" id="sendAccount" name="sendAccount" class="btn btn-primary">Değişiklikleri Kaydet</button>
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

  $(document).on('click', '#sendAccount', function(e) {
    swal({
      title: "Emin misin?",
      text: "Girdiğiniz bilgilerden emin misiniz?",
      type: "warning",
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır",
      showCancelButton: true
    }).then((result) => {
      if (result.value) {
        var firstname = document.getElementById('firstname').value;
        var lastname = document.getElementById('lastname').value;
        var tckno = document.getElementById('tckno').value;
        var phone = document.getElementById('phone').value;
        var email = document.getElementById('email').value;       
        
        var dataPost = {
          "firstname": firstname,
          "lastname": lastname,
          "tckno": tckno,
          "phone": phone,
          "email": email
        };
        var dataString = JSON.stringify(dataPost);
        $.ajax({
          url: 'accountdetailsPost.php',
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
              setTimeout(window.location.reload(), 1500);
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
 include 'subscribe.php';
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
</body>