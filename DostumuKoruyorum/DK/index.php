<?php 
include 'header.php';
?>



<style>
  .carousel-inner img {
    width: 100%;
    height: 100%;
  }
  </style>


<div id="demo" class="carousel slide" data-ride="carousel">

  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  
  <div class="carousel-inner">
    <div onclick="window.location.href = 'https://www.mevzuat.gov.tr/mevzuatmetin/1.5.5199-20100611.pdf'"  style="cursor:pointer;" class="carousel-item active">
      <img src="/assets/slider/1.jpg"   height="500">
    </div>
    <div  onclick="window.location.href = 'https://www.mevzuat.gov.tr/mevzuatmetin/1.5.5199-20100611.pdf'" style="cursor:pointer;" class="carousel-item">
      <img src="/assets/slider/2.jpg"  height="500">
    </div>
    <div  onclick="window.location.href = 'https://www.mevzuat.gov.tr/mevzuatmetin/1.5.5199-20100611.pdf'" style="cursor:pointer;" class="carousel-item">
      <img src="/assets/slider/3.jpg"  height="500">
    </div>
  </div>
  
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>


	

 <br><br>
 
 
 <div class="container">
  <h2>Haberler</h2>
  <p>Çekilen son güncel haberler:</p>
  <div class="row"> 
  <?php
            $statement = $db->prepare('SELECT * FROM `news` ORDER BY id DESC LIMIT 4 ');
            $statement->execute(array());
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $head = $row['head'];
                $headNew =  substr($head, 0, 35);
                $desc = $row['desc'];
                $descNew =  substr($desc, 0, 50);
                $id = $row['id'];

                
                echo "  <div class='card news-card' style=''>";
                echo "    <img class='card-img-top' src='data:image/png;base64,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'  style='width:100%'>";
                echo " <div class='card-body'>";
                echo "    <h4 class='card-title'>$headNew...</h4>";
                echo "  <p class='card-text'>$descNew...</p>";
                echo "      <a href='/newsDetail.php?id=$id' class='btn btn-primary stretched-link'><i class='fa fa-newspaper-o' aria-hidden='true'></i>  Haber Detayı</a>";
                echo "       </div> ";
                echo "  </div>";

            }
            ?>

</div>
</div>
 
 
 




<?php
include 'subscribe.php';
?>


<?php 
  include 'service.php';
  ?>
  
<?php 
include 'footer.php';
?>
</body>
