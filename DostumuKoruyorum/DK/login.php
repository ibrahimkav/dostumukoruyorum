<?php
include 'header.php';

$id = 0;
$id = $_SESSION["id"];
if($id > 0){
  echo "<script>window.location.href = '/accountdetails.php';</script>";
}

?>
        <div class="container section-title" style="padding-right: 0px;">
            <div class="col-sm-10 col-sm-12 col-sm-9" >
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row"> 
                        <div class="col-lg-6 d-none d-lg-flex" style="padding-right: 0px;margin-right: 0px;padding-left: 0px;">
                                <div class="flex-grow-1 bg-login-image ms-xl-0">
                                    <img style="margin-left:15%" src="k_logo.png" alt="Dostumu Koruyorum">
                                </div>
                        </div>
                            <div class="col-lg-6 ms-xl-0" style="padding-right: 18px;padding-left: 17px;">
                                <div class="p-5 ms-xl-0 me-xl-0" style="padding-left: 10px;margin-left: 63px;margin-right: 50px;">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4" style="margin-top: 30px;">..Hoş Geldiniz..</h4>
                                    </div>
                                  
                                        <div class="mb-3">
                                          <input class="form-control form-control-user" type="text"  id="tc"  placeholder="T.C. Kimlik Numarası" name="tc" style="margin-bottom: 10px;"></div>
                                        <div class="mb-3">
                                          <input class="form-control form-control-user" type="password" name="password" id="password" placeholder="Şifre"name="password" style="margin-top: 10px;"></div>
                                        <div class="mb-3">
                                         <input type="checkbox" id="remember" name="remember" class="ml-1 form-check-input" value="1" >
                                         <label for="remember" class="ml-4 ">Beni Hatırla </label> 
                                        </div>
                                    
                                          <div class="mb-3">
                                        <div>
                                        <button class="btn btn-primary d-block btn-user w-100" type="send" style="background: #1f4037;margin-top: 11px;" id="send">Giriş Yap</button>
                                        <hr>
                                        <hr>
                                        <div class="text-center"><a class="small" href="register.php" style="color: #1f4037;">Üye Ol</a></div>
                                        <div class="text-center"><a class="small" href="sifremiUnuttum.php" style="color: #1f4037;">Şifrenizi mi unuttunuz?</a></div>
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
        $(document).on('click', '#send', function(e) {
    

              var tc = document.getElementById('tc').value;
              var password = document.getElementById('password').value;

              var check = document.getElementById('remember').checked;

              var remember = 0;

              if(check == true){
                remember = 1;
              }

              var dataPost = {
                "tc": tc,
                "password": password,
                "remember": remember,
              };
              var dataString = JSON.stringify(dataPost);

              $.ajax({
                url: 'loginPost.php',
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
                    setTimeout(window.location.href = "accountdetails.php", 300);
                  } else {
                    var errors = obj.errors;
                    swal('Hata!', errors, 'error')
                  }
                }
              });
            }
        );
      </script>


<?php
include 'footer.php';
?>    

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
