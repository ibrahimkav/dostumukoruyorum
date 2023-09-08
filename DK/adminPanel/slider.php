<?php include 'header2.php'; ?>

<div class="row justify-content-center" style="margin-top: 600px;">
  <div class="col-lg-30">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Slider</h2>
        <div class="row mb-3">
          <div class="col-md-3">
            <button class="btn btn-primary" onclick="openSliderModal()">Yeni Slider Ekle</button>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Slider Adı</th>
              <th>Slider Açıklaması</th>
              <th>Aktiflik Durumu</th>
              <th>Oluşturulma Tarihi</th>
              <th>Düzenle</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $statement = $db->prepare('SELECT * FROM slider ORDER BY id DESC');
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
              $head = $row['head'];
              $explanation = $row['explanation'];
              $sldierDate = $row['createdDate'];
              $isActive = $row['isActive'];
              $id = $row['id'];
              if (strlen($explanation) > 10) {
                $explanation = substr($explanation, 0, 7) . '...';
              }
              echo "<tr>";
              echo "<td>$id</td>";
              echo "<td>$head</td>";
              echo "<td>$explanation</td>";
              echo "<td>".($isActive != 0 ? "Aktif" : "Pasif")."</td>";
              echo "<td>$createdDate</td>";
              echo "<td><button class='btn btn-primary' onclick='openSliderModalEdit($id)'>Düzenle</button></td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div id="sliderModalEdit" class="modal">
<div class="row justify-content-center" style="margin-top: 300px;">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <span class="close" onclick="closeSliderModalEdit()">&times;</span>
          <h2 class="yazi">Slider Düzenle</h2>
    <div class="mb-3 mt-3">
      <label for="head">Slider Adı:</label><br>
      <input type="text" class="form-control" style="margin-top: 3px;" id="head" placeholder="Slider adı giriniz." name="head" value="<?php echo $head; ?>">
    </div>
    <div class="mb-3">
      <label for="explanation">Slider Açıklaması:</label>
      <textarea type="text" class="form-control" style="margin-top: 3px;" id="explanation" placeholder="Slider Açıklaması" name="explanation"><?php echo $explanation; ?></textarea>
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
<div id="sliderModal" class="modal">
  <div class="row justify-content-center" style="margin-top: 300px;">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <span class="close" onclick="closeSliderModal()">&times;</span>
          <h2 class="card-title">Slider Ekle</h2>
          <form id="sliderForm">
            <div class="form-group">
              <label for="head">Sldier Adı:</label>
              <input type="text" class="form-control" id="head1" placeholder="Sldier adı giriniz." name="head">
            </div>
            <div class="form-group">
              <label for="explanation">Slider Açıklaması:</label>
              <textarea class="form-control" id="explanation1" placeholder="Slider Açıklaması" name="explanation"></textarea>
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


   function openSliderModalEdit(id) {

    var modal = document.getElementById("sliderModalEdit");
    modal.style.display = "block";

    
    editId = id;

    $.post('/adminPanel/getSliderValuesById.php?id=' + editId, null).done(function(response) {
          const obj = JSON.parse(response);
          console.warn(obj);
          document.getElementById('head').value = obj["head"];
          document.getElementById('explanation').value = obj["explanation"];
          document.getElementById('isActive').value = obj["isActive"];
     });

  }

  function closeSliderModalEdit() {
    var modal = document.getElementById("sliderModalEdit");
    modal.style.display = "none";


  }
  function openSliderModal() {
    var modal = document.getElementById("sliderModal");
    modal.style.display = "block";
  }

  function closeSliderModal() {
    var modal = document.getElementById("sliderModal");
    modal.style.display = "none";
  }




  $(document).on('click', '#edit', function(e) {
    e.preventDefault();

    Swal.fire({
      title: "Emin misiniz?", 
      text: "Slider düzenlemek istediğinize emin misiniz?", 
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır"
    })
    .then((result) => {
      if (result.value) {
        var head = document.getElementById('head').value;
        var explanation = document.getElementById('explanation').value;
        var isActive = document.getElementById('isActive').value;

        var dataPost = {
          "head": head,
          "explanation": explanation,
          "isActive": isActive,
          "id": editId
        };
        var dataString = JSON.stringify(dataPost);

        $.ajax({
          url: '/adminPanel/slider_update.php',
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
              'Bir hata oluştu, slider eklenemedi.',
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
      text: "Slider'ı eklemek istediğinize emin misiniz?", 
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır"
    })
    .then((result) => {
      if (result.value) {
        var head = document.getElementById('head1').value;
        var explanation = document.getElementById('explanation1').value;
        var isActive = document.getElementById('isActive1').value;

        var dataPost = {
          "head": head,
          "explanation": explanation,
          "isActive": isActive
        };
        var dataString = JSON.stringify(dataPost);

        $.ajax({
          url: '/adminPanel/slider_add.php',
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
                window.location.href = "adminPanel/slider.php";
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
              'Bir hata oluştu, slider eklenemedi.',
              'error'
            );
          }
        });
      }
    });
  });


  </script>
