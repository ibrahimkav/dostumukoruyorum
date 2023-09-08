<?php include "header.php"; ?>

<?php
if ($_SESSION["id"] == null) {
    header("location: login.php");
    exit();
}
?>


<br><br><br>
<div  class="container">
<div class="row">
<div class="col-md-3">
<?php include "sidebar.php"; ?>
</div>  
<div class="col-md-9">
<div>
  <div class="row">
    <div class="card h-100">
      <div class="card-body">
        <div class="gutters container col-md-6">
          <div>
            <h6 style="color:#1f4037!important; font-size:23px " style="text-align:center" class="mb-2 text-primary container">Şifre Güncelleme</h6>
          </div>
          <div>
            <div class="form-group">
              <label for="password">Mevcut Şifre*</label>
              <input type="password" class="form-control" id="password">
              <label for="newpassword">Yeni Şifre*</label>
              <input type="password" class="form-control" id="newpassword">
              <label for="fullName">Yeni Şifre Tekrar*</label>
              <input type="password" class="form-control" id="newpasswordagain">
            </div>
          </div>
        </div>
      </div>
      <div class="row gutters">
        <div>
          <div class="text-right mb-5">
            <button type="button" id="back" name="back" class="btn btn-secondary">Geri</button>
            <button type="button" onclick="post()" id="send" name="send" class="btn btn-primary">Güncelle</button>
          </div> 
        </div>
      </div>
    </div>
  </div>
</div>
</div>  
</div>  
</div>


 
<div style="margin-top:133px"></div>


<script>
     function post(){


              var password = document.getElementById('password').value;
              var newpassword = document.getElementById('newpassword').value;
              var newpasswordagain = document.getElementById('newpasswordagain').value;


              var dataPost = {
                "password": password,
                "newpassword": newpassword,
                "newpasswordagain":newpasswordagain
              };

              var dataString = JSON.stringify(dataPost);
              $.ajax({
                url: 'passworduptadePost.php',
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
                  
                  } else {
                    var errors = obj.errors;
                    swal('Hata!', errors, 'error')
                  }
                }
              });
     }       
</script>

<?php include "subscribe.php"; ?>
<?php include "service.php"; ?> 
<?php include "footer.php"; ?> 

    <footer style="width: 1393px;"></footer>
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
