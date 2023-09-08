<?php include 'header2.php'; ?>

<div class="row justify-content-center" style="margin-top: 750px;">
  <div class="col-lg-30">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">İletişim</h2>
        <div class="row mb-3">
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>İsim Ve Soyisim</th>
              <th>E Mail</th>
              <th>Telefon Numarası</th>
              <th>Açıklama</th>
              <th>Aktiflik Durumu</th>
              <th>Oluşturulma Tarihi</th>
              <th>Düzenle</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $statement = $db->prepare('SELECT * FROM contact ORDER BY id DESC');
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
              $fullname = $row['fullname'];
              $email = $row['email'];
              $phonenumber = $row['phonenumber'];
              $comment = $row['comment'];
              $createdDate = $row['createdDate'];
              $isActive = $row['isActive'];
              $id = $row['id'];
              if (strlen($comment) > 10) {
                $comment = substr($comment, 0, 7) . '...';
              }
              echo "<tr>";
              echo "<td>$id</td>";
              echo "<td>$fullname</td>";
              echo "<td>$email</td>";
              echo "<td>$phonenumber</td>";
              echo "<td>$comment</td>";
              echo "<td>".($isActive != 0 ? "Aktif" : "Pasif")."</td>";
              echo "<td>$createdDate</td>";
              echo "<td><button class='btn btn-primary' onclick='openCategoryModalEdit($id)'>Düzenle</button></td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div id="categoryModalEdit" class="modal">
<div class="row justify-content-center" style="margin-top: 300px;">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <span class="close" onclick="closeCategoryModalEdit()">&times;</span>
          <h2 class="yazi">İletişim Düzenle</h2>
    <div class="mb-3 mt-3">
      <label for="fullname">İsim Ve Soyisim:</label><br>
      <input type="text" class="form-control" style="margin-top: 3px;" id="fullname" placeholder="İsim ve soyisim ismi giriniz." name="fullname" value="<?php echo $fullname; ?>">
    </div>
    <div class="mb-3">
      <label for="email">E Mail:</label>
      <textarea type="text" class="form-control" style="margin-top: 3px;" id="email" placeholder="Email giriniz." name="email"><?php echo $email; ?></textarea>
    </div>
    <div class="mb-3">
      <label for="phonenumber">Telefon Numarası:</label>
      <textarea type="text" class="form-control" style="margin-top: 3px;" id="phonenumber" placeholder="Telefon numaranızı giriniz." name="phonenumber"><?php echo $phonenumber; ?></textarea>
    </div>
    <div class="mb-3">
      <label for="comment">Açıklama:</label>
      <textarea type="text" class="form-control" style="margin-top: 3px;" id="comment" placeholder="İletişim Açıklaması" name="comment"><?php echo $content; ?></textarea>
    </div>
    <div class="mb-3">
      <label for="isActive">Aktiflik Durumu:</label>
      <select id="isActive" class="form-control">
        <option value="1" <?php echo ($isActive == 1 ? "selected" : "") ?>>Aktif</option>
        <option value="0" <?php echo ($isActive == 0 ? "selected" : "") ?>>Pasif</option>
      </select>
    </div>
    <button type="edit" id="edit" class="btn btn-primary">Düzenle</button>
</div>
</div>
          </div>
          </div>
          </div>
          </div>

<script>
  
var editId  = 0;


function openCategoryModalEdit(id) {
  var modal = document.getElementById("categoryModalEdit");
  modal.style.display = "block";

  editId = id;

  $.post('/adminPanel/getContactValuesById.php?id=' + editId, null).done(function(response) {
    const obj = JSON.parse(response);
    console.warn(obj);
    document.getElementById('fullname').value = obj["fullname"];
    document.getElementById('email').value = obj["email"];
    document.getElementById('phonenumber').value = obj["phonenumber"];
    document.getElementById('comment').value = obj["comment"];
    document.getElementById('isActive').value = obj["isActive"];
  });
}

  function closeCategoryModalEdit() {
    var modal = document.getElementById("categoryModalEdit");
    modal.style.display = "none";


  }




  $(document).on('click', '#edit', function(e) {
    e.preventDefault();

    Swal.fire({
      title: "Emin misiniz?", 
      text: "İletişim düzenlemek istediğinize emin misiniz?", 
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır"
    })
    .then((result) => {
      if (result.value) {
        var fullname = document.getElementById('fullname').value;
        var email = document.getElementById('email').value;
        var phonenumber = document.getElementById('phonenumber').value;
        var comment = document.getElementById('comment').value;
        var isActive = document.getElementById('isActive').value;

        var dataPost = {
          "fullname": fullname,
          "email": email,
          "phonenumber": phonenumber,
          "comment": comment,
          "isActive": isActive,
          "id": editId
        };
        var dataString = JSON.stringify(dataPost);

        $.ajax({
          url: '/adminPanel/contact_update.php',
          type: 'POST',
          data: { myData: dataString },
          success: function(response) {
            const obj = JSON.parse(response);
            console.warn(obj);
            if (obj.success == true) {
              Swal.fire(
                'Başarılı!',
                obj.posted,
                'success'
              ).then(() => {
                window.location.reload();
              });
            } else {
              var errors = obj.errors;
              Swal.fire(
                'Hata!',
                errors,
                'error'
              );
            }
          },
          error: function() {
            Swal.fire(
              'Hata!',
              'Bir hata oluştu, news eklenemedi.',
              'error'
            );
          }
        });
      }
    });
  });
  </script>
