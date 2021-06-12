<?php

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = "dashboard";
	}

?>

<?php

	switch ($page) {
		case 'dashboard':
			include 'page/dashboard.php';
			break;

		case 'pilih_kamar':
			include 'page/pilih_kamar.php';
			break;

		case 'booking':
			include 'page/booking.php';
			break;

		case 'register':
			include 'page/register.php';
			break;

		case 'login':
			include 'page/login.php';
			break;

		case 'logout':
			include 'page/logout.php';
			break;
		
		case 'contact':
			include 'page/contact.php';
			break;

		default:
			echo "404 Not Found";
			break;
	}

?>