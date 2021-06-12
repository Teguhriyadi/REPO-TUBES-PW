<?php
	
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = "dashboard";
	}


	switch ($page) {
		case 'dashboard':
			include 'page/dashboard.php';
			break;

		// tipe_kamar
		case 'tipe_kamar':
			include 'page/tipe_kamar/tipe_kamar.php';
			break;

		case 'ajax_tipe_kamar':
			include 'page/tipe_kamar/ajax.php';
			break;

		case 'tambah_tipe_kamar':
			include 'page/tipe_kamar/tambah_tipe_kamar.php';
			break;

		case 'edit_kamar':
			include 'page/tipe_kamar/edit_kamar.php';
			break;
		// end

		// kamar
		case 'kamar':
			include 'page/kamar/data_kamar.php';
			break;
		// end

		// tamu
		case 'tamu':
			include 'page/tamu/data_tamu.php';
			break;

		// users
		case 'users':
			include 'page/users/data_users.php';
			break;
		// end

		case 'logout':
			include 'auth/logout.php';
			break;
		
		default:
			echo "404 Not Found";
			break;
	}

?>