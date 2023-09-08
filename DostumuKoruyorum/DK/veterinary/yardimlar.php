<?php
include "header2.php"; ?>
							<h1 style="text-align:left;    margin-left: -90px;">Yardımlar</h1>
						</div>
					<table>
						<tr>
					

							<td>															
							
							</td>
						</tr>	
				</div>							
			</div>
		</table>

							<div class="d-flex d-lg-none align-items-center ms-n2 me-2">
								<div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
									<span class="svg-icon svg-icon-1 mt-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
										</svg>
									</span>
								</div>
								<a href="veterinary/gelenkutusu.php" class="d-flex align-items-center">
									<img alt="Logo" src="veterinary/assets/media/logos/yeni.png" class="h-20px" />
								</a>
							</div>
						
						</div>
					</div>
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<div class="container-xxl" id="kt_content_container">
							<div class="d-flex flex-column flex-lg-row">
								<div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">


                                   <?php 
								   
								   $data = [
									"X" => $_SESSION["vetX"],
									"xt" => $_SESSION["vetX"],
									"y" => $_SESSION["vetY"]
								];
								
								$statement = $db->prepare(
									"SELECT *
									FROM yardim 
									WHERE (
										6371 * SQRT(
											POW(RADIANS(yardim.x) - RADIANS(:X), 2) +
											POW(RADIANS(yardim.y) - RADIANS(:y), 2) *
											COS(RADIANS(:xt))
										)
									) <= 5 ORDER BY id desc;"
								);
								
								foreach ($data as $key => $value) {
									$statement->bindValue(":" . $key, $value);
								}
								
								$statement->execute();
								
								$result = $statement->fetchAll(PDO::FETCH_ASSOC);
								
								foreach ($result as $row) {

                                    echo "<div class='card card-flush' style='margin-bottom:20px'>";
									echo "<div class='card-header pt-7' id='kt_chat_contacts_header'>";

                                    $id = $row["id"];
                                    $breed = $row["breed"];
                                    $address = $row["address"];
                                    $time = $row["time"];
                                    $directions = $row["directions"];
                                    $x = $row["x"];
                                    $y = $row["y"];
                                    $createdDate = $row["createDate"];

                                    echo "Hayvan: $breed  Saat: $time <br> <br>";
									echo "Açıklama : $directions <br> <br>";
									echo "Konum X : $x Konum Y: $y <br> <br>";
									echo "Adres : $address <br> <br>";
									echo "Oluşturulma Tarihi : $createdDate  Numara : $id <br> <br>";

									echo "</div>";
									echo "</div>";
									
								}
								 
								 
								 
								 ?>

								
								</div>
								<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
									
								</div>
							</div>
						</div><br><br>
					</div>

					<script src="veterinary/assets/plugins/global/plugins.bundle.js"></script>

					<?php include "footer2.php";
?>
