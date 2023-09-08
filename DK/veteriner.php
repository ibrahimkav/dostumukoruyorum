<?php 
  include 'header.php';
  $id = 1;

  if (isset($_GET["id"])) {
      if (is_numeric($id)) {
          $id = $_GET["id"];
          if($id <= 0){
            echo "<script>window.location.href = '/veteriner_arama.php';</script>";
          }
      }
  }
  
  $data = [
      "id" => $id,
  ];
  
  $statement = $db->prepare("SELECT * FROM veterinary WHERE 1=1 AND approved = 1 AND  id = :id");
  $statement->execute($data);
  $firstRow = $statement->fetch(PDO::FETCH_ASSOC);
  
  
  
  $businessname = "";
  $email = "";
  $phone = "";
  $address = "";
  $approved = "";
  
  if ($firstRow) {
  $businessname = $firstRow['businessname'];
  $email = $firstRow['email'];
  $address = $firstRow['address'];
  $phone = $firstRow['phone'];
  $approved = $firstRow['approved'];
  
  } else {
    echo "<script>window.location.href = '/veteriner_arama.php';</script>";
  }
  

?>


<div class="row" style="margin-top: 50px; margin-left: 150px; margin-right: 150px; padding-right: 90px; padding-left: 90px;">
  <div class="col-sm-12 col-lg-12 col-xl-12 col-xxl-12 bg-white shadow-lg" style="border-radius: 5px; padding-left: 202px; padding-right: 202px; margin-left: 0px; margin-right: -56px;">
    <div class="p-5" style="padding-left: 8px; margin-left: -250px; margin-right: -100px;">
    <body><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-Wj6Hu4ka3g7X+xVW59juPwni11yAJWKq8s6eyseG0DDck4rTIpqRlG2Mn7RVzm0G5DeawQx4KRdksZ3wQItvUQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="header" style="text-align: center;" >
  <h1>Veteriner Klinik Bilgisi</h1>
</div>

<div class="row" style="margin-top: 50px;">
<div class="col-md-8" >
    <!-- Burada fotoğrafınızın HTML kodunu ekleyebilirsiniz -->
    <img style="width: 100%;margin-left:20px;" src="/assets/slider/1.jpg">
  </div>
  <div class="col-md-4 " >
    <div style="margin-left:20px">
    <div class="contact-item">
      <i class="fa fa-user contact-icon"></i>
      <span><?php echo $businessname; ?></span>
    </div><br>
    <div class="contact-item">
      <i class="fas fa-envelope contact-icon"></i>
      <span><?php echo $email; ?></span>
    </div><br>
    <div class="contact-item">
      <i class="fas fa-map-marker-alt contact-icon"></i>
      <span><?php echo $address; ?></span>
    </div><br>
    <div class="contact-item">
      <i class="fas fa-phone contact-icon"></i>
      <span><?php echo $phone; ?></span>
    </div>
    </div>
  </div>

</div>
</div>

  </div>>






<?php 
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