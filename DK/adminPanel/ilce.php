<?php
include 'header2.php';
$entriesPerPage = 10;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($page - 1) * $entriesPerPage;

$statement = $db->prepare("SELECT * FROM ilce ORDER BY id DESC LIMIT :limit OFFSET :offset");
$statement->bindValue(':limit', $entriesPerPage, PDO::PARAM_INT);
$statement->bindValue(':offset', $offset, PDO::PARAM_INT);
$statement->execute();

$totalEntries = $db->query("SELECT COUNT(*) FROM ilce")->fetchColumn();

$totalPages = ceil($totalEntries / $entriesPerPage);

// Sayfalama bağlantıları için gerekli hesaplamalar
$currentPage = $page;
$startPage = max($currentPage - floor($visiblePages / 2), 1);
$endPage = min($startPage + $visiblePages - 1, $totalPages);

?>
<div class="row justify-content-center" style="margin-top: 900px;">
  <div class="col-lg-30">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">İlçeler</h2>
        <div class="row mb-3">
          <div class="col-md-10">
            <button class="btn btn-primary" onclick="openCategoryModal()">Yeni İlçe Ekle</button>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>İl Id</th>
              <th>İlçe Adı</th>
              <th>Düzenle</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
              $ilId = $row['ilId'];
              $ilceAdi = $row['ilceAdi'];
              $id = $row['id'];

              echo "<tr>";
              echo "<td>$id</td>";
              echo "<td>$ilId</td>";
              echo "<td>$ilceAdi</td>";
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
<ul class="pagination justify-content-center">
  <?php
  $numPerPage = 7; 
  $numGroups = ceil($totalPages / $numPerPage); 

  $currentPageGroup = ceil($page / $numPerPage);

  $startPage = ($currentPageGroup - 1) * $numPerPage + 1;
  $endPage = min($startPage + $numPerPage - 1, $totalPages);

  $prevGroupPage = ($currentPageGroup - 1) * $numPerPage;
  if ($prevGroupPage >= 1) {
    echo "<li class='page-item'><a class='page-link' href='/adminPanel/ilce.php?page=$prevGroupPage'>&laquo;</a></li>";
  }

  for ($i = $startPage; $i <= $endPage; $i++) {
    $activeClass = $i == $page ? 'active' : '';
    echo "<li class='page-item $activeClass'><a class='page-link' href='/adminPanel/ilce.php?page=$i'>$i</a></li>";
  }

  $nextGroupPage = $currentPageGroup * $numPerPage + 1;
  if ($nextGroupPage <= $totalPages) {
    echo "<li class='page-item'><a class='page-link' href='/adminPanel/ilce.php?page=$nextGroupPage'>&raquo;</a></li>";
  }
  ?>
</ul>

<div id="categoryModalEdit" class="modal">
  <div class="row justify-content-center" style="margin-top: 300px;">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <span class="close" onclick="closeCategoryModalEdit()">&times;</span>
          <h2 class="yazi">İlçe Düzenle</h2>
          <div class="mb-3 mt-3">
            <label for="ilId">İl Id:</label><br>
            <input type="text" class="form-control" style="margin-top: 3px;" id="ilId" placeholder="İl Id giriniz." name="ilId" value="<?php echo $ilId; ?>">
          </div>
          <div class="mb-3">
            <label for="ilceAdi">İlçe Adı:</label>
            <input type="text" class="form-control" style="margin-top: 3px;" id="ilceAdi" placeholder="İlçe adı giriniz." name="ilceAdi" value="<?php echo $ilceAdi; ?>">
          </div>
          <button type="edit" id="edit" class="btn btn-primary">Düzenle</button>
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
          <h2 class="card-title">İlçe Ekle</h2>
          <form id="categoryForm">
            <div class="form-group">
              <label for="ilId">İl Id:</label><br>
              <input type="text" class="form-control" style="margin-top: 3px;" id="ilId1" placeholder="İl Id giriniz." name="ilId">
            </div>
            <div class="form-group">
              <label for="ilceAdi">İlçe Adı:</label>
              <input type="text" class="form-control" style="margin-top: 3px;" id="ilceAdi1" placeholder="İlçe adı giriniz." name="ilceAdi">
            </div>
            <button type="submit" id="submit" class="btn btn-primary">Ekle</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var editId = 0;

  function openCategoryModalEdit(id) {
    var modal = document.getElementById("categoryModalEdit");
    modal.style.display = "block";

    editId = id;

    $.post('/adminPanel/getilceValuesById.php?id=' + editId, null).done(function(response) {
      const obj = JSON.parse(response);
      console.warn(obj);
      document.getElementById('ilId').value = obj["ilId"];
      document.getElementById('ilceAdi').value = obj["ilceAdi"];
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
      text: "İlçe düzenlemek istediğinize emin misiniz?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır"
    }).then((result) => {
      if (result.value) {
        var ilId = document.getElementById('ilId').value;
        var ilceAdi = document.getElementById('ilceAdi').value;

        var dataPost = {
          "ilId": ilId,
          "ilceAdi": ilceAdi,
          "id": editId
        };
        var dataString = JSON.stringify(dataPost);

        $.ajax({
          url: '/adminPanel/ilce_update.php',
          type: 'POST',
          data: {
            myData: dataString
          },
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
              'Bir hata oluştu, ilce eklenemedi.',
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
      text: "İlçe eklemek istediğinize emin misiniz?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır"
    }).then((result) => {
      if (result.value) {
        var ilId = document.getElementById('ilId1').value;
        var ilceAdi = document.getElementById('ilceAdi1').value;

        var dataPost = {
          "ilId": ilId,
          "ilceAdi": ilceAdi
        };
        var dataString = JSON.stringify(dataPost);

        $.ajax({
          url: '/adminPanel/ilce_add.php',
          type: 'POST',
          data: {
            myData: dataString
          },
          success: function(response) {
            const obj = JSON.parse(response);
            console.warn(obj);
            if (obj.success == true) {
              Swal.fire(
                'Başarılı!',
                obj.posted,
                'success'
              ).then(() => {
                window.location.href = "adminPanel/ilce.php";
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
              'Bir hata oluştu, ilce eklenemedi.',
              'error'
            );
          }
        });
      }
    });
  });
</script>

