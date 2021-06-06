<?php

include '../../../config/koneksi.php';

$request = 3;

// Read $_GET value
if(isset($_GET['request'])){
	$request = $_GET['request'];
}

// Fetch records 
if($request == 1){

   // Select record 
	$sql = "SELECT * FROM users ORDER BY username ASC";
	$employeeData = mysqli_query($con,$sql);

	$response = array();

	$nomer = 1;
	while($row = mysqli_fetch_assoc($employeeData)){
		$response[] = array(
			"nomer" 	=> $nomer++,
			"id_users" => $row['id_users'],
			"username" => $row['username'],
			"created_at" => $row['created_at'],
			"last_login" => $row['last_login'],
			"level" => $row['level'],
			);
	}

	echo json_encode($response);
	exit;
}

// Insert record
if($request == 2){

   // Read POST data
	$data = json_decode(file_get_contents("php://input"));

	$tipe_kamar = $data->tipe_kamar;
	$deskripsi = $data->deskripsi;
	$harga = $data->harga;
	$jumlah_bed = $data->jumlah_bed;
	

   // Insert record
	$sql = "insert into tipe_kamar values('', '$tipe_kamar', '$deskripsi', '$harga', '$jumlah_bed')";
	if(mysqli_query($con,$sql)){
		echo 1; 
	}else{
		echo 0;
	}

	exit;
}

if ($request == 3) {

	$id_users = $_GET['id_users'];
	$sql = $con->query("DELETE FROM users WHERE id_users = $id_users");

	if($sql){
	    echo 1; 
	}else{
	    echo 0;
	}

	exit;
}

if ($request == 4) {

	$id = $_GET["id_tipe"];
	$sql = $con->query("SELECT * FROM tipe_kamar WHERE id_tipe = '$id'");

	$data = array();

	while ($ambil = $sql->fetch_assoc()) {
	    $data[] = array(
	        'id_tipe' => $ambil['id_tipe'],
	        'tipe_kamar' => $ambil['tipe_kamar'],
	        'deskripsi' => $ambil['deskripsi'],
	        'harga' => $ambil['harga'],
	        'jumlah_bed' => $ambil['jumlah_bed']
	    );
	}

	echo json_encode($data);
	exit;
}

if ($request == 5) {
	$data = json_decode(file_get_contents("php://input"));

	$id_tipe = $data->id_tipe;
	$tipe_kamar = $data->tipe_kamar;
	$deskripsi = $data->deskripsi;
	$harga = $data->harga;
	$jumlah_bed = $data->jumlah_bed;

	$sql = $con->query("UPDATE tipe_kamar SET tipe_kamar = '$tipe_kamar', deskripsi = '$deskripsi', harga = '$harga', jumlah_bed = '$jumlah_bed' WHERE id_tipe = $id_tipe");

	if($sql){
	    echo 1; 
	}else{
	    echo 0;
	}

	exit;
}