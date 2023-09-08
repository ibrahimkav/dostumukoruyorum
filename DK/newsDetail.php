<?php
include "header.php";

$id = 1;

if (isset($_GET["id"])) {
    if (is_numeric($id)) {
        $id = $_GET["id"];
        if($id <= 0){
          echo "<script>window.location.href = '/index.php';</script>";
        }
    }
}

$data = [
    "id" => $id,
];

$statement = $db->prepare("SELECT * FROM news WHERE id = :id");
$statement->execute($data);
$firstRow = $statement->fetch(PDO::FETCH_ASSOC);



$head = "";
$desc = "";

if ($firstRow) {
$head = $firstRow['head'];
$desc = $firstRow['desc'];

} else {
  echo "<script>window.location.href = '/index.php';</script>";
}

?> 


<div class="row " style="margin-top: 50px;margin-left: 150px;margin-right: 150px;padding-right: 90px;padding-left: 90px;">
  <div class="col-sm-12 col-lg-12 col-xl-12 col-xxl-12 bg-white shadow-lg" style="border-radius: 5px;padding-left: 202px;padding-right: 202px;margin-left: 0px;margin-right: -56px;">
    <div class="p-5" style="padding-left: 8px;margin-left: -100px;margin-right: -100px;">
      <div class="text-center">
        <h2 class="text-dark mb-4" style="text-align:left;"><?php echo $head; ?></h2>
      </div>
      <div class="user">
      <?php echo $desc; ?>
        <div>
       
      </div>
      <br>
      <br>
    </div>
  </div>
</div>
<br>
<br>
<br> <?php include "footer.php"; ?> <script src="assets/bootstrap/js/bootstrap.min.js"></script>
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