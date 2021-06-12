<?php

include '../../../config/koneksi.php';

$request = 3;

if(isset($_GET['request'])){
	$request = $_GET['request'];
}

if($request == 1){

	$sql = "SELECT * FROM tamu ORDER BY no_identitas ASC";
	$employeeData = mysqli_query($con,$sql);

	$response = array();
	
	$no = 1;
	while($row = mysqli_fetch_assoc($employeeData)){
		$response[] = array(
			"nomer" => $no++,
			"no_identitas" => $row['no_identitas'],
			"nama_tamu" => $row['nama_tamu'],
			"email_tamu" => $row['email_tamu'],
			"telp_tamu" => $row['telp_tamu'],
			"password_tamu" => $row['password_tamu']
		);
	}
	echo json_encode($response);
	exit;
}