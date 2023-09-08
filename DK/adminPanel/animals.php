<?php include 'header2.php'; ?>

<div class="row justify-content-center" style="margin-top: 600px;">
  <div class="col-lg-30">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Hayvanlar</h2>
        <div class="row mb-3">
          <div class="col-md-3">
            <button class="btn btn-primary" onclick="openAnimalModal()">Yeni Hayvan Ekle</button>
          </div>
        </div>
        <table class="table" >
          <thead>
            <tr>
              <th>#</th>
              <th>Hayvan Adı</th>
              <th>Hayvan Açıklaması</th>
              <th>Doğum</th>
              <th>Cinsiyet</th>
              <th>Doğum Tarihi</th>
              <th>Aşı - 1</th>
              <th>Aşı Tarihi - 1</th>
              <th>Aşı - 2</th>
              <th>Aşı Tarihi - 2</th>
              <th>Aşı - 3</th>
              <th>Aşı Tarihi - 3</th>
              <th>Aşı - 4</th>
              <th>Aşı Tarihi - 4</th>
              <th>Aktiflik Durumu</th>
              <th>Oluşturulma Tarihi</th>
              <th>Düzenle</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $statement = $db->prepare('SELECT * FROM animals ORDER BY id DESC');
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
              $petname = $row['petname'];
              $animalDescription = $row['animalDescription'];
              $createdDate = $row['createdDate'];
              $breed = $row['breed'];
              $gender = $row['gender'];
              $dateOfBirth = $row['dateOfBirth'];
              $vaccine1 = $row['vaccine1'];
              $vaccine2 = $row['vaccine2'];
              $vaccine3 = $row['vaccine3'];
              $vaccine4 = $row['vaccine4'];
              $date1 = $row['date1'];
              $date2 = $row['date2'];
              $date3 = $row['date3'];
              $date4 = $row['date4'];
              $isActive = $row['isActive'];
              $id = $row['id'];
              $dateOfBirth  = date("d.m.Y", strtotime($dateOfBirth));
              if (strlen($animalDescription) > 10) {
                $animalDescription = substr($animalDescription, 0, 7) . '...';
              }
              echo "<tr>";
              echo "<td>$id</td>";
              echo "<td>$petname</td>";
              echo "<td>$animalDescription</td>";
              echo "<td>$breed</td>";
              echo "<td>".($gender != 0 ? "Erkek" : "Kız")."</td>";
              echo "<td>$dateOfBirth </td>";
              echo "<td>$vaccine1</td>";
              echo "<td>$date1</td>";
              echo "<td>$vaccine2</td>";
              echo "<td>$date2</td>";
              echo "<td>$vaccine3</td>";
              echo "<td>$date3</td>";
              echo "<td>$vaccine4</td>";
              echo "<td>$date4</td>";
              echo "<td>".($isActive != 0 ? "Aktif" : "Pasif")."</td>";
              echo "<td>$createdDate</td>";
              echo "<td><button class='btn btn-primary' onclick='openAnimalModalEdit($id)'>Düzenle</button></td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div id="animalModalEdit" class="modal">
