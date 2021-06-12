<?php 
	session_start();

	if (isset($_SESSION['login'])) {
		echo "<script>alert('Silahkan Logout Dahulu');</script>";
		echo "<script>window.location.replace('../?page=dashboard');</script>";
	}

	include '../../config/koneksi.php';


?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="style.css" media="screen" title="no title">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>

	<div class="register">
		<div class="avatar">
			<i class="fa fa-user"></i>
		</div>

		<h2>Login Form</h2>

		<div class="box-register">
			<i class="fas fa-envelope-open-text"></i>
			<input type="text" placeholder="Username" id="username" name="username" autocomplete="off">
		</div>

		<div class="box-register">
			<i class="fas fa-lock"></i>
			<input type="password" placeholder="Password" id="password" name="password"  autocomplete="off">
		</div>

    <button id="btn">
      Login
    </button>

		<div style="text-align: center;">
			<a href="register.php" style="text-decoration: none; color: blue;">
				Belum Punya Akun ?
			</a>
		</div>
	</div>

	<script type="text/javascript">

    document.getElementById("btn").addEventListener("click", login);

		function login() {

		let username = document.getElementById('username').value;
		let password = document.getElementById('password').value;

		if(username != '' && password !=''){

			let data = { username : username, password : password};
			let xhttp = new XMLHttpRequest();
	
			xhttp.open("POST", "login_ajax.php", true);


			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Berhasil Login");
						window.location.replace("../?page=dashboard");
						//loadEmployees();
					} else {
						alert("Gagal Login");

						document.getElementById("username").value = "";
						document.getElementById("password").value = "";
					}
				}
			}

			xhttp.setRequestHeader("Content-Type", "application/json");
			xhttp.send(JSON.stringify(data));
		} else {
      		alert("Data Tidak Boleh Kosong");
    	}
	}
	</script>

</body>
</html>