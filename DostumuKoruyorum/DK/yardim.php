<?php 
  include 'header.php';
  include 'sessionUserControl.php';
  
?> <div class="row d-flex d-xl-flex justify-content-center justify-content-xl-center" style="margin-top: 50px;margin-left: 150px;margin-right: 150px;padding-right: 90px;padding-left: 90px;">
  <div class="col-sm-9 col-lg-9 col-xl-11 col-xxl-9 bg-white shadow-lg" style="border-radius: 5px;padding-left: 202px;padding-right: 202px;margin-left: 0px;margin-right: -56px;">
    <div class="p-5" style="padding-left: 8px;margin-left: -100px;margin-right: -100px;">
      <div class="text-center">
        <h2 class="text-dark mb-4">Yardım Oluşturma</h2>
      </div>
      <div class="user">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-12 col-lg-6">
            <div class="form-group mb-3">
              <label class="form-label" for="from-label">Hayvan Irkı</label>
              <span class="required-input">*</span>
              <input class="form-control form-control-user" type="text" name="breed" id="breed" placeholder="Kedi/Köpek/Kuş vs.">
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-12 col-lg-6">
            <div class="form-group mb-3">
              <label class="form-label" for="from-label">Saat</label>
              <span class="required-input">*</span>
              <div class="input-group">
                <input class="form-control form-control-user" type="time" id="time" name="time">
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-sm-6 col-md-12 col-lg-6">
            <div class="form-group mb-3">
              <label class="form-label" for="from-label">X</label>
              <span class="required-input">*</span>
              <input class="form-control form-control-user" type="text" name="x" id="x" placeholder="X">
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-12 col-lg-6">
            <div class="form-group mb-3">
              <label class="form-label" for="from-label">Y</label>
              <span class="required-input">*</span>
              <div class="input-group">
              <input class="form-control form-control-user" type="text" name="y" id="y" placeholder="Y">
              </div>
            </div>
          </div>
        </div>
        <form action="">
          <div class="row">
            <div class="col-12 col-sm-6 col-md-12 col-lg-6">
              <div class="form-group mb-3">
                <label class="form-label" for="il">İl</label>
                <span class="required-input">*</span>
                <select class="form-control form-control-user" name="il" id="il" style="height:fit-content;">
                  <option value='-1'>Seçiniz</option> <?php
                $statement = $db->prepare('SELECT * FROM `iller`');
                $statement->execute(array());
                      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                          $id = $row['id'];
                          $ilAdi = $row['ilAdi']; 
                          echo "
											
											<option value='$id'>$ilAdi</option>" ;
                      }
              ?>
                </select>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-12 col-lg-6">
              <div class="form-group mb-3">
                <label class="form-label" for="ilce">İlçe</label>
                <span class="required-input">*</span>
                <select class="form-control form-control-user" name="ilce" id="ilce" style="height:fit-content;">
                  <option value='-1'>Seçiniz</option>
                </select>
              </div>
            </div>
          </div>
        </form>
        <div class="mb-3">
          <label class="form-label" for="from-address">Adres </label>
          <span class="required-input">*</span>
          <textarea class="form-control" type="textarea" id="address" name="address" placeholder="Adres" rows="5"></textarea>
        </div>
        <hr class="d-flex d-md-none">
        <div class="mb-3">
          <label class="form-label" for="from-address">Açıklamalar </label>
          <span class="required-input">*</span>
          <textarea class="form-control" type="textarea" id="directions" name="directions" placeholder="Hayvanı nerden nasıl bulduğunuzu detaylıca açıklayınız" rows="5"></textarea>
        </div>
        <hr class="d-flex d-md-none">
      </div>
      <br>
      <button class="btn btn-primary d-block btn-user w-100" type="sendyardim" id="sendyardim" style="background: #1f4037;">Gönder</button>
      <br>
    </div>
  </div>
</div>

<script>
  $("#il").change(function() {
        var id = document.getElementById('il').value;
        $.post('/ilceler.php?id=' + id, null).done(function(response) {
          console.warn(response);
          const obj = JSON.parse(response);
          var options = [];
          if (id == -1) {
            options.push('<option value = "-1" > Seçiniz </option>');
            }
            else {
              for (var i = 0; i < obj.length; i++) {
                options.push('<option value="' + obj[i].id + '"> '  + obj[i].ilceAdi + ' </option>');
                }
              }
              $("#ilce").html(options.join(''));
            });
        });
</script>

<script>
  $(document).on('click', '#sendyardim', function(e) {
    swal({
      title: "Emin misin?",
      text: "Girdiğiniz bilgilerden emin misiniz?",
      type: "warning",
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır",
      showCancelButton: true
    }).then((result) => {
      debugger;
      if (result.value) {

        var breed = document.getElementById('breed').value;
        var time = document.getElementById('time').value;
        var il = document.getElementById('il').value;
        var ilce = document.getElementById('ilce').value;
        var address = document.getElementById('address').value;
        var directions = document.getElementById('directions').value;
        var x = document.getElementById('x').value;
        var y = document.getElementById('y').value;

        var dataPost = {
          "breed": breed,
          "time": time,
          "il": il,
          "ilce": ilce,
          "address":address,
          "directions":directions,
          "x":x,
          "y":y,
        };
        var dataString = JSON.stringify(dataPost);
        $.ajax({
          url: 'yardimPost.php',
          data: {
            myData: dataString
          },
          type: 'POST',
          success: function(response) {
            console.warn(response);
            const obj = JSON.parse(response);
            console.warn(obj);
            if (obj.success == true) {
              swal('Başarılı!', obj.posted, 'success')
              setTimeout(window.location.href = "login.php", 5000);
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
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
</body>