<?php
	if (!isset($_SESSION['tamu'])) {
		echo "<script>alert('Maaf, Anda Harus Login dahulu');</script>";
		echo "<script>window.location.replace('?page=login');</script>";
	}
?>

booking	