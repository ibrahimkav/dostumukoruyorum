<?php 
  include 'header.php';
  ?>
        <div style="margin-right: 56px;margin-left: 37px;padding-right: 100px;padding-left: 130px;">
            <div class="container-fluid" style="padding-left: 0px;margin-top: 30px;margin-left: 20px;padding-right: 0px;">
                <h1>&nbsp;İLETİŞİM</h1>
                <hr>
                <form id="contactForm-1" action="javascript:void(0);" method="get"><input class="form-control" type="hidden" name="Introduction" value="This email was sent from www.awebsite.com"><input class="form-control" type="hidden" name="subject" value="Awebsite.com Contact Form"><input class="form-control" type="hidden" name="to" value="email@awebsite.com">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="successfail-1"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6" id="message-1" style="margin-left: 0px;padding-left: 30px;">
                            <h2 class="h4"><i class="fa fa-envelope"></i>&nbsp;İletişime Geçin<small><small class="required-input">&nbsp;(*opsiyonel)</small></small></h2>
                            <div class="form-group mb-3"><label class="form-label" for="from-name">İsim Soyisim</label><span class="required-input">*</span>
                                <div class="input-group"><span class="input-group-text"><i class="fa fa-user-o"></i></span><input class="form-control" id="fullname" type="text" name="fullname" required="" placeholder="İsim Soyisim"></div>
                            </div>
                            <div class="form-group mb-3"><label class="form-label" for="from-email">Eposta</label><span class="required-input">*</span>
                                <div class="input-group"><span class="input-group-text"><i class="fa fa-envelope-o"></i></span><input class="form-control" id="email" type="text"  name="email" required="" placeholder="Eposta Adresiniz"></div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-12 col-lg-6 col-xl-12">
                                    <div class="form-group mb-3"><label class="form-label" for="from-phone">Telefon</label><span class="required-input">*</span>
                                        <div class="input-group"><span class="input-group-text"><i class="fa fa-phone"></i></span><input class="form-control" type="text" id="phonenumber" name="phonenumber" required="" placeholder="Primary Phone"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3"><label class="form-label" for="from-comments">Yorumunuz</label><textarea class="form-control" type ="textarea" id="comment" name="comment" placeholder="Yorumlarınız" rows="5"></textarea></div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col"><button class="btn btn-primary d-block bounce animated w-100" id="sendb" type="sendb" style="background: rgb(31,64,55);">Gönder <i class="fa fa-chevron-circle-right"></i></button></div>
                                </div>
                            </div>
                            <hr class="d-flex d-md-none">
                        </div>
                        <div class="col-12 col-md-6" style="padding-left: 120px;">
                            <h2 class="h4" style="padding-top: 0px;"><i class="fa fa-location-arrow"></i>&nbsp;Bize Ulaşın</h2>
                            <div class="row">
                                <div class="col-12">
                                    <div class="static-map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3011.5284777350366!2d28.696702376374503!3d40.99180477135295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa05e7a6e9d29%3A0x617400f3f8628fde!2zxLBTVEFOQlVMIEdFTMSwxZ7EsE0gw5xOxLBWRVJTxLBURVPEsCAtIE1FU0xFSyBZw5xLU0VLT0tVTFU!5e0!3m2!1str!2str!4v1684169386862!5m2!1str!2str" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
                                </div>
                                <div class="col-sm-6 col-md-12 col-lg-6" style="padding-top: 30px;">
                                    <h2 class="h4"><i class="fa fa-user"></i>&nbsp;Bilgilerimiz</h2>
                                    <div><span>info@dk.com</span></div>
                                    <hr class="d-sm-none d-md-block d-lg-none">
                                </div>
                                <div class="col-sm-6 col-md-12 col-lg-6" style="padding-top: 30px;">
                                    <h2 class="h4"><i class="fa fa-location-arrow"></i>&nbsp;Adresimiz</h2>
                                    <div><span><strong>Ofis Adresi</strong></span></div>
                                    <div><span>Cihangir, Petrol Ofisi Cd. No: 7, 34310 Avcılar/İstanbul</span></div>
                                    <hr class="d-sm-none">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    <script>
  $(document).ready(function() {
    $('#phonenumber').mask('(000) 000-00-00');
    $('#phonenumber').mask('(000) 000-00-00', {
      placeholder: "(___) ___-__-__"
    });
  });
  $(document).on('click', '#sendb', function(e) {
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
        var fullname = document.getElementById('fullname').value;
        var email = document.getElementById('email').value;
        var phonenumber = document.getElementById('phonenumber').value;
        var comment = document.getElementById('comment').value;
        var dataPost = {
          "fullname": fullname,
          "email": email,
          "phonenumber": phonenumber,
          "comment": comment,
        };
        var dataString = JSON.stringify(dataPost);
        $.ajax({
          url: 'contactPost.php',
          data: {
            myData: dataString
          },
          type: 'POST',
          success: function(response) {
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

