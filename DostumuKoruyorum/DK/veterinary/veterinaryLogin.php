<?php 
include "header.php";
?>
<body>
<br><br><br><br><br><br>
<div class="container section-title" style="padding-right: 0px;">
            <div class="col-sm-10 col-sm-12 col-sm-9" >
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row"> 
                        <div class="col-lg-6 d-none d-lg-flex" style="padding-right: 0px;margin-right: 0px;padding-left: 0px;">
                                <div class="flex-grow-1 bg-login-image ms-xl-0">
                                    <img style="margin-left:15%;margin-top: 50px !important;" src="k_logo.png" alt="Dostumu Koruyorum">
                                </div>
                            </div>

                            <div class="col-lg-6 ms-xl-0" style="padding-right: 18px;padding-left: 17px;">
                                <div class="p-5 ms-xl-0 me-xl-0" style="padding-left: 10px;margin-left: 63px;margin-right: 50px;">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4" style="margin-top: 30px;">Veteriner Giriş Paneline <br> .. Hoş Geldiniz ..</h4>
                                    </div>
                                  
                                        <div class="mb-3">
                                          <input class="form-control form-control-user" type="text"  id="email" aria-describedby="emailHelp" placeholder="E posta Adresi..." name="email" style="margin-bottom: 10px;"></div>
                                        <div class="mb-3">
                                          <input class="form-control form-control-user" type="password" name="password" id="password" placeholder="Şifre..."name="password" style="margin-top: 10px;"></div>                                                
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox small"></div>
                                              <div>
                                              <button class="btn btn-primary d-block btn-user w-100" type="send" style="background: #1f4037;margin-top: 11px;" id="send">Giriş Yap</button>
                                              <hr>
                                              <hr>
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
    

              var email = document.getElementById('email').value;
              var password = document.getElementById('password').value;

              var dataPost = {
                "email": email,
                "password": password
              };
              var dataString = JSON.stringify(dataPost);
              $.ajax({
                url: 'veterinaryLoginPost.php',
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
                    setTimeout(window.location.href = "/veterinary/raporlar.php", 1500);
                  } else {
                    var errors = obj.errors;
                    swal('Hata!', errors, 'error')
                  }
                }
              });
            }
        );
      </script>   
</body>


