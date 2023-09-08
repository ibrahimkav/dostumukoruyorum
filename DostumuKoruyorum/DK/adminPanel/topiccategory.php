<?php include 'header2.php'; ?>

<div class="row justify-content-center" style="margin-top: 600px;">
  <div class="col-lg-30">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Konu kategorileri</h2>
        <div class="row mb-5">
          <div class="col-md-5">
            <button class="btn btn-primary" onclick="openCategoryModal()">Yeni Konu kategorisi Ekle</button>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Kategori Adı</th>
              <th>Aktiflik Durumu</th>
              <th>Oluşturulma Tarihi</th>
              <th>Düzenle</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $statement = $db->prepare('SELECT * FROM topiccategory ORDER BY id DESC');
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
              $categoryName = $row['categoryName'];
              $createdDate = $row['createdDate'];
              $isActive = $row['isActive'];
              $id = $row['id'];
              echo "<tr>";
              echo "<td>$id</td>";
              echo "<td>$categoryName</td>";
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
          <h2 class="yazi">Konu Kategorisi Düzenle</h2>
    <div class="mb-3 mt-3">
      <label for="categoryName">Kategori İsmi:</label><br>
      <input type="text" class="form-control" style="margin-top: 3px;" id="categoryName" placeholder="Kategori ismi giriniz." name="categoryName" value="<?php echo $categoryName; ?>">
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
          <h2 class="card-title">Kategori Ekle</h2>
          <form id="categoryForm">
            <div class="form-group">
              <label for="categoryName">Kategori İsmi:</label>
              <input type="text" class="form-control" id="categoryName1" placeholder="Kategori ismi giriniz." name="categoryName">
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

    $.post('/adminPanel/gettopicCategoryValuesById.php?id=' + editId, null).done(function(response) {
          const obj = JSON.parse(response);
          console.warn(obj);
          document.getElementById('categoryName').value = obj["categoryName"];
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
      text: "Konu kategori düzenlemek istediğinize emin misiniz?", 
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır"
    })
    .then((result) => {
      if (result.value) {
        var categoryName = document.getElementById('categoryName').value;
        var isActive = document.getElementById('isActive').value;

        var dataPost = {
          "categoryName": categoryName,
          "isActive": isActive,
          "id": editId
        };
        var dataString = JSON.stringify(dataPost);

        $.ajax({
          url: '/adminPanel/topiccategory_update.php',
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
              'Bir hata oluştu, konu kategori eklenemedi.',
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
      text: "Konu kategori eklemek istediğinize emin misiniz?", 
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır"
    })
    .then((result) => {
      if (result.value) {
        var categoryName = document.getElementById('categoryName1').value;
        var isActive = document.getElementById('isActive1').value;

        var dataPost = {
          "categoryName": categoryName,
          "isActive": isActive
        };
        var dataString = JSON.stringify(dataPost);

        $.ajax({
          url: '/adminPanel/topiccategory_add.php',
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
                window.location.href = "adminPanel/topiccategory.php";
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
              'Bir hata oluştu, konu kategori eklenemedi.',
              'error'
            );
          }
        });
      }
    });
  });


  </script>
