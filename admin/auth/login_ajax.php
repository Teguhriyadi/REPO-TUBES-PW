<?php
	session_start();
	include '../../config/koneksi.php';
	
	$data = json_decode(file_get_contents("php://input"));

	$username = $data->username;
	$password = $data->password;

	$sql = $con->query("SELECT * FROM users WHERE username = '$username'");

	if (mysqli_num_rows($sql)  === 1) {
		$array = mysqli_fetch_assoc($sql);

		if (password_verify($password, $array['password'])) {
			$_SESSION['login'] = true;
			$_SESSION['username'] = $array['username'];
			echo 1;
		} else {
			echo 0;
		}
	} else {
		echo 0;
	}

?>