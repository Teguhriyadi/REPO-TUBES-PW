<div class="header">
	<span class="icon"><i class="fa fa-plus"></i></span>
	<span class="title">Tambah Data</span>
</div>
<br>

<div class="details">
	<div class="recentOrders">
		<div class="cardHeader">
			<h2>Data Tipe Kamar</h2>
			<a href="?page=tambah_tipe_kamar" class="btn"><i class="fa fa-plus"></i> Tambah Data</a>
		</div>
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
		<div class="form-group">
			<label for="foto"> Foto </label>
			<input type="file" id="image" class="form-control">
		</div>
		<div class="form-group">
			<button onclick="insert()" class="btn-primary">
				<i class="fa fa-plus"></i> Tambah
			</button>
		</div>
	</div>
</div>

<script>
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

			xhttp.open("POST", "http://localhost/TUBES-PW/admin/page/tipe_kamar/ajax.php?request=2", true);

			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					var response = this.responseText;

					if (response == 1) {
						alert("Upload Sukses");
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
</script>