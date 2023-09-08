<?php include 'header2.php'; ?>

<div class="row justify-content-center" style="margin-top: 600px;">
  <div class="col-lg-30">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Kullanıcılar</h2>
        <div class="row mb-5">
          <div class="col-md-5">
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Kullanıcı Adı</th>
              <th>Kullanıcı Soyadı</th>
              <th>Cinsiyet</th>
              <th>Doğum Tarihi</th>
              <th>TC</th>
              <th>E Mail</th>
              <th>Password</th>
              <th>Adres</th>
              <th>Telefon</th>
              <th>Silinme Durumu</th>
              <th>Aktiflik Durumu</th>
              <th>Oluşturulma Tarihi</th>
              <th>Düzenle</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $statement = $db->prepare('SELECT * FROM user WHERE isDeleted = 0 ORDER BY id DESC');
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
              $firstname = $row['firstname'];
              $lastname = $row['lastname'];
              $fullname = $row['fullname'];
              $tckno = $row['tckno'];
              $email = $row['email'];
              $password = $row['password']; 
              $gender = $row['gender'];
              $dateOfBirth = $row['dateOfBirth'];
              $isDeleted = $row['isDeleted'];
              $address = $row['address'];
              $phone = $row['phone'];
              $createdDate = $row['createdDate'];
              $isActive = $row['isActive'];
              $id = $row['id'];
              if (strlen($password) > 1) {
                $password = substr($password, 0, 1) . '*****';
              }
              if (strlen($tckno) > 3) {
                $tckno = substr($tckno, 0, 3) . '*****';
              }
              echo "<tr>";
              echo "<td>$id</td>";
              echo "<td>$firstname</td>";
              echo "<td>$lastname</td>";
              echo "<td>$gender</td>";
              echo "<td>$dateOfBirth</td>";
              echo "<td>$tckno</td>";
              echo "<td>$email</td>";
              echo "<td>$password</td>";
              echo "<td>$address</td>";
              echo "<td>$phone</td>";
              echo "<td>".($isDeleted != 0 ? "Silinmiş" : "Kullanılıyor")."</td>";
              echo "<td>".($isActive != 0 ? "Aktif" : "Pasif")."</td>";
              echo "<td>$createdDate</td>";
              echo "<td><button class='btn btn-primary' onclick='openUserModalEdit($id)'>Düzenle</button></td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<div id="userModalEdit" class="modal">
