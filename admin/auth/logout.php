<?php
	//session_start();
	if (!isset($_SESSION['login'])) {
		echo "<script>alert('Login Dahulu');</script>";
		echo "<script>window.location.replace('login.php');</script>";
	}

	$username = $_SESSION['username'];

	date_default_timezone_set('Asia/Jakarta');
	$dateTime = date("Y-m-d h:i:s");
	$query = $con->query("UPDATE users SET last_login = '$dateTime' WHERE username = '$username' ");	

	unset($_SESSION['login']);

	echo "<script>alert('Berhasil Logout');</script>";
	echo "<script>window.location.replace('auth/login.php');</script>";
?>