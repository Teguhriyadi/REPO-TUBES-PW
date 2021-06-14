<div class="header">
	<span class="icon"><i class="fa fa-money"></i></span>
	<span class="title">Transaksi</span>
</div>
<br>

<div class="details">
	<div class="recentOrders">
		<div class="cardHeader">
			<h2>Data Transaksi</h2>
		</div>
		<table id="data">
			<thead>
				<tr>
					<td>No.</td>
					<td>No. Identitas</td>
					<td>Email Tamu</td>
					<td>Check In</td>
					<td>Check Out</td>
				</tr>
			</thead>
			<tbody id="table">
				
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">

	function loadTamu() {

		let xhttp = new XMLHttpRequest();

		xhttp.open("GET", "http://localhost/REPO-TUBES-PW/admin/page/transaksi/ajax.php?request=1", true);

		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		xhttp.onreadystatechange = function() {

			if (this.readyState == 4 && this.status == 200) {
				
				let response = JSON.parse(this.responseText);

				let empTable = document.getElementById("data").getElementsByTagName("tbody")[0];

				empTable.innerHTML = "";

				for (let key in response) {
					if (response.hasOwnProperty(key)) {

						let val = response[key];

						let NewRow = empTable.insertRow(-1);
						let no = NewRow.insertCell(0);
						let kode_reservasi = NewRow.insertCell(1);
						let email_tamu = NewRow.insertCell(2);
						let check_in = NewRow.insertCell(3);
						let check_out = NewRow.insertCell(4);

						no.innerHTML = val['no'];
						kode_reservasi.innerHTML = val['kode_reservasi'];
						email_tamu.innerHTML = val['email_tamu'];
						check_in.innerHTML = val['check_in'];
						check_out.innerHTML = val['check_out'];
					}
				}
			}

		};

		xhttp.send();
	}

	loadTamu();
</script>