<div class="header">
	<span class="icon"><i class="fa fa-map"></i></span>
	<span class="title">Kamar</span>
</div>
<br>

<div class="details">
	<div class="recentOrders">
		<div class="cardHeader">
			<h2 id="label_tambah"><i class="fa fa-plus"></i> Tambah Data</h2>
			<h2 id="label_update" hidden><i class="fa fa-edit"></i> Edit Data</h2>
		</div>
		<br>
		<hr>
		<br>
		<div class="form-group">
			<label for="no_kamar"> No. Kamar </label>
			<input type="text" id="no_kamar" class="form-control" placeholder="Masukkan No. Kamar" autocomplete="off">
		</div>
		<div class="form-group">
			<label for="tipe_kamar"> Tipe Kamar </label>
			<select class="form-control" id="id_tipe">
				<option value="">- Pilih -</option>
			</select>
		</div>
		<div class="form-group">
			<label for="status"> Status </label>
			<input type="text" id="status" class="form-control" placeholder="Status" autocomplete="off">
		</div>
		<div class="form-group">
			<label for="lantai"> Lantai </label>
			<input type="number" id="lantai" class="form-control" placeholder="0" autocomplete="off" min="1">
		</div>
		<div class="form-group">
			<button onclick="insert()" id="btn" class="btn-primary">
				<i class="fa fa-plus"></i> Tambah
			</button>
			<button id="btn_update" onclick="update()" class="btn-primary" hidden>
				<i class="fa fa-save"></i> Simpan
			</button>
		</div>
	</div>
</div>

<div class="details">
	<div class="recentOrders">
		<div class="cardHeader">
			<h2>Data Kamar</h2>
		</div>
		<table id="data">
			<thead>
				<tr>
					<td>No.</td>
					<td>No. Kamar</td>
					<td>Tipe Kamar</td>
					<td>Status</td>
					<td>Lantai</td>
					<td>Aksi</td>
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

		xhttp.open("GET", "http://localhost/REPO-TUBES-PW/admin/page/kamar/ajax.php?request=1", true);

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
						let no_kamar = NewRow.insertCell(1);
						let tipe_kamar = NewRow.insertCell(2);
						let status = NewRow.insertCell(3);
						let lantai = NewRow.insertCell(4);
						let aksi_cell = NewRow.insertCell(5);

						no.innerHTML = val['nomer'];
						no_kamar.innerHTML = val['no_kamar'];
						tipe_kamar.innerHTML = val['tipe_kamar'];
						status.innerHTML = val['status'];
						lantai.innerHTML = val['lantai'];
						aksi_cell.innerHTML = '<button class="btn-warning" style="text-decoration: none;" onclick="edit('+ val['no_kamar'] +')" id="btn_edit"><i class="fa fa-edit"></i> Edit</button>  <button class="btn-danger" onclick="hapus('+ val['no_kamar'] +')"><i class="fa fa-trash-o"></i> Hapus</button>';
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
						alert("Data Berhasil di Tambahkan");


						loadKamar();

						document.getElementById("no_kamar").value = '';
						document.getElementById("id_tipe").value = '';
						document.getElementById("status").value = '';
						document.getElementById("lantai").value = '';
					} else {
						alert("Data Gagal di Tambahkan");
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
						alert("Data Berhasil di Hapus");

						loadKamar();
					} else {
						alert("Data Gagal di Hapus");

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
		let label_tambah = document.getElementById("label_tambah");
		let label_update = document.getElementById('label_update');
		let btn = document.getElementById('btn');
		let btn_edit = document.getElementById('btn_edit');
		let btn_update = document.getElementById('btn_update');

		label_tambah.hidden = true;
		label_update.hidden = false;
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
		let label_tambah = document.getElementById("label_tambah");
		let label_update = document.getElementById('label_update');
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
						alert("Data Berhasil di Ubah");

						loadKamar();

						document.getElementById("no_kamar").value = '';
						document.getElementById("id_tipe").value = '';
						document.getElementById("status").value = '';
						document.getElementById("lantai").value = '';

						label_tambah.hidden = false;
						label_update.hidden = true;
						btn.hidden = false;
						btn_update.hidden = true;
					} else {
						alert("Data Gagal di Ubah");
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