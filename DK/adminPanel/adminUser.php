<?php include 'header2.php'; ?>


<div class="row justify-content-center" style="margin-top: 750px;">                            
  <div class="col-lg-30">
  <h1 class="d-flex flex-column text-dark fw-bolder my-0 fs-1">Merhaba, Sayın<?php  echo  "<div style='cursor:pointer;' onclick=\"window.location.href = '\\ adminPanel/bilgiguncelleme.php'\"/>
                                                    ".$_SESSION['username'].
                                                    "</div>";?>
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Adminler</h2>
        <div class="row mb-3">
          <div class="col-md-3">
            <button class="btn btn-primary" onclick="openCategoryModal()">Yeni Admin Ekle</button>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Admin Adı</th>
              <th>Admin Şifre</th>
              <th>Aktiflik Durumu</th>
              <th>Oluşturulma Tarihi</th>
              <th>Düzenle</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $statement = $db->prepare('SELECT * FROM admin ORDER BY id DESC');
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
              $username = $row['username'];
              $password = $row['password'];
              $createdDate = $row['CreatedDate'];
              $isActive = $row['isActive'];
              $id = $row['id'];
              if (strlen($password) > 1) {
                $password = substr($password, 0, 2) . '***';
              }
              echo "<tr>";
              echo "<td>$id</td>";
              echo "<td>$username</td>";
              echo "<td>$password</td>";
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
          <h2 class="yazi">Admin Düzenle</h2>
    <div class="mb-3 mt-3">
      <label for="username">Admin Adı:</label><br>
      <input type="text" class="form-control" style="margin-top: 3px;" id="username" placeholder="Admin Adınızı giriniz." name="username" value="<?php echo $username; ?>">
    </div>
    <div class="mb-3">
      <label for="password">Admin Şifre:</label>
      <input type="password" class="form-control" style="margin-top: 3px;" id="password" placeholder="Admin Şifrenizi giriniz." name="password">
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
<div id="categoryModal" class="modal">
  <div class="row justify-content-center" style="margin-top: 300px;">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <span class="close" onclick="closeCategoryModal()">&times;</span>
          <h2 class="card-title">Admin Ekle</h2>
          <form id="categoryForm">
            <div class="form-group">
              <label for="username">Admin Adı:</label>
              <input type="text" class="form-control" id="username1" placeholder="Admin adınızı giriniz." name="username">
            </div>
            <div class="form-group">
              <label for="password">Admin Şifre:</label>
              <input type="password" class="form-control" id="password1" placeholder="Admin şifrenizi giriniz." name="password">
            </div>
            <div class="form-group">
              <label for="isActive1">Aktiflik Durumu:</label>
              <select id="isActive1" class="form-control">
                <option value="1">Aktif</option>
                <option value="0">Pasif</option>
              </select>
            </div>
            <button type="submit" id="submit" class="btn btn-primary">Ekle</button>
          </form>
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

    $.post('/adminPanel/getAdminUserValuesById.php?id=' + editId, null).done(function(response) {
          const obj = JSON.parse(response);
          console.warn(obj);
          document.getElementById('username').value = obj["username"];
          document.getElementById('password').value = obj["password"];
          document.getElementById('isActive').value = obj["isActive"];
        
     });

  }

  function closeCategoryModalEdit() {
    var modal = document.getElementById("categoryModalEdit");
    modal.style.display = "none";


  }
  function openCategoryModal() {
    var modal = document.getElementById("categoryModal");
    modal.style.display = "block";
  }

  function closeCategoryModal() {
    var modal = document.getElementById("categoryModal");
    modal.style.display = "none";
  }




  $(document).on('click', '#edit', function(e) {
    e.preventDefault();

    Swal.fire({
      title: "Emin misiniz?", 
      text: "Admin'i düzenlemek istediğinize emin misiniz?", 
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır"
    })
    .then((result) => {
      if (result.value) {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var isActive = document.getElementById('isActive').value;

        var dataPost = {
          "username": username,
          "password": password,
          "isActive": isActive,
          "id": editId
        };
        var dataString = JSON.stringify(dataPost);

        $.ajax({
          url: '/adminPanel/adminUser_update.php',
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
              'Bir hata oluştu, admin eklenemedi.',
              'error'
            );
          }
        });
      }
    });
  });



  $(document).on('click', '#submit', function(e) {
    e.preventDefault();

    Swal.fire({
      title: "Emin misiniz?", 
      text: "Admin eklemek istediğinize emin misiniz?", 
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır"
    })
    .then((result) => {
      if (result.value) {
        var username = document.getElementById('username1').value;
        var password = document.getElementById('password1').value;
        var isActive = document.getElementById('isActive1').value;

        var dataPost = {
          "username": username,
          "password": password,
          "isActive": isActive
        };
        var dataString = JSON.stringify(dataPost);

        $.ajax({
          url: '/adminPanel/adminUser_add.php',
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
                window.location.href = "adminPanel/adminUser.php";
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
              'Bir hata oluştu, admin eklenemedi.',
              'error'
            );
          }
        });
      }
    });
  });


  </script>
