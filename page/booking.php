<?php
if (!isset($_SESSION['tamu'])) {
	echo "<script>alert('Maaf, Anda Harus Login dahulu');</script>";
	echo "<script>window.location.replace('?page=login');</script>";
}

$id_tipe = $_GET['id_tipe'];
?>

<section class="services">
	<div class="service">
		<table>
			<tr>
				<td>
					<label> Email Tamu </label>
				</td>
				<td>:</td>
				<td>
					<input type="text" id="email_tamu" value="<?php echo $_SESSION['email_tamu'] ?>" readonly>
				</td>
			</tr>
			<tr>
				<td><label> Tanggl Check In </label></td>
				<td>:</td>
				<td>
					<input type="date" id="check_in">
				</td>
			</tr>
			<tr>
				<td><label> Tanggal Check Out </label></td>
				<td>:</td>
				<td>
					<input type="date" id="check_out">
				</td>
			</tr>
			<tr>
				<td> <label> Jumlah Tamu </label> </td>
				<td>:</td>
				<td>
					<input type="number" id="jumlah_tamu" placeholder="0">
				</td>
			</tr>
			<tr>
				<td> <label> Pesan</label> </td>
				<td>:</td>
				<td>
					<textarea id="pesan"></textarea>
				</td>
			</tr>
			<tr>
				<td> <label> ID Tipe </label> </td>
				<td>:</td>
				<td>
					<input type="text" id="id_tipe" value="<?php echo $id_tipe ?>">
				</td>
			</tr>
			<tr>
				<td> <label> No. Kamar </label> </td>
				<td>:</td>
				<td>
					<input type="no_kamar" id="no_kamar">
				</td>
			</tr>
			<tr>
				<td>
					<button id="btn" onclick="booking()">
						Booking
					</button>
				</td>
			</tr>
		</table>
	</div>
	
</section>

<script type="text/javascript">
	
	function booking() {
		let email_tamu = document.getElementById("email_tamu").value;
		let check_in = document.getElementById("check_in").value;
		let check_out = document.getElementById("check_out").value;
		let jumlah_tamu = document.getElementById("jumlah_tamu").value;
		let pesan = document.getElementById("pesan").value;
		let id_tipe = document.getElementById("id_tipe").value;
		let no_kamar = document.getElementById("no_kamar").value;

		if( email_tamu != '' && check_in !='' && check_out != ''){

			let data = { email_tamu : email_tamu, check_in : check_in, check_out : check_out, jumlah_tamu : jumlah_tamu, pesan : pesan, id_tipe : id_tipe, no_kamar : no_kamar };
			let xhttp = new XMLHttpRequest();

			xhttp.open("POST", "http://localhost/REPO-TUBES-PW/page/ajax.php?request=6", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Insert successfully.");
					}
				}
			};

			xhttp.setRequestHeader("Content-Type", "application/json");
			xhttp.send(JSON.stringify(data));
		}
	}

</script>