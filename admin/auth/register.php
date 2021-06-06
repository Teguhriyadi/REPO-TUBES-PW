<?php 
session_start();

if (isset($_SESSION['login'])) {
	echo "<script>alert('Logout Dahulu');</script>";
	echo "<script>window.location.replace('../?page=dashboard');</script>";
}

include '../../config/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" href="style.css" media="screen" title="no title">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>
	<div class="register">
		<div class="avatar">
			<i class="fa fa-user"></i>
		</div>

		<h2>Register Form</h2>

		<div class="box-register">
			<i class="fas fa-envelope-open-text"></i>
			<input type="text" placeholder="Username" id="username" name="username" autocomplete="off">
		</div>

		<div class="box-register">
			<i class="fas fa-lock"></i>
			<input type="password" placeholder="Confirm Password" id="password" name="password"  autocomplete="off">
		</div>

		<div class="box-register">
			<i class="fas fa-lock"></i>
			<input type="password" placeholder="Password" id="confirm_password" name="password"  autocomplete="off">
		</div>

		<div class="box-register">
			<i class="fas fa-envelope-open"></i>
			<select id="level" name="level" style="width: 200px;">
				<option value="">- Pilih -</option>
				<option value="1"> Admin </option>
				<option value="2"> Petugas </option>
			</select>
		</div>

		<input type="button" id="btn" value="Simpan" onclick="insertRegister();">

		<div style="text-align: center;">
			<a href="login.php" style="text-decoration: none; color: blue;">
				Sudah Punya Akun ?
			</a>
		</div>
	</div>

	<script type="text/javascript">
		function insertRegister() {

			let username = document.getElementById('username').value;
			let password = document.getElementById('password').value;
			let level = document.getElementById('level').value;
			let confirm_password = document.getElementById('confirm_password').value;

			if(username != '' && password !='' && level != '' && confirm_password != ''){

				if (confirm_password != password) {
					alert('Konfirmasi Tidak Sesuai');

					document.getElementById("username").value = '';
					document.getElementById("password").value = '';
					document.getElementById("level").value = '';
					document.getElementById("confirm_password").value = '';

					window.location("register.php");

				}

				let data = { username : username, password : password, level : level, confirm_password : confirm_password };
				let xhttp = new XMLHttpRequest();

				xhttp.open("POST", "ajax.php", true);


				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {

						let response = this.responseText;
						if(response == 1){
							alert("Data Berhasil di Tambahkan.");

							document.getElementById("username").value = '';
							document.getElementById("password").value = '';
							document.getElementById("level").value = '';
							document.getElementById('confirm_password').value = '';
						}
					}
				};

				xhttp.setRequestHeader("Content-Type", "application/json");
				xhttp.send(JSON.stringify(data));
			} else {
				alert('Tidak Boleh Kosong');
			}
		}
	</script>

</body>
</html>