<div class="row justify-content-center" style="margin-top: 300px;">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <span class="close" onclick="closeAnimalModalEdit()">&times;</span>
          <h2 class="yazi">Hayvan Düzenle</h2>
    <div class="mb-3 mt-3">
      <label for="petname">Hayvan İsmi:</label><br>
      <input type="text" class="form-control" style="margin-top: 3px;" id="petname" placeholder="Hayvan ismi giriniz." name="petname" value="<?php echo $petname; ?>">
    </div>
    <div class="mb-3">
      <label for="animalDescription">Hayvan Açıklaması:</label>
      <textarea type="text" class="form-control" style="margin-top: 3px;" id="animalDescription" placeholder="Hayvan Açıklaması" name="animalDescription"><?php echo $animalDescription; ?></textarea>
    </div>
    <div class="mb-3">
      <label for="breed">Doğum:</label>
      <textarea type="text" class="form-control" style="margin-top: 3px;" id="breed" placeholder="Doğum Sayısı" name="breed"><?php echo $breed; ?></textarea>
    </div>
    
    <div class="mb-3">
      <label for="gender">Cinsiyet:</label>
      <select id="gender" class="form-control">
        <option value="1" <?php echo ($gender == 1 ? "selected" : "") ?>>Erkek</option>
        <option value="0" <?php echo ($gender == 0 ? "selected" : "") ?>>Kız</option>
      </select>
    </div>
        <div class="mb-3">
    <label for="dateOfBirth">Hayvanın Doğum Tarihi:</label>
    <input type="text" class="form-control" style="margin-top: 3px;" id="dateOfBirth" placeholder="Hayvanın Doğum Tarihi" name="dateOfBirth" value="<?php echo $dateOfBirth; ?>">
    </div>
    <div class="mb-3">
      <label for="vaccine1">Aşı - 1:</label>
      <textarea type="text" class="form-control" style="margin-top: 3px;" id="vaccine1" placeholder="Aşı - 1" name="vaccine1"><?php echo $vaccine1; ?></textarea>
    </div>
    <div class="mb-3">
    <label for="date1">Aşı - 1 Tarihi:</label>
    <input type="text" class="form-control" style="margin-top: 3px;" id="date1" placeholder="Aşı - 1 Tarihi" name="date1" value="<?php echo $date1; ?>">
    </div>
    <div class="mb-3">
      <label for="vaccin2">Aşı - 2:</label>
      <textarea type="text" class="form-control" style="margin-top: 3px;" id="vaccine2" placeholder="Aşı - 2" name="vaccine2"><?php echo $vaccine2; ?></textarea>
    </div>
    <div class="mb-3">
    <label for="date2">Aşı - 2 Tarihi:</label>
    <input type="text" class="form-control" style="margin-top: 3px;" id="date2" placeholder="Aşı - 2 Tarihi" name="date1" value="<?php echo $date2; ?>">
    </div>
    <div class="mb-3">
      <label for="vaccine3">Aşı - 3:</label>
      <textarea type="text" class="form-control" style="margin-top: 3px;" id="vaccine3" placeholder="Aşı - 3" name="vaccine3"><?php echo $vaccine3; ?></textarea>
    </div>
    <div class="mb-3">
    <label for="date3">Aşı - 3 Tarihi:</label>
    <input type="text" class="form-control" style="margin-top: 3px;" id="date3" placeholder="Aşı - 3 Tarihi" name="date3" value="<?php echo $date3; ?>">
    </div>
    <div class="mb-3">
      <label for="vaccine4">Aşı - 4:</label>
      <textarea type="text" class="form-control" style="margin-top: 3px;" id="vaccine4" placeholder="Aşı - 4" name="vaccine4"><?php echo $vaccine4; ?></textarea>
    </div>
    <div class="mb-3">
    <label for="date4">Aşı - 4 Tarihi:</label>
    <input type="text" class="form-control" style="margin-top: 3px;" id="date4" placeholder="Aşı - 4 Tarihi" name="date4" value="<?php echo $date4; ?>">
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
<div id="animalModal" class="modal">
  <div class="row justify-content-center" style="margin-top: 300px;">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <span class="close" onclick="closeAnimalModal()">&times;</span>
          <h2 class="card-title">Kategori Ekle</h2>
          <form id="animalForm">
            <div class="form-group">
            <label for="petname1">Hayvan İsmi:</label><br>
      <input type="text" class="form-control" style="margin-top: 3px;" id="petname1" placeholder="Hayvan ismi giriniz." name="petname1">
            </div>
            <div class="form-group">
            <label for="animalDescription1">Hayvan Açıklaması:</label>
            <textarea type="text" class="form-control" style="margin-top: 3px;" id="animalDescription1" placeholder="Hayvan Açıklaması" name="animalDescription1"></textarea>
            </div>
            <div class="form-group">
            <label for="breed1">Doğum:</label>
            <textarea type="text" class="form-control" style="margin-top: 3px;" id="breed1" placeholder="Doğum Sayısı" name="breed1"></textarea>
            </div>
            <div class="form-group">
            <label for="gender1">Cinsiyet:</label>
            <select id="gender1" class="form-control">
              <option value="1" <?php echo ($gender == 1 ? "selected" : "") ?>>Erkek</option>
              <option value="0" <?php echo ($gender == 0 ? "selected" : "") ?>>Kız</option>
            </select>
            </div>
            <div class="form-group">
               <label for="dateOfBirth1">Hayvanın Doğum Tarihi:</label>
    <input type="date" class="form-control" style="margin-top: 3px;" id="dateOfBirth1" placeholder="Hayvanın Doğum Tarihi" name="dateOfBirth1">
            </div>
            <div class="form-group">
               <label for="vaccine11">Aşı - 1:</label>
      <textarea type="text" class="form-control" style="margin-top: 3px;" id="vaccine11" placeholder="Aşı - 1" name="vaccine11"></textarea>
            </div>
            <div class="form-group">
            <label for="date11">Aşı - 1 Tarihi:</label>
    <input type="date" class="form-control" style="margin-top: 3px;" id="date11" placeholder="Aşı - 1 Tarihi" name="date11" >
            </div>
            <div class="form-group">
            <label for="vaccin21">Aşı - 2:</label>
      <textarea type="text" class="form-control" style="margin-top: 3px;" id="vaccine21" placeholder="Aşı - 2" name="vaccine21"></textarea>
            </div>
            <div class="form-group">
            <label for="date21">Aşı - 2 Tarihi:</label>
    <input type="date" class="form-control" style="margin-top: 3px;" id="date21" placeholder="Aşı - 2 Tarihi" name="date11" >
            </div>
            <div class="form-group">
            <label for="vaccine31">Aşı - 3:</label>
      <textarea type="text" class="form-control" style="margin-top: 3px;" id="vaccine31" placeholder="Aşı - 3" name="vaccine31"></textarea>
            </div>
            <div class="form-group">
            <label for="date31">Aşı - 3 Tarihi:</label>
    <input type="date" class="form-control" style="margin-top: 3px;" id="date31" placeholder="Aşı - 3 Tarihi" name="date31" >
            </div>
            <div class="form-group">
            <label for="vaccine41">Aşı - 4:</label>
      <textarea type="text" class="form-control" style="margin-top: 3px;" id="vaccine41" placeholder="Aşı - 4" name="vaccine41"></textarea>
            </div>
            <div class="form-group">
            <label for="date41">Aşı - 4 Tarihi:</label>
    <input type="date" class="form-control" style="margin-top: 3px;" id="date41" placeholder="Aşı - 4 Tarihi" name="date41" >
            </div>
            <div class="form-group">
            <label for="isActive1">Aktiflik Durumu:</label>
      <select id="isActive1" class="form-control">
        <option value="1" >Aktif</option>
        <option value="0" >Pasif</option>
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


   function openAnimalModalEdit(id) {

    var modal = document.getElementById("animalModalEdit");
    modal.style.display = "block";
    editId = id;

    $.post('/adminPanel/getAnimalValuesById.php?id=' + editId, null).done(function(response) {
          const obj = JSON.parse(response);
          console.warn(obj);
          document.getElementById('petname').value = obj["petname"];
          document.getElementById('animalDescription').value = obj["animalDescription"];
          document.getElementById('breed').value = obj["breed"];
          document.getElementById('gender').value = obj["gender"];
          document.getElementById('dateOfBirth').value = formatDate(obj["dateOfBirth"]);
          document.getElementById('vaccine1').value = obj["vaccine1"];
          document.getElementById('date1').value = formatDate(obj["date1"]);
          document.getElementById('vaccine2').value = obj["vaccine2"];
          document.getElementById('date2').value = formatDate(obj["date2"]);
          document.getElementById('vaccine3').value = obj["vaccine3"];
          document.getElementById('date3').value = formatDate(obj["date3"]);
          document.getElementById('vaccine4').value = obj["vaccine4"];
          document.getElementById('date4').value = formatDate(obj["date4"]);
          document.getElementById('isActive').value = obj["isActive"];
          
          function formatDate(dateString) {
            if (dateString) {
          var date = new Date(dateString);
          var day = String(date.getDate()).padStart(2, '0');
          var month = String(date.getMonth() + 1).padStart(2, '0');
          var year = date.getFullYear();
          return day + '.' + month + '.' + year;
        }  
          else {
    return "";
  }
}
     });

  }

  function closeAnimalModalEdit() {
    var modal = document.getElementById("animalModalEdit");
    modal.style.display = "none";


  }
  function openAnimalModal() {
    var modal = document.getElementById("animalModal");
    modal.style.display = "block";
  }

  function closeAnimalModal() {
    var modal = document.getElementById("animalModal");
    modal.style.display = "none";
  }




  $(document).on('click', '#edit', function(e) {
  e.preventDefault();

  Swal.fire({
    title: "Emin misiniz?", 
    text: "Hayvanı düzenlemek istediğinize emin misiniz?", 
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Evet",
    cancelButtonText: "Hayır"
  }).then((result) => {
    if (result.isConfirmed) {
      var petname = document.getElementById('petname').value;
      var animalDescription = document.getElementById('animalDescription').value;
      var breed = document.getElementById('breed').value;
      var gender = document.getElementById('gender').value;
      var dateOfBirth = document.getElementById('dateOfBirth').value;
      var vaccine1 = document.getElementById('vaccine1').value;
      var date1 = document.getElementById('date1').value;
      var vaccine2 = document.getElementById('vaccine2').value;
      var date2 = document.getElementById('date2').value;
      var vaccine3 = document.getElementById('vaccine3').value;
      var date3 = document.getElementById('date3').value;
      var vaccine4 = document.getElementById('vaccine4').value;
      var date4 = document.getElementById('date4').value;
      var isActive = document.getElementById('isActive').value;

      var dataPost = {
        "petname": petname,
        "animalDescription": animalDescription,
        "breed": breed,
        "gender": gender,
        "dateOfBirth": dateOfBirth,
        "vaccine1": vaccine1,
        "date1": date1,
        "vaccine2": vaccine2,
        "date2": date2,
        "vaccine3": vaccine3,
        "date3": date3,
        "vaccine4": vaccine4,
        "date4": date4,
        "isActive": isActive,
        "id": editId
      };
      var dataString = JSON.stringify(dataPost);

      $.ajax({
        url: '/adminPanel/animal_update.php',
        type: 'POST',
        data: { myData: dataString },
        success: function(response) {
          const obj = JSON.parse(response);
          console.warn(obj);
          if (obj.success == true) {
            Swal.fire({
              title: 'Başarılı!',
              text: obj.posted,
              icon: 'success'
            }).then(() => {
              window.location.reload();
            });
          } else {
            var errors = obj.errors;
            Swal.fire({
              title: 'Hata!',
              text: errors,
              icon: 'error'
            });
          }
        },
        error: function() {
          Swal.fire({
            title: 'Hata!',
            text: 'Bir hata oluştu, hayvan eklenemedi.',
            icon: 'error'
          });
        }
      });
    }
  });
});

