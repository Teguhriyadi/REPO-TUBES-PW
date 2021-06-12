<section class="services">
	<div class="service">
		<div class="icon"><h1>Login</h1></div>
		<h3>Mohammad Ilham Teguhriyadi</h3>
		<br>
		<table>
			<tr>
				<td>Email Tamu</td>
				<td>:</td>
				<td>
					<input type="text" id="email_tamu">
				</td>
			</tr>
			<tr>
				<td>Password Tamu</td>
				<td>:</td>
				<td>
					<input type="password" id="password_tamu">
				</td>
			</tr>
			<tr>
				<td>
					<button onclick="login()">
						Login
					</button>
				</td>
			</tr>
		</table>
	</div>
</section>

<script type="text/javascript">
	function login() {
		let email_tamu = document.getElementById("email_tamu").value;
		let password_tamu = document.getElementById("password_tamu").value;

		if( email_tamu != '' && password_tamu !='' ){

			let data = { email_tamu : email_tamu, password_tamu : password_tamu };
			let xhttp = new XMLHttpRequest();

			xhttp.open("POST", "http://localhost/REPO-TUBES-PW/page/ajax.php?request=3", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Berhasil Login");
						window.location.replace("?page=booking");
						//loadEmployees();
					} else {
						alert("Gagal Login");

						document.getElementById("email_tamu").value = "";
						document.getElementById("password_tamu").value = "";
					}
				}
			}

			xhttp.setRequestHeader("Content-Type", "application/json");
			xhttp.send(JSON.stringify(data));
		}
	}
</script>