<?php 
  include 'header.php';
  include 'sessionUserControl.php';
?> 

<?php 




?>



<div class="row " style="margin-top: 50px;margin-left: 150px;margin-right: 150px;padding-right: 90px;padding-left: 90px;">
  <div class="col-sm-12 col-lg-12 col-xl-12 col-xxl-12 bg-white shadow-lg" style="border-radius: 5px;padding-left: 202px;padding-right: 202px;margin-left: 0px;margin-right: -56px;">
    <div class="p-5" style="padding-left: 8px;margin-left: -100px;margin-right: -100px;">
      <div class="text-center">
        <h2 class="text-dark mb-4">Konu Ekle</h2>
      </div>
      <div class="user">
        <div>
          <div class="row">
            <div class="col-12">
              <label for="konu">Konu Başlığı:</label>
              <input class="form-control form-control-user" type="text" name="konu" id="konu">
            </div>
            <div class="col-12">
              <label for="icerik">Konu İçeriği</label>
              <textarea id="icerik" class="form-control"> </textarea>
            </div>

            <div class="col-12">
              <label for="category">Konu Kategorisi</label>
              <select class="form-control form-control-user" name="category" id="category" style="height:fit-content;">
                <option value="-1">Seçiniz...</option>
                <?php
                $statement = $db->prepare('SELECT id,categoryName FROM topicCategory WHERE isActive = 1');
                $statement->execute(array());
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                  $categoryId = $row['id'];
                  $categoryName = $row['categoryName'];
                  echo " <option value='$categoryId'>$categoryName</option>";
                }
                ?>
              </select>
            </div>
     
            <div class="col-12">
              <input class="btn btn-primary d-block btn-user w-100 " style="margin-top:30px;" type="submit" id="send"  style="background: #1f4037;" value="Ekle" />
            </div>
          </div>
              </div>
        <div>
       
      </div>
      <br>
      <br>
    </div>
  </div>
</div>
<br>
<br>
<br> 

<script>
        $(document).on('click', '#send', function(e) {
              var konu = document.getElementById('konu').value;
              var icerik = document.getElementById('icerik').value;
              var category = document.getElementById('category').value;

              var dataPost = {
                "konu": konu,
                "icerik": icerik,
                "category": category
              };
              var dataString = JSON.stringify(dataPost);

              $.ajax({
                url: 'konuEklePost.php',
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
                    setTimeout(window.location.href = "/forum.php", 1500);
                  } else {
                    var errors = obj.errors;
                    swal('Hata!', errors, 'error')
                  }
                }
              });
            }
        );
      </script>



</script>


<?php 
  include 'footer.php';
?> <script src="assets/bootstrap/js/bootstrap.min.js"></script>
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