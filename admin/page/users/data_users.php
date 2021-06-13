<div class="header">
	<span class="icon"><i class="fa fa-user"></i></span>
	<span class="title">Users</span>
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
		<input type="hidden" id="id_users">
		<div class="form-group">
			<label for="username"> Username </label>
			<input type="text" class="form-control" id="username" placeholder="Masukkan Username" autocomplete="off">
		</div>
		<div class="form-group">
			<label for="password"> Password </label>
			<input type="password" class="form-control" id="password" placeholder="Masukkan Password">
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
			<h2>Data Users</h2>
		</div>
		<table id="data">
			<thead>
				<tr>
					<td>No.</td>
					<td>Username</td>
					<td>Created At</td>
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
						let level = NewRow.insertCell(3);
						let aksi_cell = NewRow.insertCell(4);
						let session = "<?= $_SESSION['username'] ?>";

						no.innerHTML = val['no'];
						username.innerHTML = val['username'];
						created_at.innerHTML = val['created_at'];

						if (val['level'] == 1) {
							level.innerHTML = 'Administrator';
						} else if (val['level'] == 2) {
							level.innerHTML = 'Petugas';
						} else {
							level.innerHTML = 'Tidak Ada';
						}

						if (val['username'] == session) {
							aksi_cell.innerHTML = '<button class="btn-warning" style="text-decoration: none;" onclick="edit('+ val['id_users'] +')" id="btn_edit"><i class="fa fa-edit"></i> Edit</button>';
						} else {
							aksi_cell.innerHTML = '<button class="btn-warning" style="text-decoration: none;" onclick="edit('+ val['id_users'] +')" id="btn_edit"><i class="fa fa-edit"></i> Edit</button> <button class="btn-danger" onclick="hapus('+ val['id_users'] +')"><i class="fa fa-trash-o"></i> Hapus</button>';
						}
					}
				}
			}

		};

		xhttp.send();
	}

	function insert() {

		let username = document.getElementById('username').value;
		let password = document.getElementById('password').value;
		let level = document.getElementById('level').value;

		if( username != '' && password !='' && level != '' ){

			let data = { username : username, password : password, level : level };
			let xhttp = new XMLHttpRequest();
	
			xhttp.open("POST", "http://localhost/REPO-TUBES-PW/admin/page/users/ajax.php?request=2", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Data Berhasil di Tambahkan");


						loadUsers();

						document.getElementById("username").value = "";
						document.getElementById("password").value = "";
						document.getElementById("level").value = "";

					} else {
						alert("Data Gagal di Tambahkan");
					}
				}
			};

			xhttp.setRequestHeader("Content-Type", "application/json");
			xhttp.send(JSON.stringify(data));
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
						alert("Data Berhasil di Hapus");

						loadUsers();
					} else {
						alert("Data Gagal di Hapus");

						loadUsers();
					}

				}
			};

			xhttp.send();

		}
	}

	function edit(id_users) {
		let username = document.getElementById('username');
		let password = document.getElementById('password');
		let level = document.getElementById('level');

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
		xhttp.open("GET", "http://localhost/REPO-TUBES-PW/admin/page/users/ajax.php?request=4&id_users="+id_users, true);

		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {

				let response = JSON.parse(this.responseText);

				for (let key in response) {
					if (response.hasOwnProperty(key)) {
						let val = response[key];

						username.value = val['username'];
						password.value = val['password'];
						level.value = val['level'];
						document.getElementById("id_users").value = val['id_users'];

					}
				} 

			}
		};

		xhttp.send();
	}

	function update() {

		let id_users = document.getElementById('id_users').value;
		let username = document.getElementById('username').value;
		let password = document.getElementById('password').value;
		let level = document.getElementById('level').value;

		let btn_edit = document.getElementById('btn_edit');
		let btn_update = document.getElementById('btn_update');

		if(username != '' && password !='' && level != ''){

			let data = { id_users : id_users, username : username, password : password, level : level };

			let xhttp = new XMLHttpRequest();

			xhttp.open("POST", "http://localhost/REPO-TUBES-PW/admin/page/users/ajax.php?request=5", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Data Berhasil di Ubah");

						loadUsers();

						document.getElementById("id_users").value = '';
						document.getElementById("username").value = '';
						document.getElementById("password").value = '';
						document.getElementById("level").value = '';

						label_tambah.hidden = false;
						label_update.hidden = true;
						btn.hidden = false;
						btn_update.hidden = true;
					} else {
						alert("Data Gagal di Ubah")
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