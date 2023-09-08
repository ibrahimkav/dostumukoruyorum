<?php
include 'header.php';
?>
<!--VERİ TABANINDAN VERİ CEKMEK İCİN KULANILAN KOD OLMASA VERI GORUKMEZ--> <?php
$sql = "SELECT c.id, c.categoryId, c.createdDate, c.title, CONCAT(u.firstname, ' ', u.lastname) AS kisi FROM topic c
INNER JOIN USER u ON u.id = c.userId
WHERE 1=1 AND c.isDeleted = 0 AND c.isActive = 1";

$data = [];
$query = false;


$title = "";
$category = -1;

if (isset($_GET['ok'])) {
  $title = $_GET['konu'];
  if (!empty($title)) {
    $query = true;
    $title = "%" . $title . "%";
    $data['title'] = $title;
    $sql .= " AND c.title LIKE :title";
  }

  $category = $_GET['category'];
  if ($category > 0) {
    $query = true;
    $data['category'] = $category;
    $sql .= " AND c.categoryId = :category";
  }
}

$sql .= " ORDER BY c.id DESC";

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
        <h2 class="text-dark mb-4">Forum</h2>
        <a href="/konu-ekle.php" class="btn btn-primary d-block btn-user w-100 " style="margin-top:30px;" style="background: #1f4037;" />Yeni Konu Ekle </a>
        <br>
      </div>
      <div class="user">
        <form method="get" action="">

          <div class="row">
            <div class="col-4">
              <label for="category">Kategori</label>
              <select class="form-control form-control-user" name="category" id="category" style="height:fit-content;">
                <option value="-1">Seçiniz...</option>
                <?php
                $statement = $db->prepare('SELECT id,categoryName FROM topicCategory WHERE isActive = 1');
                $statement->execute(array());
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                  $categoryId = $row['id'];
                  $categoryName = $row['categoryName'];
                  echo " <option value='$categoryId'>$categoryName</option>";
                }
                ?>
              </select>
            </div>
            <div class="col-4">
              <label for="konu">Konu</label>
              <input class="form-control form-control-user" type="text" name="konu" id="konu" value="<?php echo str_replace("%","",$title); ?>">
            </div>
            <div class="col-4">
              <input class="btn btn-primary d-block btn-user w-100 " style="margin-top:30px;" type="submit" id="ok" name="ok" style="background: #1f4037;" value="Ara" />
            </div>
            
          </div>
        </form>
        <div>

          <div class="row">

            <h3 class="text-dark mb-4">Konular</h3>

          </div>
<?php
          while ($row = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                  $id = $row['id'];
                  $title = $row['title'];
                  $kisi = $row['kisi'];
                  $createdDate = $row['createdDate'];

               echo " <a class='forum-veteriner-search' href='/konu.php?id=$id'>";
               echo " <div class='row '>";
               echo "  <div class='col-md-6'>$title</div>";
               echo "   <div class='col-md-5'><i class='fa fa-user' aria-hidden='true'></i> $kisi";
               echo "  <br><i class='fa fa-calendar' aria-hidden='true'></i> $createdDate";
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
   <?php



?>



<br>
<br>
<br> <?php

if($category >0){
  echo "<script>document.getElementById('category').value = $category</script>";
  }


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