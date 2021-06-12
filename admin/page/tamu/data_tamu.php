<div class="header">
	<span class="icon"><i class="fa fa-user"></i></span>
	<span class="title">Tamu</span>
</div>
<br>

<div class="details">
	<div class="recentOrders">
		<div class="cardHeader">
			<h2>Data Tamu</h2>
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

	function loadKamar() {

		let xhttp = new XMLHttpRequest();

		xhttp.open("GET", "http://localhost/REPO-TUBES-PW/admin/page/tamu/ajax.php?request=1", true);

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

						no.innerHTML = val['nomer'];
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

	function tampil_tipe_kamar() {
		let xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				let data = JSON.parse(xhttp.responseText);
				data.forEach(function(element) {
					document.getElementById("id_tipe").innerHTML += "<option value="+element.id_tipe+">"+element.tipe_kamar+"</option>";
				});
			}
		};
		xhttp.open("GET", "http://localhost/REPO-TUBES-PW/admin/page/tipe_kamar/ajax.php?request=1", true);
		xhttp.send();
	}

	tampil_tipe_kamar();

	function insert() {

		let no_kamar = document.getElementById('no_kamar').value;
		let id_tipe = document.getElementById('id_tipe').value;
		let status = document.getElementById('status').value;
		let lantai = document.getElementById('lantai').value;

		if( no_kamar != '' && id_tipe !='' && status != '' && lantai != ''){

			let data = { no_kamar : no_kamar, id_tipe : id_tipe, status : status, lantai : lantai};
			let xhttp = new XMLHttpRequest();
	
			xhttp.open("POST", "http://localhost/REPO-TUBES-PW/admin/page/kamar/ajax.php?request=2", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Insert successfully.");


						loadKamar();

						document.getElementById("no_kamar").value = '';
						document.getElementById("id_tipe").value = '';
						document.getElementById("status").value = '';
						document.getElementById("lantai").value = '';
					}
				}
			};

			xhttp.setRequestHeader("Content-Type", "application/json");
			xhttp.send(JSON.stringify(data));
		}
	}

	function hapus(no_kamar) {
		let xhttp = new XMLHttpRequest();
		let konfirmasi = confirm("Yakin ? Mau di Hapus ?");

		if (konfirmasi) {
			xhttp.open("GET", "http://localhost/REPO-TUBES-PW/admin/page/kamar/ajax.php?request=3&no_kamar="+no_kamar, true);

			xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Delete successfully.");

						loadKamar();
					}

				}
			};

			xhttp.send();

		}
	}

	function edit(no_kamar) {
		let id_tipe = document.getElementById('id_tipe');
		let status = document.getElementById('status');
		let lantai = document.getElementById('lantai');
		let btn = document.getElementById('btn');
		let btn_edit = document.getElementById('btn_edit');
		let btn_update = document.getElementById('btn_update');

		btn.hidden = true;
		btn_update.hidden = false;

		let xhttp = new XMLHttpRequest();
		xhttp.open("GET", "http://localhost/REPO-TUBES-PW/admin/page/kamar/ajax.php?request=4&no_kamar="+no_kamar, true);

		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {

				let response = JSON.parse(this.responseText);

				for (let key in response) {
					if (response.hasOwnProperty(key)) {
						let val = response[key];

						no_kamar.value = val['no_kamar'];
						id_tipe.value = val['id_tipe'];
						status.value = val['status'];
						lantai.value = val['lantai']; 
						document.getElementById("no_kamar").value = val['no_kamar'];

					}
				} 

			}
		};

		xhttp.send();
	}

	function update() {

		let no_kamar = document.getElementById('no_kamar').value;
		let id_tipe = document.getElementById('id_tipe').value;
		let status = document.getElementById('status').value;
		let lantai = document.getElementById('lantai').value;
		let btn_edit = document.getElementById('btn_edit');
		let btn_update = document.getElementById('btn_update');

		if(no_kamar != '' && id_tipe !='' && status != '' && lantai != ''){

			let data = { no_kamar : no_kamar, id_tipe : id_tipe, status : status, lantai : lantai };

			let xhttp = new XMLHttpRequest();

			xhttp.open("POST", "http://localhost/REPO-TUBES-PW/admin/page/kamar/ajax.php?request=5", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Update successfully.");

						loadKamar();

						document.getElementById("no_kamar").value = '';
						document.getElementById("id_tipe").value = '';
						document.getElementById("status").value = '';
						document.getElementById("lantai").value = '';

						btn.hidden = false;
						btn_update.hidden = true;
					}
				}
			};

			xhttp.setRequestHeader("Content-Type", "application/json");

			xhttp.send(JSON.stringify(data));
		} else {
			alert('Data Tidak Boleh Kosong');
		}
	}

	loadKamar();
</script>