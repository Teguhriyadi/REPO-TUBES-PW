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
					<td>Nama Tamu</td>
					<td>Email Tamu</td>
					<td>Telp Tamu</td>
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
						let no_identitas = NewRow.insertCell(1);
						let nama_tamu = NewRow.insertCell(2);
						let email_tamu = NewRow.insertCell(3);
						let telp_tamu = NewRow.insertCell(4);

						no.innerHTML = val['no'];
						no_identitas.innerHTML = val['no_identitas'];
						nama_tamu.innerHTML = val['nama_tamu'];
						email_tamu.innerHTML = val['email_tamu'];
						telp_tamu.innerHTML = val['telp_tamu'];
					}
				}
			}

		};

		xhttp.send();
	}

	loadTamu();
</script>