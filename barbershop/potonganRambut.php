<?php 
include 'dashboard/functions.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<title>Potongan Rambut</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="dashboard/css/owl.carousel.min.css">
    <link rel="stylesheet" href="dashboard/css/owl.theme.default.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
		<link rel="stylesheet" href="dashboard/css/style.css">
		<link rel="stylesheet" href="stylez.css">
  </head>
 
  <body>
  	<div class="contain">
		<div class="header">
            <img src="xsz.png" class="logo">
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="">Potongan Rambut</a></li>
                    <li><a href="layananExtra.php">Layanan Extra</a></li>
                    <?php if(!isset($_SESSION['username']) ){ ?>
                        <li><a class="btns btn-primary btn-sm" href="login.php">LOGIN</a></li>
                    <?php } else { ?>
                        <li><a class="btns btn-primary btn-sm" href="logout.php">LOGOUT</a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
		<section class="ftco-section">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<h2 class="heading-section mb-5 pb-md-4">Daftar Potongan Rambut</h2>
					</div>
					<div class="col-md-12">
						<div class="featured-carousel owl-carousel">
							<div class="item">
								<div class="work">
									<div class="img d-flex align-items-center justify-content-center rounded" style="background-image: url(dashboard/img/63b53b00b6a57.jpeg);">
									</div>
									<div class="text pt-3 w-100 text-center">
										<h3><a href="#">Mullet</a></h3>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="work">
									<div class="img d-flex align-items-center justify-content-center rounded" style="background-image: url(dashboard/img/63bd949dee8e9.jpg);">
									</div>
									<div class="text pt-3 w-100 text-center">
										<h3><a href="#">Comma Hair</a></h3>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="work">
									<div class="img d-flex align-items-center justify-content-center rounded" style="background-image: url(dashboard/img/63bd96365beb8.jpg);">
									</div>
									<div class="text pt-3 w-100 text-center">
										<h3><a href="#">Two Block</a></h3>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="work">
									<div class="img d-flex align-items-center justify-content-center rounded" style="background-image: url(dashboard/img/63bd968cb07ed.jpg);">
									</div>
									<div class="text pt-3 w-100 text-center">
										<h3><a href="#">Cepmek</a></h3>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="work">
									<div class="img d-flex align-items-center justify-content-center rounded" style="background-image: url(dashboard/img/63bd96f548f60.jpg);">
									</div>
									<div class="text pt-3 w-100 text-center">
										<h3><a href="#">Undercut</a></h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		</div>

    <script src="dashboard/js/jquery.min.js"></script>
    <script src="dashboard/js/popper.js"></script>
    <script src="dashboard/js/bootstrap.min.js"></script>
    <script src="dashboard/js/owl.carousel.min.js"></script>
    <script src="dashboard/js/main.js"></script>
  </body>
</html>