<div class="header">
	<span class="icon"><i class="fa fa-edit"></i></span>
	<span class="title">Reservasi</span>
</div>
<br>

<div class="details">
	<div class="recentOrders">
		<div class="cardHeader">
			<h2>Data Reservasi</h2>
		</div>
		<table id="data">
			<thead>
				<tr>
					<td>No.</td>
					<td>Kode Reservasi</td>
					<td>Email Tamu</td>
					<td>Check In</td>
					<td>Check Out</td>
					<td>Status</td>
				</tr>
			</thead>
			<tbody id="table">
				
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">

	function loadReservasi() {

		let xhttp = new XMLHttpRequest();

		xhttp.open("GET", "http://localhost/REPO-TUBES-PW/admin/page/reservasi/ajax.php?request=1", true);

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
						let status = NewRow.insertCell(5);

						no.innerHTML = val['no'];
						kode_reservasi.innerHTML = val['kode_reservasi'];
						email_tamu.innerHTML = val['email_tamu'];
						check_in.innerHTML = val['check_in'];
						check_out.innerHTML = val['check_out'];
						status.innerHTML = val['status'];
					}
				}
			}

		};

		xhttp.send();
	}

	loadReservasi();
</script>