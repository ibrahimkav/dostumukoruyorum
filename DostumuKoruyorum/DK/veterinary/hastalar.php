<?php 
	include "header2.php";
?>
								<h1 style="text-align:left;    margin-left: -90px;" >Hastalar</h1>
							</div>	
						<table>
							<tr>
								<a href="veterinary/hastakayit.php" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
									<span class="svg-icon svg-icon-3">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>
											<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
										</svg>
									</span>Yeni Kayıt
								</a>

						
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
								<a href="veterinary/hastalar.php" class="d-flex align-items-center">
									<img alt="Logo" src="veterinary/assets/media/logos/yeni.png" class="h-20px" />
								</a>
							</div>
						
						</div>
					</div>
						<div class="container-xxl" id="kt_content_container">
								<div class="row g-6 g-xl-9">
					
						
								<?php 
								   
								   $data = [
									"id" => $_SESSION["veterinaryId"],
								];
								
								$statement = $db->prepare(
									"SELECT * FROM patients WHERE veterinaryId = :id"
								);
								
								foreach ($data as $key => $value) {
									$statement->bindValue(":" . $key, $value);
								}
								
								$statement->execute();
								
								$result = $statement->fetchAll(PDO::FETCH_ASSOC);
								
								foreach ($result as $row) {


                                    $id = $row["id"];
                                    $durum = $row["durum"];
                                    $hayvanadi = $row["hayvanadi"];
                                    $kayit_baslangic = $row["kayit_baslangic"];
                                
                                   echo "<div class='col-md-6 col-xl-3'>";
								   echo "<a href='/veterinary/hastakayit_duzenleme.php?id=$id' class='card border border-2 border-gray-300 border-hover'>";
								   echo "<div class='card-header border-0 pt-9'>";	
                                   echo "<div class='card-toolbar'>";
								   if($durum == 1){
									echo "<span class='badge badge-light-success fw-bolder me-auto px-4 py-3'>Aktif</span>";
								   }
								   else if($durum == 2){
									echo "<span class='badge badge-light-primary fw-bolder me-auto px-4 py-3'>Pasif</span>";
								   }
								   else{
								   echo "<span class='badge badge-light fw-bolder me-auto px-4 py-3'>Kayıt Kapandı</span>";
								   }
								   echo "</div>";
								   echo "</div>";
								   echo "<div class='card-body p-9'>";
								   echo "<div class='fs-3 fw-bolder text-dark'>$hayvanadi</div>";
								   echo "<div class='d-flex flex-wrap mb-5'>";
								   echo "<div class='border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3'>";
								   echo "<div class='fs-6 text-gray-800 fw-bolder'>$kayit_baslangic</div>";
								   echo "<div class='fw-bold text-gray-400'>Kayıt Başlangıç</div>";
								   echo "</div>";
								   echo "</div>";
								   echo "</div>";
								   echo "</a>";
								   echo "</div>";

								} ?>
						
					
							
												
							
							
							</div>
								
										</div>
									</div>
								</div>
							</div>
						</div>





					</div>
					<br><br>
				</div>
			</div>


		

		<?php
		include "footer2.php";
		?>