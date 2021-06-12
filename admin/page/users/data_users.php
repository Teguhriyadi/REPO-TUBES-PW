<div class="header">
	<span class="icon"><i class="fa fa-bars"></i></span>
	<span class="title">Tipe Kamar</span>
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
		<input type="hidden" id="id_tipe">
		<div class="form-group">
			<label for="username"> Username </label>
			<input type="text" class="form-control" id="username" placeholder="Masukkan Tipe Kamar" autocomplete="off">
		</div>
		<div class="form-group">
			<label for="password"> Password </label>
			<textarea class="form-control" id="password" placeholder="Masukkan Password" rows="5"></textarea>
		</div>
		<div class="form-group">
			<label for="level"> Level </label>
			<select class="form-control" id="level">
				<option value="">- Pilih -</option>
				<option value="1">Administrator</option>
				<option value="2">Petugas</option>
			</select>
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
			<h2>Data Tipe Kamar</h2>
			<a href="?page=tambah_tipe_kamar" class="btn"><i class="fa fa-plus"></i> Tambah Data</a>
		</div>
		<table id="data">
			<thead>
				<tr>
					<td>No.</td>
					<td>Username</td>
					<td>Created At</td>
					<td>Last Login</td>
					<td>Level</td>
					<td>Aksi</td>
				</tr>
			</thead>
			<tbody id="table">
				
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">

	function loadUsers() {

		let xhttp = new XMLHttpRequest();

		xhttp.open("GET", "http://localhost/REPO-TUBES-PW/admin/page/users/ajax.php?request=1", true);

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
						let username = NewRow.insertCell(1);
						let created_at = NewRow.insertCell(2);
						let last_login = NewRow.insertCell(3);
						let level = NewRow.insertCell(4);
						let aksi_cell = NewRow.insertCell(5);
						let session = "<?= $_SESSION['username'] ?>";

						no.innerHTML = val['no'];
						username.innerHTML = val['username'];
						created_at.innerHTML = session;
						last_login.innerHTML = val['last_login'];

						if (val['level'] == 1) {
							level.innerHTML = 'Administrator';
						} else if (val['level'] == 2) {
							level.innerHTML = 'Petugas';
						} else {
							level.innerHTML = 'Tidak Ada';
						}

						if (val['username'] == session) {
							aksi_cell.innerHTML = '<button class="btn-warning" style="text-decoration: none;" onclick="edit('+ val['id_tipe'] +')" id="btn_edit"><i class="fa fa-edit"></i> Edit</button>';
						} else {
							aksi_cell.innerHTML = '<button class="btn-warning" style="text-decoration: none;" onclick="edit('+ val['id_tipe'] +')" id="btn_edit"><i class="fa fa-edit"></i> Edit</button> <button class="btn-danger" onclick="hapus('+ val['id_users'] +')"><i class="fa fa-trash-o"></i> Hapus</button>';
						}
					}
				}
			}

		};

		xhttp.send();
	}

	function insert() {
		let files = document.getElementById("image").files;
		let tipe_kamar = document.getElementById("tipe_kamar").value;
		let deskripsi = document.getElementById("deskripsi").value;
		let fasilitas = document.getElementById("fasilitas").value;
		let harga = document.getElementById("harga").value;
		let jumlah_bed = document.getElementById("jumlah_bed").value;

		if (files.length > 0) {
			var formData = new FormData();

			formData.append("image", files[0]);
			formData.append("tipe_kamar", tipe_kamar);
			formData.append("deskripsi", deskripsi);
			formData.append("fasilitas", fasilitas);
			formData.append("harga", harga);
			formData.append("jumlah_bed", jumlah_bed);

			var xhttp = new XMLHttpRequest();

			xhttp.open("POST", "http://localhost/REPO-TUBES-PW/admin/page/tipe_kamar/ajax.php?request=2", true);

			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					var response = this.responseText;

					if (response == 1) {
						alert("Upload Sukses");

						loadUsers();

						document.getElementById("tipe_kamar").value = "";
						document.getElementById("deskripsi").value = "";
						document.getElementById("fasilitas").value = "";
						document.getElementById("harga").value = "";
						document.getElementById("jumlah_bed").value = "";
						document.getElementById("image").value = "";

					} else {
						alert("Upload Gagal");
					}
				}
			};

			xhttp.send(formData);
		} else {
			alert("Pilih Gambar");
		}
	}

	function hapus(id_users) {
		let xhttp = new XMLHttpRequest();
		let konfirmasi = confirm("Yakin ? Mau di Hapus ?");

		if (konfirmasi) {
			xhttp.open("GET", "http://localhost/REPO-TUBES-PW/admin/page/users/ajax.php?request=3&id_users="+id_users, true);

			xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Delete successfully.");

						loadUsers();
					}

				}
			};

			xhttp.send();

		}
	}

	function edit(id_tipe) {
		let tipe_kamar = document.getElementById('tipe_kamar');
		let deskripsi = document.getElementById('deskripsi');
		let harga = document.getElementById('harga');
		let jumlah_bed = document.getElementById('jumlah_bed');
		let label_tambah = document.getElementById('label_tambah');
		let label_update = document.getElementById('label_update');
		let btn = document.getElementById('btn');
		let btn_edit = document.getElementById('btn_edit');
		let btn_update = document.getElementById('btn_update');

		label_tambah.hidden = true;
		label_update.hidden = false;
		btn.hidden = true;
		btn_update.hidden = false;

		let xhttp = new XMLHttpRequest();
		xhttp.open("GET", "http://localhost/REPO-TUBES-PW/admin/page/tipe_kamar/ajax.php?request=4&id_tipe="+id_tipe, true);

		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {

				let response = JSON.parse(this.responseText);

				for (let key in response) {
					if (response.hasOwnProperty(key)) {
						let val = response[key];

						tipe_kamar.value = val['tipe_kamar'];
						deskripsi.value = val['deskripsi'];
						fasilitas.value = val['fasilitas'];
						harga.value = val['harga']; 
						jumlah_bed.value = val['jumlah_bed'];
						document.getElementById("id_tipe").value = val['id_tipe'];

					}
				} 

			}
		};

		xhttp.send();
	}

	function update() {

		let id_tipe = document.getElementById('id_tipe').value;
		let tipe_kamar = document.getElementById('tipe_kamar').value;
		let deskripsi = document.getElementById('deskripsi').value;
		let fasilitas = document.getElementById('fasilitas').value;
		let harga = document.getElementById('harga').value;
		let jumlah_bed = document.getElementById('jumlah_bed').value;
		let btn_edit = document.getElementById('btn_edit');
		let btn_update = document.getElementById('btn_update');

		if(tipe_kamar != '' && deskripsi !='' && harga != '' && jumlah_bed != ''){

			let data = { id_tipe : id_tipe, tipe_kamar : tipe_kamar, deskripsi : deskripsi, fasilitas : fasilitas, harga : harga, jumlah_bed : jumlah_bed };

			let xhttp = new XMLHttpRequest();

			xhttp.open("POST", "http://localhost/REPO-TUBES-PW/admin/page/tipe_kamar/ajax.php?request=5", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Update successfully.");

						loadUsers();

						document.getElementById("id_tipe").value = '';
						document.getElementById("tipe_kamar").value = '';
						document.getElementById("deskripsi").value = '';
						document.getElementById("harga").value = '';
						document.getElementById("jumlah_bed").value = '';

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
	loadUsers();
</script>