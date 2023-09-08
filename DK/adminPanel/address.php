<?php include 'header2.php'; ?>


<div class="row justify-content-center" style="margin-top: 750px;">

                                       
  <div class="col-lg-30">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Adresler</h2>
        <div class="row mb-3">
          <div class="col-md-3">
            <button class="btn btn-primary" onclick="openCategoryModal()">Yeni Adres Ekle</button>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Kullanıcı Id</th>
              <th>İl Id</th>
              <th>İlçe Id</th>
              <th>directions</th>
              <th>Düzenle</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $statement = $db->prepare('SELECT * FROM address ORDER BY id DESC');
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
              $userId = $row['userId'];
              $ilId = $row['ilId'];
              $ilceId = $row['ilceId'];
              $directions = $row['directions'];
              $createdDate = $row['CreatedDate'];
              $id = $row['id'];
              if (strlen($directions) > 7) {
                $directions = substr($directions, 0, 7) . '...';
              }
              echo "<tr>";
              echo "<td>$id</td>";
              echo "<td>$userId</td>";
              echo "<td>$ilId</td>";
              echo "<td>$ilceId</td>";
              echo "<td>$directions</td>";
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
          <h2 class="yazi">Adres Düzenle</h2>
    <div class="mb-3 mt-3">
      <label for="userId">Kullanıcı Id:</label><br>
      <input type="text" class="form-control" style="margin-top: 3px;" id="userId" placeholder="Kullanıcı Id giriniz." name="userId" value="<?php echo $userId; ?>">
    </div>
    <div class="mb-3">
      <label for="ilId">İl Id:</label>
      <input type="text" class="form-control" style="margin-top: 3px;" id="ilId" placeholder="İl Id giriniz." name="ilId" value="<?php echo $ilId; ?>">
    </div>
    <div class="mb-3">
      <label for="ilceId">İlce Id:</label>
      <input type="text" class="form-control" style="margin-top: 3px;" id="ilceId" placeholder="İlce Id giriniz." name="ilceId" value="<?php echo $ilceId; ?>">
    </div>
    <div class="mb-3">
      <label for="directions">Adres:</label>
      <input type="text" class="form-control" style="margin-top: 3px;" id="directions" placeholder="Açıklama giriniz." name="directions" value="<?php echo $directions; ?>">
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
          <h2 class="card-title">Adres Ekle</h2>
          <form id="categoryForm">
            <div class="form-group">
            <label for="userId">Kullanıcı Id:</label><br>
      <input type="text" class="form-control" style="margin-top: 3px;" id="userId1" placeholder="Kullanıcı Id giriniz." name="userId" >
            </div>
            <div class="form-group">
            <label for="ilId">İl Id:</label>
      <input type="text" class="form-control" style="margin-top: 3px;" id="ilId1" placeholder="İl Id giriniz." name="ilId" >
            </div>
            <div class="form-group">
            <label for="ilceId">İlce Id:</label>
      <input type="text" class="form-control" style="margin-top: 3px;" id="ilceId1" placeholder="İlce Id giriniz." name="ilceId" >
            </div>
            <div class="form-group">
            <label for="directions">Adres:</label>
      <input type="text" class="form-control" style="margin-top: 3px;" id="directions1" placeholder="Açıklama giriniz." name="directions">
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

    $.post('/adminPanel/getAddressValuesById.php?id=' + editId, null).done(function(response) {
          const obj = JSON.parse(response);
          console.warn(obj);
          document.getElementById('userId').value = obj["userId"];
          document.getElementById('ilId').value = obj["ilId"];
          document.getElementById('ilceId').value = obj["ilceId"];
          document.getElementById('directions').value = obj["directions"];

        
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
      text: "Adres düzenlemek istediğinize emin misiniz?", 
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır"
    })
    .then((result) => {
      if (result.value) {
        var userId = document.getElementById('userId').value;
        var ilId = document.getElementById('ilId').value;
        var ilceId = document.getElementById('ilceId').value;
        var directions = document.getElementById('directions').value;

        var dataPost = {
          "userId": userId,
          "ilId": ilId,
          "ilceId": ilceId,
          "directions": directions,
          "id": editId
        };
        var dataString = JSON.stringify(dataPost);

        $.ajax({
          url: '/adminPanel/address_update.php',
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
              'Bir hata oluştu, adres eklenemedi.',
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
      text: "Adres eklemek istediğinize emin misiniz?", 
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır"
    })
    .then((result) => {
      if (result.value) {
        var userId = document.getElementById('userId1').value;
        var ilId = document.getElementById('ilId1').value;
        var ilceId = document.getElementById('ilceId1').value;
        var directions = document.getElementById('directions1').value;

        var dataPost = {
          "userId": userId,
          "ilId": ilId,
          "ilceId": ilceId,
          "directions": directions
        };
        var dataString = JSON.stringify(dataPost);

        $.ajax({
          url: '/adminPanel/address_add.php',
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
                window.location.href = "adminPanel/address.php";
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
              'Bir hata oluştu, adres eklenemedi.',
              'error'
            );
          }
        });
      }
    });
  });


  </script>
