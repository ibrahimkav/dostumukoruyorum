<?php
include 'header.php';
?> <?php
    $sql = "SELECT * FROM veterinary v
WHERE 1=1 ";

    $data = [];
    $query = false;


    $businessname = "";
    $email = "";
    $address = "";
    $x = "";
    $y = "";


    if (isset($_GET['ok'])) {
      $businessname = $_GET['businessname'];
      if (!empty($businessname)) {
        $query = true;
        $businessname = "%" . $businessname . "%";
        $data['businessname'] = $businessname;
        $sql .= " AND v.businessname LIKE :businessname";
      }

      $email = $_GET['email'];
      if ($email > 0) {
        $query = true;
        $email = "%" . $email . "%";
        $data['email'] = $email;
        $sql .= " AND v.email LIKE :email";
      }

      $address = $_GET['address'];
      if (!empty($address)) {
        $query = true;
        $address = "%" . $address . "%";
        $data['address'] = $address;
        $sql .= " AND v.address LIKE :address";
      }

      $x = $_GET['x'];
      if (!empty($x)) {
        $query = true;
        $x = "%" . $x . "%";
        $data['x'] = $x;
        $sql .= " AND v.x LIKE :x";
      }

      $y = $_GET['y'];
      if (!empty($y)) {
        $query = true;
        $y = "%" . $y . "%";
        $data['y'] = $y;
        $sql .= " AND v.y LIKE :y";
      }
    }

    $sql .= " ORDER BY v.id DESC";

    $sorgu = $db->prepare($sql);

    if ($query == true) {
      $sorgu->execute($data);
    } else {
      $sorgu->execute();
    }




    ?>



<div class="row " style="margin-top: 50px;margin-left: 150px;margin-right: 150px;padding-right: 90px;padding-left: 90px;">
  <div class="col-sm-12 col-lg-12 col-xl-12 col-xxl-12 bg-white shadow-lg" style="border-radius: 5px;padding-left: 202px;padding-right: 202px;margin-left: 0px;margin-right: -56px;">
    <div class="p-5" style="padding-left: 8px;margin-left: -100px;margin-right: -100px;">
      <div class="text-center">
        <h2 class="text-dark mb-4">Veteriner Arama</h2>
        <br>
      </div>
      <div class="user">
        <form method="get" action="">

          <div class="row">
            <div class="col-4">
              <label for="businessname">Adı</label>
              <input class="form-control form-control-user" type="text" name="businessname" id="businessname" value="<?php echo str_replace("%", "", $businessname); ?>">
            </div>
            <div class="col-4">
              <label for="email">Email</label>
              <input class="form-control form-control-user" type="text" name="email" id="email" value="<?php echo str_replace("%", "", $email); ?>">
            </div>
            <div class="col-4">
              <label for="address">Adres</label>
              <input class="form-control form-control-user" type="text" name="address" id="address" value="<?php echo str_replace("%", "", $address); ?>">
            </div>
            <div class="col-4">
              <label for="x">X</label>
              <input class="form-control form-control-user" type="text" name="x" id="x" value="<?php echo str_replace("%", "", $x); ?>">
            </div>
            <div class="col-4">
              <label for="y">Y</label>
              <input class="form-control form-control-user" type="text" name="y" id="y" value="<?php echo str_replace("%", "", $y); ?>">
            </div>
            <div class="col-4">
              <input class="btn btn-primary d-block btn-user w-100 " style="margin-top:30px;" type="submit" id="ok" name="ok" style="background: #1f4037;" value="Ara" />
            </div>

          </div>
        </form>
        <div>

          <div class="row">

            <h3 class="text-dark mb-4">Veterinerler</h3>

          </div>
          <?php
          while ($row = $sorgu->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $businessnameRow = $row['businessname'];
            $emailRow = $row['email'];
            $addressRow = $row['address'];
            echo " <a class='forum-veteriner-search' href='/veteriner.php?id=$id'>";
            echo " <div class='row'>";
            echo "  <div class='col-md-6'>$businessnameRow <br> Email: &nbsp; $emailRow</div>";
            echo "   <div class='col-md-5'></i> $addressRow";
            echo "  </div>";
            echo "  </div>";
            echo "    <hr>";
            echo "   </a>";
          }
          ?>

        </div>
      </div>
      <br>
      <br>
    </div>
  </div>
</div>

<br>
<br>
<br> <?php


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