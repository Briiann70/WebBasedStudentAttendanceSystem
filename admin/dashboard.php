<?php 
$key = mysqli_query($conn,'SELECT count(*) as user from user');
$b = mysqli_fetch_array($key);
?>

<?php 
$courseQuery = mysqli_query($conn,'SELECT count(*) as course from course');
$courseCount = mysqli_fetch_array($courseQuery);
?>

<?php 
$roomQuery = mysqli_query($conn,'SELECT count(*) as ruangan from ruangan');
$roomCount = mysqli_fetch_array($roomQuery);
?>

<div class="main-panel">
	<div class="content" style="background-position:center">
		<div class="page-inner">
			<div class="row">
				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-round">
						<div class="card-body ">
							<div class="row align-items-center">
								<div class="col-icon">
									<div class="icon-big text-center icon-primary bubble-shadow-small">
										<i class="fas fa-chart-bar"></i>
									</div>
								</div>
								<div class="col col-stats ml-3 ml-sm-0">
									<div class="numbers">
										<p class="card-category">Data User</p>
										<h4 class="card-title"><?php echo $b['user'] ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-round">
						<div class="card-body ">
							<div class="row align-items-center">
								<div class="col-icon">
									<div class="icon-big text-center icon-primary bubble-shadow-small">
										<i class="fas fa-book"></i>
									</div>
								</div>
								<div class="col col-stats ml-3 ml-sm-0">
									<div class="numbers">
										<p class="card-category">Jumlah Mata Kuliah</p>
										<h4 class="card-title"><?php echo $courseCount['course'] ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-round">
						<div class="card-body ">
							<div class="row align-items-center">
								<div class="col-icon">
									<div class="icon-big text-center icon-primary bubble-shadow-small">
										<i class="fas fa-building"></i>
									</div>
								</div>
								<div class="col col-stats ml-3 ml-sm-0">
									<div class="numbers">
										<p class="card-category">Jumlah Ruangan</p>
										<h4 class="card-title"><?php echo $roomCount['ruangan'] ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <center><h6><b>&copy; Copyright@2021| WPPL Institut DEL</b></h6></center> -->
</div>
