<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<link rel=" shortcut icon" href="assets/img/favicon.png">

	<title>SITULEN</title>

	<!-- Bootstrap core CSS -->
	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!--

TemplateMo 570 Chain App Dev

https://templatemo.com/tm-570-chain-app-dev

-->

	<!-- Additional CSS Files -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/templatemo-chain-app-dev.css">
	<link rel="stylesheet" href="assets/css/animated.css">
	<link rel="stylesheet" href="assets/css/owl.css">

</head>

<body>

	<!-- ***** Preloader Start ***** -->
	<div id="js-preloader" class="js-preloader">
		<div class="preloader-inner">
			<span class="dot"></span>
			<div class="dots">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- ***** Preloader End ***** -->

	<!-- ***** Header Area Start ***** -->
	<header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav class="main-nav">
						<!-- ***** Logo End ***** -->
						<!-- ***** Menu Start ***** -->
						<ul class="nav">
							<li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
							<li class="scroll-to-section"><a href="#services">Services</a></li>
							<li class="scroll-to-section"><a href="#about">About</a></li>
							<li>
								<div class="gradient-button"><a id="login" href="<?= base_url('auth') ?>"><i class="fa fa-sign-in-alt"></i> Sign In </a></div>
							</li>
						</ul>
						<a class='menu-trigger'>
							<span>Menu</span>
						</a>
						<!-- ***** Menu End ***** -->
					</nav>
				</div>
			</div>
		</div>
	</header>
	<!-- ***** Header Area End ***** -->



	<div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 align-self-center">
							<div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
								<div class="row">
									<div class="col-lg-12">
										<h2>SITULEN</h2>
										<p>Website ini merupakan Sistem Informasi Tata Usaha Online guna membantu pengurusan tata usaha</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
								<img style="border-radius: 50%;" src="assets/images/favicon.png" alt="situlen-logo">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="services" class="services section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
						<h4><em>Fungsi Yang Tersedia</em></h4>
						<img src="assets/images/heading-line-dec.png" alt="">
						<p>Situlen menyediakan fungsi yang dapat digunakan meliputi</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="service-item first-service">
						<div class="icon"></div>
						<h4>Dashboard Admin</h4>
						<p>Admin dapat melihat jumlah surat yang diproses, diterima dan ditolak serta melihat statistik surat</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="service-item second-service">
						<div class="icon"></div>
						<h4>Request Surat</h4>
						<p>Pengguna dapat melakukan request surat berupa surat Izin , surat Dispen dan surat Sakit</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="service-item third-service">
						<div class="icon text-light"></div>
						<h4>Download File</h4>
						<p>Pengguna dapat mendownload file surat yang diterima dari admin</p>

					</div>
				</div>

			</div>
		</div>
	</div>

	<div id="about" class="about-us section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
						<h4><em>How to Use</em></h4>
						<img src="assets/images/heading-line-dec.png" alt="">
						<p>Cara menggunakan situlen sebagai berikut</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="service-item first-service">
						<p>1. Admin membuat akun untuk para siswa</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="service-item second-service">
						<p>2. Siswa menerima username dan password</p>
					</div>
				</div>
				<div class="col-lg-4 ">
					<div class="service-item third-service">
						<p>3. Siswa login dan mengajukan surat</p>
					</div>
				</div>
				<div class="col-lg-4 mt-5 ">
					<div class="service-item fourth-service">
						<p>4. Admin memproses surat yang diajukan siswa</p>
					</div>
				</div>
				<div class="col-lg-4 mt-5">
					<div class="service-item fifth-service">
						<p>5. Jika surat diterima, siswa mendownload file surat yang diberikan admin</p>
					</div>
				</div>
				<div class="col-lg-4 mt-5">
					<div class="service-item sixth-service">
						<p>6. Jika surat ditolak, siswa merevisi surat yang diajukan </p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer id="newsletter">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="copyright-text">
						<p>Copyright © 2022 SITULEN
							<br>Design: <a href="https://templatemo.com/" target="_blank" title="css templates">TemplateMo</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</footer>


	<!-- Scripts -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/owl-carousel.js"></script>
	<script src="assets/js/animation.js"></script>
	<script src="assets/js/imagesloaded.js"></script>
	<script src="assets/js/popup.js"></script>
	<script src="assets/js/custom.js"></script>
</body>

</html>