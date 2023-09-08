<?php 
  include 'header.php';
  include 'sessionUserControl.php';
?>

<div class="row d-flex d-xl-flex justify-content-center justify-content-xl-center" style="margin-top: 50px;margin-left: 150px;margin-right: 150px;padding-right: 90px;padding-left: 90px;">
  <div class="col-sm-9 col-lg-9 col-xl-11 col-xxl-9 bg-white shadow-lg" style="border-radius: 5px;padding-left: 202px;padding-right: 202px;margin-left: 0px;margin-right: -56px;">
    <div class="p-5" style="padding-left: 8px;margin-left: -100px;margin-right: -100px;">
      <div class="text-center">
        <h2 class="text-dark mb-4">VETERİNER BAŞVURUSU</h2>
      </div>
      <div class="user">
        <div class="mb-3">
          <label class="form-label" for="from-business">İş Yeri </label><span class="required-input">*</span>
          <input class="form-control form-control-user" type="text" name="businessname" id="businessname" placeholder="İş Yeri İsmi">
          <br>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                <div class="form-group mb-3"><label class="form-label" for="from-email">E Posta</label><span class="required-input">*</span>
                <input class="form-control form-control-user" type="email" name="email" id="email" placeholder="E posta">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                <div class="form-group mb-3"><label class="form-label" for="from-phone">Telefon</label><span class="required-input">*</span>
                    <div class="input-group"><input class="form-control form-control-user" type="text" id="phone" name="phone" placeholder="(___) ___-__-__"></div>
                </div>
            </div>
        </div>
        <div class="mb-3"><label class="form-label" for="from-address">Adres </label><span class="required-input">*</span><textarea class="form-control" type ="textarea" id="address" name="address" placeholder="İş Adresi" rows="5"></textarea></div>
            <hr class="d-flex d-md-none">
      </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                <div class="form-group mb-3"><label class="form-label" for="from-phone">Enlem</label><span class="required-input">*</span>
                    <div class="input-group"><input class="form-control" type="text" id="Xdirection" name="Xdirection" required="" placeholder="X Koordinatı"></div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                <div class="form-group mb-3"><label class="form-label" for="from-phone">Boylam</label><span class="required-input">*</span>
                    <div class="input-group"><input class="form-control" type="text" id="Ydirection" name="Ydirection" required="" placeholder="Y Koordinatı"></div>
                </div>
            </div>
        </div>
        <div style="width: 100px;"><input class="form-control custom-file-input" type="file" id="file" accept="file" name="file">
            <div class="text-center"><label class="form-label" id="file" for="file"><i class="fas fa-upload"></i>&nbsp;Dosya Seçin...</label></div>
        </div>
        <br>
        <button class="btn btn-primary d-block btn-user w-100" type="send" id="send" style="background: #1f4037;">Başvuru Yap</button>
        <br>
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
  $(document).on('click', '#send', function(e) {
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
        var businessname = document.getElementById('businessname').value;
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone').value;
        var address = document.getElementById('address').value;
        var Xdirection = document.getElementById('Xdirection').value;
        var Ydirection = document.getElementById('Ydirection').value;
        var file = document.getElementById('file').value;
        
        var form_data = new FormData();  
        
        form_data.append('businessname', businessname);
        form_data.append('email', email);
        form_data.append('phonenumber', phone);
        form_data.append('address', address);
        form_data.append('Xdirection', Xdirection);
        form_data.append('Ydirection', Ydirection);
       var file_data = $('#file').prop('files')[0];  
       form_data.append('file', file_data);

        $.ajax({
          url: 'veterinaryPost.php', 
           processData: false,
            contentType: false,
          data: form_data,
          type: 'POST',
          success: function(response) {
            console.warn(response);
            const obj = JSON.parse(response);
            console.warn(obj);
            if (obj.success == true) {
              swal('Başarılı!', obj.posted, 'success')
              setTimeout(window.location.href = "accountdetails.php", 5000);
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

  $('#upload').on('click', function() {
    var file_data = $('#file').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    alert(form_data);                             
    $.ajax({
        url: 'veterinaryPost.php', 
        dataType: 'text', 
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
            alert(php_script_response); 
        }
     });
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
