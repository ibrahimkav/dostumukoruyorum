<?php
	include "header2.php";
	$data = [
		"X" => $_SESSION["vetX"],
		"xt" => $_SESSION["vetX"],
		"y" => $_SESSION["vetY"]
	];
	
	$statement = $db->prepare(
		"SELECT COUNT(0) AS yardim
		FROM yardim 
		WHERE (
			6371 * SQRT(
				POW(RADIANS(yardim.x) - RADIANS(:X), 2) +
				POW(RADIANS(yardim.y) - RADIANS(:y), 2) *
				COS(RADIANS(:xt))
			)
		) <= 5;"
	);
	
	foreach ($data as $key => $value) {
		$statement->bindValue(":" . $key, $value);
	}
	
	$statement->execute();
	
	$result = $statement->fetch(PDO::FETCH_ASSOC);
	$yardimCount = $result["yardim"];



	$data = [
		"id" => $_SESSION["veterinaryId"],
	];
	
	$statement = $db->prepare(
		"SELECT COUNT(0) AS hasta FROM patients WHERE veterinaryId = :id and durum = 1"
	);
	
	$statement->execute($data);
	$result = $statement->fetch();
	
	$hasta = $result["hasta"];

?>			
	   <h1 style="text-align:left;    margin-left: -90px;">Merhaba,   <?php echo $_SESSION["businessname"]; ?>
							</div>
							<div class="d-flex d-lg-none align-items-center ms-n2 me-2">
								<div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
									<span class="svg-icon svg-icon-1 mt-1">
									
									</span>
								</div>
								<a href="veterinary/raporlar.php" class="d-flex align-items-center">
									<img alt="Logo" src="veterinary/assets/media/logos/yeni.png" class="h-20px" />
								</a>
							</div>
				
						</div>
					</div>
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<div class="container-xxl" id="kt_content_container">
							<div class="row gy-5 g-xl-10">
								<div class="col-xl-3">
									<div class="card card-xl-stretch mb-xl-10" style="background-color: #356e5e">
										<div class="card-body d-flex flex-column">
											<div class="d-flex flex-column flex-grow-1">
												<a href="/veterinary/hastalar.php" class="text-dark text-hover-primary fw-bolder fs-3">Hastalar</a>
												<div class="mixed-widget-13-chart" style="height: 100px"></div>
											</div>
											<div class="pt-5">
												<span class="text-dark fw-bolder fs-3x me-2 lh-0"><?php echo $hasta; ?></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-3">
									<div class="card card-xxl-stretch mb-xl-10" style="background-color: #47947e">
										<div class="card-body d-flex flex-column">
											<div class="d-flex flex-column flex-grow-1">
												<a href="/veterinary/yardimlar.php" class="text-dark text-hover-primary fw-bolder fs-3">5 Km Civarı Aktif Yardım</a>
												<div class="mixed-widget-14-chart" style="height: 100px"></div>
											</div>
											<div class="pt-5">
												<span class="text-dark fw-bolder fs-3x me-2 lh-0"><?php echo $yardimCount;?></span>
											</div>
										</div>
									</div>
								</div>
						
							</div><br>
								<br>
				
							</div><br>
						
						<br>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
				</svg>
			</span>
		</div>

		<?php
		include "footer2.php";
		?>