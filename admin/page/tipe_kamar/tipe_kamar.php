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
		<input type="hidden" id="image_lama">
		<div class="form-group">
			<label for="tipe_kamar"> Tipe Kamar </label>
			<input type="text" class="form-control" id="tipe_kamar" placeholder="Masukkan Tipe Kamar" autocomplete="off">
		</div>
		<div class="form-group">
			<label for="deskripsi"> Deskripsi </label>
			<textarea class="form-control" id="deskripsi" placeholder="Masukkan Deskripsi" rows="5"></textarea>
		</div>
		<div class="form-group">
			<label for="fasilitas"> Fasilitas </label>
			<input type="text" class="form-control" id="fasilitas" placeholder="Masukkan Fasilitas" autocomplete="off">
		</div>
		<div class="form-group">
			<label for="harga"> Harga </label>
			<input type="number" class="form-control" id="harga" placeholder="0" autocomplete="off">
		</div>
		<div class="form-group">
			<label for="jumlah_bed"> Jumlah Bed </label>
			<input type="number" class="form-control" id="jumlah_bed" placeholder="0">
		</div>
		<div id="ganti_gambar" hidden>
			<div class="form-group">
				<div id="tampil_gambar">
					
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="foto"> Foto </label>
			<input type="file" id="image" class="form-control">
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
					<td>Tipe Kamar</td>
					<td>Harga</td>
					<td>Jumlah Bed</td>
					<td>Image</td>
					<td>Aksi</td>
				</tr>
			</thead>
			<tbody id="table">
				
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">

	loadTipeKamar();
	
	function loadTipeKamar() {

		let xhttp = new XMLHttpRequest();

		xhttp.open("GET", "http://localhost/REPO-TUBES-PW/admin/page/tipe_kamar/ajax.php?request=1", true);

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
						let tipe_kamar = NewRow.insertCell(1);
						let harga = NewRow.insertCell(2);
						let jumlah_bed = NewRow.insertCell(3);
						let image = NewRow.insertCell(4);
						let aksi_cell = NewRow.insertCell(5);

						no.innerHTML = val['no'];
						tipe_kamar.innerHTML = val['tipe_kamar'];
						harga.innerHTML = val['harga'];
						jumlah_bed.innerHTML = val['jumlah_bed'];
						image.innerHTML = '<img width="100" src="image/'+val['image']+'">';
						aksi_cell.innerHTML = '<button class="btn-warning" style="text-decoration: none;" onclick="edit('+ val['id_tipe'] +')" id="btn_edit"><i class="fa fa-edit"></i> Edit</button> <button class="btn-danger" onclick="hapus('+ val['id_tipe'] +')"><i class="fa fa-trash-o"></i> Hapus</button>';
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
			let formData = new FormData();

			formData.append("image", files[0]);
			formData.append("tipe_kamar", tipe_kamar);
			formData.append("deskripsi", deskripsi);
			formData.append("fasilitas", fasilitas);
			formData.append("harga", harga);
			formData.append("jumlah_bed", jumlah_bed);

			let xhttp = new XMLHttpRequest();

			xhttp.open("POST", "http://localhost/REPO-TUBES-PW/admin/page/tipe_kamar/ajax.php?request=2", true);

			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					var response = this.responseText;

					if (response == 1) {
						alert("Upload Sukses");

						loadTipeKamar();

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

	function hapus(id_tipe) {
		let xhttp = new XMLHttpRequest();
		let konfirmasi = confirm("Yakin ? Mau di Hapus ?");

		if (konfirmasi) {
			xhttp.open("GET", "http://localhost/LATIHAN-TUBES/admin/page/tipe_kamar/ajax.php?request=3&id_tipe="+id_tipe, true);

			xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;

					if(response == 1){
						alert("Delete successfully.");

						loadTipeKamar();
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
		let ganti_gambar = document.getElementById('ganti_gambar');
		let label_tambah = document.getElementById('label_tambah');
		let label_update = document.getElementById('label_update');
		let btn = document.getElementById('btn');
		let btn_edit = document.getElementById('btn_edit');
		let btn_update = document.getElementById('btn_update');

		label_tambah.hidden = true;
		label_update.hidden = false;
		ganti_gambar.hidden = false;
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
						document.getElementById("tampil_gambar").innerHTML = '<img src="image/'+val['image']+'">';
						document.getElementById("id_tipe").value = val['id_tipe'];

					}
				} 

			}
		};

		xhttp.send();
	}

	function update() {
		let files = document.getElementById("image").files;
		let id_tipe = document.getElementById("id_tipe").value;
		let harga = document.getElementById("harga").value;

		if (files.length > 0) {
			let formData = new FormData();

			formData.append("image", files[0]);
			formData.append("id_tipe", id_tipe);
			formData.append("harga", harga);

			let xhttp = new XMLHttpRequest();

			xhttp.open("POST", "http://localhost/REPO-TUBES-PW/admin/page/tipe_kamar/ajax.php?request=5", true);

			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					var response = this.responseText;

					if (response == 1) {
						alert("Upload Sukses");

						loadTipeKamar();

					} else {
						alert("Upload Gagal");
					}
				}
			};

			xhttp.send(formData);
		}
		
		/*
		let files = document.getElementById("image").files;
		let id_tipe = document.getElementById("id_tipe").value;
		let image_lama = document.getElementById("image_lama").value;
		let tipe_kamar = document.getElementById("tipe_kamar").value;
		let deskripsi = document.getElementById("deskripsi").value;
		let fasilitas = document.getElementById("fasilitas").value;
		let harga = document.getElementById("harga").value;
		let jumlah_bed = document.getElementById("jumlah_bed").value;

		if (files.length > 0) {
			let formData = new FormData();

			formData.append("image", files[0]);
			formData.append("id_tipe", id_tipe);
			formData.append("image_lama", image_lama);
			formData.append("tipe_kamar", tipe_kamar);
			formData.append("deskripsi", deskripsi);
			formData.append("fasilitas", fasilitas);
			formData.append("harga", harga);
			formData.append("jumlah_bed", jumlah_bed);

			let xhttp = new XMLHttpRequest();

			xhttp.open("POST", "http://localhost/REPO-TUBES-PW/admin/page/tipe_kamar/ajax.php?request=5", true);

			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					var response = this.responseText;

					if (response == 1) {
						alert("Upload Sukses");

						loadTipeKamar();

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
	
		*/
	}
	
</script>