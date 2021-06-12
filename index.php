<?php
	session_start();
	include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hotel Castlevania</title>
	<link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@300;400&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		
		<header class="header">
			<div class="hero">
				<h2 class="heading">Hotel UZ</h2>
				<p>Selamat Datang!!!</p>
			</div>
			<div class="features feature-1">
				<h4 class="price">IDR 250k</h4>
				<p class="item">Kamar Graduate</p>
			</div>
			<div class="features feature-2">
				<h4 class="price">IDR 250k</h4>
				<p class="item">Kamar Private</p>
			</div>
		</header>

		<nav class="menu">
			<div class="menu-toggle">
				<input type="checkbox" name="">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<div class="brand">
				<h1>Hotel U ~ Z</h1>
			</div>
			<ul class="menu-list">
				<li><a href="?page=dashboard">Dashboard</a></li>
				<li><a href="">Kamar</a>
					<ul id="tampil_menu_kamar">
						
					</ul>
				</li>
				<li><a href="">Booking</a>
					<ul>
						<li><a href="?page=booking">Booking Kamar</a></li>
						<?php if (isset($_SESSION['tamu'])) : ?>
							<li><a href="?page=logout">Logout</a></li>
						<?php else : ?>	
							<li><a href="?page=login">Login</a></li>
							<li><a href="?page=register">Register</a></li>
						<?php endif ?>
					</ul>
				</li>
				<li><a href="?page=contact">Contact Person</a></li>
			</ul>
		</nav>

		<?php require 'mod/halaman.php'; ?>

	</div>

	<footer class="footer">&copy; Copyright 2019 - 2020. Design By <b>Kelompok 5</b></footer>
	<script>
		const menuToogle = document.querySelector('.menu-toggle input');
		const nav = document.querySelector('nav ul');

		menuToogle.addEventListener('click', function () {
			nav.classList.toggle('slide');
		});
	</script>
	<script type="text/javascript">
		function tampil_tipe_kamar() {
			let xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					let data = JSON.parse(xhttp.responseText);
					data.forEach(function(element) {
						document.getElementById("tampil_menu_kamar").innerHTML += '<li><a href="?page=pilih_kamar&id_tipe_kamar='+element.id_tipe+'">'+element.tipe_kamar+'</a></li>';
					});
				}
			};
			xhttp.open("GET", "http://localhost/REPO-TUBES-PW/admin/page/tipe_kamar/ajax.php?request=1", true);
			xhttp.send();
		}

		tampil_tipe_kamar();

		let counter = 1;
		setInterval(function(){
			document.getElementById('radio' + counter).checked = true;
			counter++;
			if (counter > 4){
				counter = 1;
			}
		}, 5000);
	</script>
</body>
</html>