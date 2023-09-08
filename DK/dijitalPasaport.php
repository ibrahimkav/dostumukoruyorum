<?php 
  include 'header.php';
  include 'sessionUserControl.php';
?>


<body>
    <div>
        <div class="container">
        <div class="row" style="margin-top: 11px;">
            <div class="col-md-4 offset-xl-8 d-flex justify-content-center align-items-center">
                <form action="dijitalPasaport_ekle.php" method="post">
                    <button class="btn btn-primary d-flex align-items-center align-self-center" type="submit" style="height: 38px;background-color: rgb(31,64,55);margin-bottom: 7px;">
                        Ekle<i class="fa fa-plus-circle"></i>
                    </button>
                </form>
            </div>
        </div>
        
            <div class="row">
                <div class="col-md-12">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Hayvanın Adı</th>
                <th>Irkı</th>
                <th>cinsiyeti</th>
                <th>Doğum Tarihi</th>
                <th>Aşı 1</th>
                <th>Aşı 2</th>
                <th>Aşı 3</th>
                <th>Aşı 4</th>
                <th>Güncelle</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $data["id"] = $_SESSION["id"];
        $statement = $db->prepare('SELECT * FROM `animals` WHERE userId = :id ORDER BY id desc ');
        $statement->execute($data);
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['id'];
                $petname = $row['petname'];
                $breed = $row['breed'];
                $gender = $row['gender'];
                $genderText = ($gender == 1 ? "Erkek" : "Kız");
                $vaccine1 = $row['vaccine1'];
                $vaccine2 = $row['vaccine2'];
                $vaccine3 = $row['vaccine3'];
                $vaccine4 = $row['vaccine4'];
                $dateOfBirth = $row['dateOfBirth'];

                echo " <tr>";
                echo "<td>$id</td>";
                echo "<td>$petname</td>";
                echo "<td>$breed</td>";
                echo "<td>$genderText</td>";
                echo "<td>$dateOfBirth</td>";
                echo "<td>$vaccine1</td>";
                echo "<td>$vaccine2</td>";
                echo "<td>$vaccine3</td>";
                echo "<td>$vaccine4</td>";
                echo "<td><a href='dijitalPasaport_guncelle.php?id=$id' class='btn btn-warning' name='güncelle'><i class='fas fa-pencil-alt d-xl-flex justify-content-xl-center align-items-xl-center'></i></a> </td>";
                echo "</tr>";
            }
            ?>
    </table>
</div>
</div>
</div>
</div>


<?php 
  include 'service.php';
?>

<?php 
  include 'footer.php';
?>


</body>

</html>