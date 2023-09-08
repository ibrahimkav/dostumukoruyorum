<?php
include 'header.php';


$id = 0;
$id = $_SESSION["id"];
if($id > 0){
  echo "<script>window.location.href = '/accountdetails.php';</script>";
}


?> 

<div class="row d-flex d-xl-flex justify-content-center justify-content-xl-center" style="margin-top: 50px;margin-left: 299px;margin-right: 299px;padding-right: 90px;padding-left: 90px;">
  <div class="col-sm-9 col-lg-9 col-xl-11 col-xxl-9 bg-white shadow-lg" style="border-radius: 5px;padding-left: 202px;padding-right: 202px;margin-left: 0px;margin-right: -56px;">
    <div class="p-5" style="padding-left: 8px;margin-left: -165px;margin-right: -165px;">
      <div class="text-center">
        <h4 class="text-dark mb-4">Hesabınızı Oluşturun</h4>
      </div>
      <div class="user">
        <div class="mb-3">
          <input class="form-control form-control-user" type="text" name="firstname" id="firstname" placeholder="Adınız">
          <br>
        </div>
        <div class="mb-3">
          <input class="form-control form-control-user" type="text" name="lastname" id="lastname" placeholder="Soyadınız">
          <br>
        </div>
        <div class="mb-3">
          <input class="form-control form-control-user" type="text" name="tc" id="tc" placeholder="T.C. Kimlik Numarası">
          <br>
        </div>
        <div class="mb-3">
          <input class="form-control form-control-user" type="email" name="email" id="email" placeholder="E mail">
          <br>
        </div>
        <div class="mb-3">
          <input class="form-control form-control-user" type="password" name="password" id="password" placeholder="Şifre">
          <br>
        </div>
        <div class="mb-3">
          <input class="form-control form-control-user" type="text" name="phone" id="phone" placeholder="(___) ___-__-__ ">
          <br>
        </div>
        <div class="mb-3">
          <input class="form-control form-control-user" type="text" name="dateOfBirth" id="dateOfBirth" placeholder="Doğum Tarihi">
          <br>
          <input name="gender" type="radio" id="1" checked value="1">
          <label for="age1">Erkek</label>
          <br>
          <input name="gender" type="radio" id="2" value="2">
          <label for="age2">Kadın</label>
          <br>
          <input type="checkbox" id="consent" name="consent" value="1">
          <label data-toggle="modal" data-target="#acikRiza">Açık Rıza</label>
          <br>
          <button class="btn btn-primary d-block btn-user w-100" type="send" id="send" style="background: #1f4037;">Kayıt Ol</button>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="acikriza" tabindex="-1" role="dialog" aria-labelledby="acikrizaModal" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="acikrizaModal">Açık Rıza Metni</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Açık rıza, belirli bir konuya ilişkin, bilgilendirilmeye dayanan özgür iradeyle açıklanan
      rızayı ifade eder.
      Açık rızanın üç unsuru bulunmaktadır:
      <br><br>
      1. Belirli bir konuya ilişkin olması: Veri işlemek üzere verilen rızanın geçerli olması için
      rızanın belirli bir konuya ilişkin ve o konu ile sınırlı olması gerekir. Buna göre genel bir
      irade açıklaması ile “kişisel verilerimin işlenmesini kabul ediyorum” şeklinde açık uçlu
      ve belirsiz bir rıza tek başına Kanun kapsamında açık rıza olarak kabul edilemez. Diğer
      bir ifade ile battaniye rızalar hukuken geçersizdir.
      <br><br>
      2. Rızanın bilgilendirmeye dayanması: Açık rıza bir irade beyanı olup, kişinin özgür bir
      şekilde rıza gösterebilmesi için neye rıza gösterdiğini bilmesi gerekir. Bu kapsamda,
      kişiye yapılacak bilgilendirme, mutlaka verinin işlenmesinden önce yapılmalı ve veri
      işleme ile ilgili bütün konularda açık ve anlaşılır bir biçimde gerçekleştirilmelidir.
      Bilgilendirme yapılırken elde edilecek kişisel verilerin hangi amaçlarla kullanılacağı
      açıkça belirtilmeli, kişinin anlamayacağı terimler ya da yazılı bilgilendirme yapıldığında
      okumakta güçlük çekeceği oranda küçük puntolar kullanılmamalıdır.
      <br><br>
      3. Özgür iradeyle açıklanması: Kişinin irade beyanı olan rıza, kişinin yaptığı davranışın
      bilincinde ve kendi kararı olması halinde geçerlilik kazanacaktır. Cebir, tehdit, hata ve
      hile gibi iradeyi sakatlayan hallerde kişinin özgür biçimde karar vermesi mümkün
      değildir. Örneğin, işçiye rıza göstermeme imkânının etkin bir biçimde sunulmadığı veya
      rıza göstermemenin işçi açısından muhtemel bir olumsuzluk doğuracağı durumlarda,
      rızanın özgür iradeye dayandığı kabul edilemez. Açık rızanın özgür irade ile açıklanması
      gerektiğinden, ilgili kişinin açık rızasının alınması, bir ürün veya hizmetin sunulmasının
      ya da ürün veya hizmetten yararlandırılmasının ön şartı olarak ileri sürülmemelidir.
      Örneğin, bir hizmetten yararlanılmasının üyelik şartına bağlanması, alışveriş yapmak
      isteyen bir kişinin üye olmasının zorunlu tutulması ve ayrıca üyelik sözleşmesinin
      kurulması için anne kızlık soyadının zorunluluk olarak öngörülmesi hukuka aykırı
      olacaktır. Çünkü bu şekilde alınan açık rıza özgür irade ile açık rıza verilmesi ilkesine ve
      ölçülülük ilkesine aykırı olacaktır.
      <br> <br>
      Veri Sorumlusunun Aydınlatma Yükümlülüğünün Kapsamı Nedir?
      Veri sorumlusu veya yetkilendirdiği kişi, aydınlatma yükümlülüğü kapsamında veri
      sorumlusunun ve varsa temsilcisinin kimliği, veri işleme amacı, işlenen verilerin kimlere
      ve hangi amaçla aktarılabileceği, veri toplamanın yöntemi ve hukuki sebebi ile Kanunun
      11. maddesinde sayılan diğer hakları konusunda ilgili kişiyi bilgilendirmekle
      yükümlüdür. Aydınlatma yükümlülüğünün yerine getirilmesi ilgili kişinin onayına ya da
      isteğine bağlı değildir. Kişisel veri işleme faaliyeti kapsamında kişisel verinin elde
      edilmesi sırasında veri sorumlusu tarafından ilgili kişilerin aydınlatılması
      gerekmektedir. Bununla birlikte aydınlatma yükümlülüğü yerine getirilirken ilgili kişiye
      verilecek bilgiler, eğer Veri Sorumluları Siciline kayıt yükümlülüğü varsa, Veri
      Sorumluları Siciline açıklanan bilgilerle uyumlu olmalıdır. Kayıt yükümlülüğü yoksa
      Kanunun 10. ve 11. maddeleri kapsamında aydınlatma yükümlülüğü yerine
      getirilmelidir. Veri işleme faaliyetinin ilgili kişinin açık rızasına bağlı olmadığı ve
      faaliyetin Kanundaki başka şartlar kapsamında yürütüldüğü durumlarda da veri
      sorumlusunun ve yetkilendirdiği kişinin ilgili kişiyi aydınlatma yükümlülüğü devam
      etmektedir. Yani her durum ve şartta, her amaç için ayrı ayrı aydınlatma
      yükümlülüğünün yerine getirilmesi gerekmektedir. 48. Aydınlatma Yükümlülüğünün
      Yerine Getirilmesinde Şekil Şartı Var mıdır? Aydınlatma yükümlülüğünün yerine
      getirilmesi konusunda bir şekil şartı bulunmamaktadır. Tek taraflı bir beyanla
      aydınlatma yükümlülüğü yerine getirilebilir. Aydınlatma yükümlülüğünün yerine
      getirildiğinin ispatı ise veri sorumlusuna aittir.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
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
    $("#dateOfBirth").datepicker();
    document.getElementById('dateOfBirth').value = '01/01/2000';
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
      if (result.value) {
        var email = document.getElementById('email').value;
        var firstname = document.getElementById('firstname').value;
        var lastname = document.getElementById('lastname').value;
        var tc = document.getElementById('tc').value;
        var password = document.getElementById('password').value;
        var phone = document.getElementById('phone').value;
        var gender = $("input[type='radio'][name='gender']:checked").val();
        var dateOfBirth = document.getElementById('dateOfBirth').value;
        var consent = $('#consent').prop('checked');
        var dataPost = {
          "email": email,
          "firstname": firstname,
          "lastname": lastname,
          "password": password,
          "phone": phone,
          "gender": gender,
          "dateOfBirth": dateOfBirth,
          "consent": consent,
          "tc": tc
        };
        var dataString = JSON.stringify(dataPost);
        $.ajax({
          url: 'registerPost.php',
          data: {
            myData: dataString
          },
          type: 'POST',
          success: function(response) {
            const obj = JSON.parse(response);
            console.warn(obj);
            if (obj.success == true) {
              swal('Başarılı!', obj.posted, 'success')
              setTimeout(window.location.href = "login.php", 3000);
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
include 'service.php';
?>
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
