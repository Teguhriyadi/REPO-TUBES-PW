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

		case 'tipe_kamar':
			echo "Tipe Kamar";
			break;

		case 'kamar':
			echo "Kamar";
			break;

		case 'users':
			echo "Users";
			break;

		case 'logout':
			echo "Logout";
			break;
		
		default:
			echo "404 Not Found";
			break;
	}

?>