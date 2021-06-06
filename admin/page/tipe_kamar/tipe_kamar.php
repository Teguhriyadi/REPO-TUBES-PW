<div class="header">
	<span class="icon"><i class="fa fa-bars"></i></span>
	<span class="title">Tipe Kamar</span>
</div>
<br>

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
					<td>Deskripsi</td>
					<td>Fasilitas</td>
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

	function loadTipeKamar() {

		let xhttp = new XMLHttpRequest();

		xhttp.open("GET", "http://localhost/TUBES-PW/admin/page/tipe_kamar/ajax.php?request=1", true);

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
						let deskripsi = NewRow.insertCell(2); 
						let fasilitas = NewRow.insertCell(3);
						let harga = NewRow.insertCell(4);
						let jumlah_bed = NewRow.insertCell(5);
						let image = NewRow.insertCell(6);
						let aksi_cell = NewRow.insertCell(7);

						no.innerHTML = val['no'];
						tipe_kamar.innerHTML = val['tipe_kamar']; 
						deskripsi.innerHTML = val['deskripsi']; 
						fasilitas.innerHTML = val['fasilitas'];
						harga.innerHTML = val['harga'];
						jumlah_bed.innerHTML = val['jumlah_bed'];
						image.innerHTML = '<img width="100" src="img/'+val['image']+'">';
						aksi_cell.innerHTML = '<a href="?page=edit_kamar&id_tipe='+val["id_tipe"]+'" class="btn-warning" style="text-decoration: none;" onclick="edit('+ val['id_tipe'] +')" id="btn_edit"><i class="fa fa-edit"></i> Edit</a> &bull; <button class="btn-danger" onclick="hapus('+ val['id_tipe'] +')"><i class="fa fa-trash-o"></i> Hapus</button>';
					}
				}
			}

		};

		xhttp.send();
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
		let btn = document.getElementById('btn');
		let btn_edit = document.getElementById('btn_edit');
		let btn_update = document.getElementById('btn_update');

		btn.hidden = true;
		btn_update.hidden = false;

		let xhttp = new XMLHttpRequest();
		xhttp.open("GET", "ajaxfile.php?request=4&id_tipe="+id_tipe, true);

		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {

				let response = JSON.parse(this.responseText);

				for (let key in response) {
					if (response.hasOwnProperty(key)) {
						let val = response[key];

						tipe_kamar.value = val['tipe_kamar'];
						deskripsi.value = val['deskripsi'] 
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
		let harga = document.getElementById('harga').value;
		let jumlah_bed = document.getElementById('jumlah_bed').value;
		let btn_edit = document.getElementById('btn_edit');
		let btn_update = document.getElementById('btn_update');

		if(tipe_kamar != '' && deskripsi !='' && harga != '' && jumlah_bed != ''){

			let data = { id_tipe : id_tipe, tipe_kamar : tipe_kamar, deskripsi : deskripsi, harga : harga,jumlah_bed : jumlah_bed};

			let xhttp = new XMLHttpRequest();

			xhttp.open("POST", "ajaxfile.php?request=5", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Update successfully.");

						loadTipeKamar();

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
		}
	}
	loadTipeKamar();
</script>