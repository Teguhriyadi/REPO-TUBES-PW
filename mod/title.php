<?php
	
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = "dashboard";
	}

	switch ($page) {
		case 'dashboard':
			echo "Dashboard";
			break;

		case 'pilih_kamar':
			echo "Tipe Kamar";
			break;
		
		default:
			echo "404 Not Found";
			break;
	}

?>