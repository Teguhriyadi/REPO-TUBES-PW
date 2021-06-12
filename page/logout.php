<?php
	if (!isset($_SESSION['tamu'])) {
		echo "<script>alert('Maaf, Anda harus Login dahulu');</script>";
		echo "<script>window.location.replace('?page=login');</script>";
	}

	unset($_SESSION['tamu']);

	echo "<script>alert('Berhasil Logout');</script>";
	echo "<script>window.location.replace('?page=login');</script>";
?>