<div class="row justify-content-center" style="margin-top: 300px;">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <span class="close" onclick="closeUserModalEdit()">&times;</span>
          <h2 class="yazi">Kullanıcı Düzenle</h2>
    <div class="mb-3 mt-3">
      <label for="firstname">Kullanıcı Adı:</label><br>
      <input type="text" class="form-control" style="margin-top: 3px;" id="firstname" placeholder="Adınızı ismi giriniz." name="firstname" value="<?php echo $firstname; ?>">
        </div>
    <div class="mb-3 mt-3">
      <label for="lastname">Kullanıcı Soyadı:</label><br>
      <input type="text" class="form-control" style="margin-top: 3px;" id="lastname" placeholder="Soyadınızı giriniz." name="lastname" value="<?php echo $lastname; ?>">
    </div>
    <div class="mb-3 mt-3">
    <label for="gender1">Cinsiyet:</label>
            <select id="gender1" class="form-control">
              <option value="1" <?php echo ($gender == 1 ? "selected" : "") ?>>Erkek</option>
              <option value="2" <?php echo ($gender == 2 ? "selected" : "") ?>>Kız</option>
            </select>
    </div>
    <div class="mb-3 mt-3">
      <label for="dateOfBirth">Doğum Tarihi:</label><br>
      <input type="text" class="form-control" style="margin-top: 3px;" id="dateOfBirth" placeholder="Doğum Tarihini giriniz." name="dateOfBirth" value="<?php echo $dateOfBirth; ?>">
    </div>
    <div class="mb-3 mt-3">
      <label for="tckno">TC:</label><br>
      <input type="text" class="form-control" style="margin-top: 3px;" id="tckno" placeholder="11 Haneli TC'nizi giriniz." name="tckno" value="<?php echo $tckno; ?>">
    </div>
    <div class="mb-3 mt-3">
      <label for="email">E Mail:</label><br>
      <input type="text" class="form-control" style="margin-top: 3px;" id="email" placeholder="Email adresinizi giriniz." name="email" value="<?php echo $email; ?>">
    </div>
    <div class="mb-3 mt-3">
      <label for="address">Adres:</label><br>
      <input type="text" class="form-control" style="margin-top: 3px;" id="address" placeholder="Adresinizi giriniz." name="address" value="<?php echo $address; ?>">
    </div>
    <div class="mb-3 mt-3">
      <label for="phone">Telefon:</label><br>
      <input type="text" class="form-control" style="margin-top: 3px;" id="phone" placeholder="Telefon giriniz." name="lastname" value="<?php echo $phone; ?>">
    </div>

   
    <div class="mb-3 mt-3">
      <label for="isDeleted">Silinme Durumu:</label><br>
      <select id="isDeleted" class="form-control">
        <option value="0" <?php echo ($isDeleted == 0 ? "selected" : "") ?>>Kullanılıyor</option>
        <option value="1" <?php echo ($isDeleted == 1 ? "selected" : "") ?>>Silinmiş</option>
      </select>
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


   function openUserModalEdit(id) {

    var modal = document.getElementById("userModalEdit");
    modal.style.display = "block";

    
    editId = id;

    $.post('/adminPanel/getUserValuesById.php?id=' + editId, null).done(function(response) {
          const obj = JSON.parse(response);
          console.warn(obj);
          document.getElementById('firstname').value = obj["firstname"];
          document.getElementById('lastname').value = obj["lastname"];
          document.getElementById('gender1').value = obj["gender"];
          document.getElementById('dateOfBirth').value = formatDate(obj["dateOfBirth"]);
          document.getElementById('tckno').value = obj["tckno"];
          var email =  obj["email"];
          console.warn(email);
          document.getElementById('email').value = email;
          document.getElementById('address').value = obj["address"];
          document.getElementById('phone').value = obj["phone"];
          document.getElementById('isDeleted').value = obj["isDeleted"];
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

  function closeUserModalEdit() {
    var modal = document.getElementById("userModalEdit");
    modal.style.display = "none";


  }
  function openUserModal() {
    var modal = document.getElementById("userModal");
    modal.style.display = "block";
  }

  function closeUserModal() {
    var modal = document.getElementById("userModal");
    modal.style.display = "none";
  }




  $(document).on('click', '#edit', function(e) {
  e.preventDefault();

  Swal.fire({
    title: "Emin misiniz?", 
    text: "Kullanıcıyı düzenlemek istediğinize emin misiniz?", 
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Evet",
    cancelButtonText: "Hayır"
  })
  .then((result) => {
    if (result.value) {
      var firstname = document.getElementById('firstname').value;
      var lastname = document.getElementById('lastname').value;
      var gender = document.getElementById('gender1').value;
      var dateOfBirth = document.getElementById('dateOfBirth').value;
      var tckno = document.getElementById('tckno').value;
      var email = document.getElementById('email').value;
      var address = document.getElementById('address').value;
      var phone = document.getElementById('phone').value;
      var isDeleted = document.getElementById('isDeleted').value;
      var isActive = document.getElementById('isActive').value;

      var dataPost = {
        "firstname": firstname,
        "lastname": lastname,
        "gender": gender,
        "dateOfBirth": dateOfBirth,
        "tckno": tckno,
        "email": email,
        "address": address,
        "phone": phone,
        "isDeleted": isDeleted,
        "isActive": isActive,
        "id": editId
      };
      var dataString = JSON.stringify(dataPost);

      $.ajax({
        url: '/adminPanel/user_update.php',
        type: 'POST',
        data: { myData: dataString },
        dataType: 'json',
        success: function(response) {
          console.warn(response);
          if (response.success) {
            Swal.fire(
              'Başarılı!',
              response.posted,
              'success'
            ).then(() => {
              window.location.reload();
            });
          } else {
            Swal.fire(
              'Hata!',
              response.errors,
              'error'
            );
          }
        },
        error: function(response) {
          console.warn(response);
          Swal.fire(
            'Hata!',
            'Bir hata oluştu, kullanıcı düzenlenemedi.',
            'error'
          );
        }
      });
    }
  });
});



  </script>
