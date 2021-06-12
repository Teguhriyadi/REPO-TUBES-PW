<section class="services">
	<div class="service">
		<div class="icon"><h1>Register</h1></div>
		<h3>Dimas Rahmat Aulia</h3>
		<br>
		<table>
			<tr>
				<td>No. Identitas</td>
				<td>:</td>
				<td>
					<input type="text" id="no_identitas">
				</td>
			</tr>
			<tr>
				<td>Nama Tamu</td>
				<td>:</td>
				<td>
					<input type="text" id="nama_tamu">
				</td>
			</tr>
			<tr>
				<td>Email Tamu</td>
				<td>:</td>
				<td>
					<input type="text" id="email_tamu">
				</td>
			</tr>
			<tr>
				<td>Telp Tamu</td>
				<td>:</td>
				<td>
					<input type="text" id="telp_tamu">
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
					<button onclick="insert()">
						Insert
					</button>
				</td>
			</tr>
		</table>
	</div>
</section>

<script type="text/javascript">
	function insert() {
		let no_identitas = document.getElementById("no_identitas").value;
		let nama_tamu = document.getElementById("nama_tamu").value;
		let email_tamu = document.getElementById("email_tamu").value;
		let telp_tamu = document.getElementById("telp_tamu").value;
		let password_tamu = document.getElementById("password_tamu").value;

		if( no_identitas != '' && nama_tamu !='' && email_tamu != '' && telp_tamu != '' && password_tamu != ''){

			let data = { no_identitas : no_identitas, nama_tamu : nama_tamu, email_tamu : email_tamu, telp_tamu : telp_tamu, password_tamu : password_tamu };
			let xhttp = new XMLHttpRequest();

			xhttp.open("POST", "http://localhost/REPO-TUBES-PW/page/ajax.php?request=2", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Insert successfully.");

						document.getElementById("no_identitas").value = "";
						document.getElementById("nama_tamu").value = "";
						document.getElementById("email_tamu").value = "";
						document.getElementById("telp_tamu").value = "";
						document.getElementById("password_tamu").value = "";

						window.location.replace('?page=login');
					}
				}
			};

			xhttp.setRequestHeader("Content-Type", "application/json");
			xhttp.send(JSON.stringify(data));
		}
	}
</script>