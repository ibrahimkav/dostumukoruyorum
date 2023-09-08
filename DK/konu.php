<?php 
  include 'header.php';

  $userId = 0;
  $userId = $_SESSION["id"];

  $id = 1;

if (isset($_GET["id"])) {
    if (is_numeric($id)) {
        $id = $_GET["id"];
        if($id <= 0){
          echo "<script>window.location.href = '/forum.php';</script>";
        }
    }
}

$data = [
    "id" => $id,
];

$statement = $db->prepare("SELECT c.id, c.categoryId, c.createdDate, c.subject, c.title, CONCAT(u.firstname, ' ', u.lastname) AS kisi FROM topic c
INNER JOIN USER u ON u.id = c.userId
WHERE 1=1 AND c.isDeleted = 0 AND c.isActive = 1 AND c.id = :id");
$statement->execute($data);
$firstRow = $statement->fetch(PDO::FETCH_BOTH);

$kisiTopic = "";
$createdDateTopic = "";
$titleTopic = "";
$subjectTopic = "";

if ($firstRow) {
    $kisiTopic = $firstRow['kisi'];
    $createdDateTopic = $firstRow['createdDate'];
    $titleTopic = $firstRow['title'];
    $subjectTopic = $firstRow['subject'];
} else {
    echo "<script>window.location.href = '/forum.php';</script>";
}

?>


<div class="row " style="margin-top: 50px;margin-left: 150px;margin-right: 150px;padding-right: 90px;padding-left: 90px;">
  <div class="col-sm-12 col-lg-12 col-xl-12 col-xxl-12 bg-white shadow-lg" style="border-radius: 5px;padding-left: 202px;padding-right: 202px;margin-left: 0px;margin-right: -56px;">
    <div class="p-5" style="padding-left: 8px;margin-left: -100px;margin-right: -100px;">
      <div class="text-center">
        <h2 style="text-align:left;" class="text-dark mb-4"><?php echo $titleTopic; ?> </h2>
      </div>
      <div class="user">
        <form method="get" action="">
          <div class="row">
            <div class="col-4"></div>
          </div>
        </form>
        <div>
          <div class="row"></div>
          <a class="forum-veteriner-search" href="javascript:;">
            <div class="row">
              <div class="col-md-1">
                <img style="width:60px" src="/assets/user-img.jpg" style="border-radius:10px;" />
              </div>
              <div class="col-md-3">
                <i class="fa fa-user" aria-hidden="true"></i> <?php echo $kisiTopic; ?> <br>
                <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $createdDateTopic; ?>
              </div>
              <div class="col-md-8"><?php echo $subjectTopic; ?> </div>
            </div>
            <hr>
          </a>
        </div>
      </div>
      <br>
      <br>
    </div>
  </div>
</div>
<br>
<br>
<br>
<div class="row " style="margin-top: 50px;margin-left: 150px;margin-right: 150px;padding-right: 90px;padding-left: 90px;margin-top:-60px">
  <div class="col-sm-12 col-lg-12 col-xl-12 col-xxl-12 bg-white shadow-lg" style="border-radius: 5px;padding-left: 202px;padding-right: 202px;margin-left: 0px;margin-right: -56px;">
    <div class="p-5" style="padding-left: 8px;margin-left: -100px;margin-right: -100px;">
      <div class="text-center">
        <h2 style="text-align:left;" class="text-dark mb-4">Yorumlar</h2>
      </div>
      <div class="user">
        <form method="get" action="">
          <div class="row">
            <div class="col-4"></div>
          </div>
        </form>
        <div>
          <div class="row"></div>
          <?php
          $sql = "SELECT  COMMENT,CONCAT(u.firstname, ' ', u.lastname) AS kisi ,c.`createdDate` FROM topicComment c
          INNER JOIN USER u ON u.id = c.userId
          WHERE 1=1 AND c.isDeleted = 0 AND c.topicId = :id";
          $sorgu = $db->prepare($sql);
          $sorgu->execute($data);
          while ($row = $sorgu->fetch(PDO::FETCH_BOTH)) {
                  $kisi = $row['kisi'];
                  $comment = $row['COMMENT'];
                  $createdDate = $row['createdDate'];

                   echo "  <a class='forum-veteriner-search' href='javascript:;'>";
                   echo "   <div class='row'>";
                   echo "  <div class='col-md-1'>";
                   echo "  <img style='width:60px' src='/assets/user-img.jpg'>";
                   echo "   </div>";
                   echo "  <div class='col-md-3'>";
                   echo "   <i class='fa fa-user' aria-hidden='true'></i> $kisi <br>";
                   echo "    <i class='fa fa-calendar' aria-hidden='true'></i> $createdDate";
                   echo "</div>";
                   echo "  <div class='col-md-8'>$comment</div>";
                   echo "   </div>";
                   echo "     <hr>";
                   echo "     </a>";
                }
                ?>
       
        </div>
      </div>
      <br>
      <br>
    </div>
  </div>
</div>
<div class="row " style="margin-top: 50px;margin-left: 150px;margin-right: 150px;padding-right: 90px;padding-left: 90px;<?php echo ($userId <= 0 ? "display:none;" : "" ); ?>">
  <div class="col-sm-12 col-lg-12 col-xl-12 col-xxl-12 bg-white shadow-lg" style="border-radius: 5px;padding-left: 202px;padding-right: 202px;margin-left: 0px;margin-right: -56px;">
    <div class="p-5" style="padding-left: 8px;margin-left: -100px;margin-right: -100px;">
      <div class="text-center">
        <h2 style="text-align:center;" class="text-dark mb-4">Yorum ekle</h2>
      </div>
      <div class="user">
        <div>
          <div class="row">
            <div class="col-8">
              <label for="comment">Yorum </label>
              <textarea id="comment" class="form-control"> </textarea>
            </div>
        
            <div class="col-4">
              <input class="btn btn-primary d-block btn-user w-100 " style="margin-top:30px;" type="submit" id="send" name="send" value="Ekle">
            </div>
          </div>
              </div>
        <div></div>
      </div>
      <br>
      <br>
    </div>
  </div>
</div> 

<script>
        $(document).on('click', '#send', function(e) {
              var comment = document.getElementById('comment').value;

              var dataPost = {
                "comment": comment,
                "id": <?php echo $id; ?>,
              };
              var dataString = JSON.stringify(dataPost);

              console.warn(dataString);

              $.ajax({
                url: 'konuYorumEklePost.php',
                data: {
                  myData: dataString
                },
                type: 'POST',
                success: function(response) {
                  const obj = JSON.parse(response);
                  console.warn(obj);
                  if (obj.success == true) {
                    swal('Başarılı!', obj.posted, 'success')
                    setTimeout(window.location.reload(), 1500);
                  } else {
                    var errors = obj.errors;
                    swal('Hata!', errors, 'error')
                  }
                }
              });
            }
        );
      </script>






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