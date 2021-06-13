<?php
session_start();
include '../../../config/koneksi.php';

$request = 3;

if(isset($_GET['request'])){
	$request = $_GET['request'];
}

if($request == 1){

	$sql = "SELECT * FROM reservasi ORDER BY kode_reservasi ASC";
	$employeeData = mysqli_query($con,$sql);

	$response = array();
	
	$no = 1;
	while($row = mysqli_fetch_assoc($employeeData)){
		$response[] = array(
			"no"	  => $no++,
			"kode_reservasi" => $row['kode_reservasi'],
			"email_tamu" => $row['email_tamu'],
			"check_in" => $row['check_in'],
			"check_out" => $row['check_out'],
			"jumlah_tamu" => $row['jumlah_tamu'],
			"pesan" => $row['pesan'],
			"id_tipe" => $row['id_tipe'],
			"no_kamar" => $row['no_kamar'],
			"status" => $row['status'],
			"total" => $row['total']
		);
	}

	echo json_encode($response);
	exit;
}