<?php
session_start();

if (!isset($_SESSION['login'])) {
	echo "<script>alert('Login Dahulu');</script>";
	echo "<script>window.location.replace('auth/login.php');</script>";
	exit;
}

include '../config/koneksi.php'; 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reservasi Hotel | <?php include 'mod/title.php'; ?></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/desain.css">
</head>
<body>

	<div class="container">
		<div class="navigation">
			<ul>
				<li>
					<a href="#">
						<span class="icon"><i class="fa fa-home"></i></span>
						<span class="title"><h2>Hotel</h2></span>
					</a>
				</li>
				<li>
					<a href="?page=dashboard">
						<span class="icon"><i class="fa fa-home"></i></span>
						<span class="title">Dashboard</span>
					</a>
				</li>
				<li>
					<a href="?page=tipe_kamar">
						<span class="icon"><i class="fa fa-bars"></i></span>
						<span class="title">Tipe Kamar</span>
					</a>
				</li>
				<li>
					<a href="?page=kamar">
						<span class="icon"><i class="fa fa-envelope-open"></i></span>
						<span class="title">Kamar</span>
					</a>
				</li>
				<li>
					<a href="?page=tamu">
						<span class="icon"><i class="fa fa-user"></i></span>
						<span class="title">Tamu</span>
					</a>
				</li>
				<li>
					<a href="#">
						<span class="icon"><i class="fa fa-pencil"></i></span>
						<span class="title">Transaksi</span>
					</a>
				</li>
				<li>
					<a href="?page=users">
						<span class="icon"><i class="fa fa-user"></i></span>
						<span class="title">Users</span>
					</a>
				</li>
				<li>
					<a onclick="return confirm('Yakin ? Mau Logout ?')" href="?page=logout">
						<span class="icon"><i class="fa fa-sign-in"></i></span>
						<span class="title">Log Out</span>
					</a>
				</li>
			</ul>
		</div>

		<div class="main">
			<div class="topbar">
				<div class="toggle" onclick="toggleMenu();"></div>
				<div class="search">
					<label>
						<input type="text" placeholder="Search here">
						<i class="fa fa-search"></i>
					</label>
				</div>
				<div class="user">
					<img src="img/gambar.png" alt="">
				</div>
			</div>

			<?php require 'mod/halaman.php' ?>

		</div>
	</div>

	<script>
		function toggleMenu() {
			let toggle = document.querySelector('.toggle');
			let navigation = document.querySelector('.navigation');
			let main = document.querySelector('.main');
			toggle.classList.toggle('active');
			navigation.classList.toggle('active');
			main.classList.toggle('active');
		}
	</script>

</body>
</html>