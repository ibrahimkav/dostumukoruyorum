<?php
include 'header2.php';
$entriesPerPage = 10;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($page - 1) * $entriesPerPage;

$statement = $db->prepare("SELECT * FROM logs ORDER BY id DESC LIMIT :limit OFFSET :offset");
$statement->bindValue(':limit', $entriesPerPage, PDO::PARAM_INT);
$statement->bindValue(':offset', $offset, PDO::PARAM_INT);
$statement->execute();

$totalEntries = $db->query("SELECT COUNT(*) FROM logs")->fetchColumn();

$totalPages = ceil($totalEntries / $entriesPerPage);
?>


<div class="row justify-content-center" style="margin-top: 750px;">
  <div class="col-lg-30">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Loglar</h2>
        <div class="row mb-3">
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Admin Id</th>
              <th>Log Açıklaması</th>
              <th>Oluşturulma Tarihi</th>
              <th>Düzenle</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
              $admin_id = $row['admin_id'];
              $logs = $row['logs'];
              $createdDate = $row['createdDate'];
              $id = $row['id'];
              
              echo "<tr>";
              echo "<td>$id</td>";
              echo "<td>$admin_id</td>";
              echo "<td>$logs</td>";
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
<ul class="pagination justify-content-center">
  <?php
  $numPerPage = 5; 
  $numGroups = ceil($totalPages / $numPerPage); 

  $currentPageGroup = ceil($page / $numPerPage);

  $startPage = ($currentPageGroup - 1) * $numPerPage + 1;
  $endPage = min($startPage + $numPerPage - 1, $totalPages);

  $prevGroupPage = ($currentPageGroup - 1) * $numPerPage;
  if ($prevGroupPage >= 1) {
    echo "<li class='page-item'><a class='page-link' href='/adminPanel/logs.php?page=$prevGroupPage'>&laquo;</a></li>";
  }

  for ($i = $startPage; $i <= $endPage; $i++) {
    $activeClass = $i == $page ? 'active' : '';
    echo "<li class='page-item $activeClass'><a class='page-link' href='/adminPanel/logs.php?page=$i'>$i</a></li>";
  }

  $nextGroupPage = $currentPageGroup * $numPerPage + 1;
  if ($nextGroupPage <= $totalPages) {
    echo "<li class='page-item'><a class='page-link' href='/adminPanel/logs.php?page=$nextGroupPage'>&raquo;</a></li>";
  }
  ?>
</ul>


<div id="categoryModalEdit" class="modal">
  <div class="row justify-content-center" style="margin-top: 300px;">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <span class="close" onclick="closeCategoryModalEdit()">&times;</span>
          <h2 class="yazi">Log Düzenle</h2>
          <div class="mb-3 mt-3">
            <label for="logs">Log Açıklaması:</label><br>
            <input type="text" class="form-control" style="margin-top: 3px;" id="logs" placeholder="Log Açıklaması giriniz." name="logs" value="<?php echo $logs; ?>">
          </div>
          <button type="edit" id="edit" class="btn btn-primary">Düzenle</button>
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

    $.post('/adminPanel/getLogsValuesById.php?id=' + editId, null).done(function(response) {
      const obj = JSON.parse(response);
      console.warn(obj);
      document.getElementById('logs').value = obj["logs"];
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
      text: "Log düzenlemek istediğinize emin misiniz?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır"
    }).then((result) => {
      if (result.value) {
        var logs = document.getElementById('logs').value;

        var dataPost = {
          "logs": logs,
          "id": editId
        };
        var dataString = JSON.stringify(dataPost);

        $.ajax({
          url: '/adminPanel/logs_update.php',
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
              'Bir hata oluştu, log eklenemedi.',
              'error'
            );
          }
        });
      }
    });
  });
</script>