$(document).on('click', '#submit', function(e) {
  e.preventDefault();

  Swal.fire({
    title: "Emin misiniz?", 
    text: "Hayvanı eklemek istediğinize emin misiniz?", 
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Evet",
    cancelButtonText: "Hayır"
  }).then((result) => {
    if (result.isConfirmed) {
      var petname = document.getElementById('petname1').value;
      var animalDescription = document.getElementById('animalDescription1').value;
      var breed = document.getElementById('breed1').value;
      var gender = document.getElementById('gender1').value;
      var dateOfBirth = document.getElementById('dateOfBirth1').value;
      var vaccine1 = document.getElementById('vaccine11').value;
      var date1 = document.getElementById('date11').value;
      var vaccine2 = document.getElementById('vaccine21').value;
      var date2 = document.getElementById('date21').value;
      var vaccine3 = document.getElementById('vaccine31').value;
      var date3 = document.getElementById('date31').value;
      var vaccine4 = document.getElementById('vaccine41').value;
      var date4 = document.getElementById('date41').value;
      var isActive = document.getElementById('isActive1').value;

      var dataPost = {
        "petname": petname,
        "animalDescription": animalDescription,
        "breed": breed,
        "gender": gender,
        "dateOfBirth": dateOfBirth,
        "vaccine1": vaccine1,
        "date1": date1,
        "vaccine2": vaccine2,
        "date2": date2,
        "vaccine3": vaccine3,
        "date3": date3,
        "vaccine4": vaccine4,
        "date4": date4,
        "isActive": isActive,
      };
      var dataString = JSON.stringify(dataPost);

      $.ajax({
        url: '/adminPanel/animal_add.php',
        type: 'POST',
        data: { myData: dataString },
        success: function(response) {
          const obj = JSON.parse(response);
          console.warn(obj);
          if (obj.success == true) {
            Swal.fire({
              title: 'Başarılı!',
              text: obj.posted,
              icon: 'success'
            }).then(() => {
              window.location.href = "adminPanel/animals.php";
            });
          } else {
            var errors = obj.errors;
            Swal.fire({
              title: 'Hata!',
              text: errors,
              icon: 'error'
            });
          }
        },
        error: function() {
          Swal.fire({
            title: 'Hata!',
            text: 'Bir hata oluştu, hayvan eklenemedi.',
            icon: 'error'
          });
        }
      });
    }
  });
});

  </script>
