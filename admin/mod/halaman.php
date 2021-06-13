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

		case 'tipe_kamar':
			include 'page/tipe_kamar/tipe_kamar.php';
			break;

		case 'kamar':
			include 'page/kamar/data_kamar.php';
			break;

		case 'tamu':
			include 'page/tamu/data_tamu.php';
			break;

		case 'reservasi':
			include 'page/reservasi/data_reservasi.php';
			break;

		case 'transaksi':
			include 'page/transaksi/data_transaksi.php';
			break;

		case 'users':
			include 'page/users/data_users.php';
			break;

		case 'logout':
			include 'auth/logout.php';
			break;
		
		default:
			echo "404 Not Found";
			break;
	}

?>