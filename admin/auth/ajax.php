<?php
	
	include '../../config/koneksi.php';

	$data = json_decode(file_get_contents("php://input"));

	$username = $data->username;
	$password = $data->password;
	$confirm_password = $data->confirm_password;
	$level = $data->level;

	$result = $con->query("SELECT username FROM users WHERE username = '$username' ");

	if (mysqli_fetch_assoc($result) > 0) {
		echo 0;
	}

	if ($password !== $confirm_password) {
		echo "<script>alert('Konfirmasi Password Tidak Sesuai');</script>";
		echo "<script>window.location.replace('register.php');</script>";
	}

	$password = password_hash($password, PASSWORD_DEFAULT);
   // Insert record
	$sql = "insert into users (id_users, username, password, level) values ('', '$username', '$password', '$level')";
	if(mysqli_query($con,$sql)){
		echo 1; 
	}else{
		echo 0;
	}

	exit;

?>