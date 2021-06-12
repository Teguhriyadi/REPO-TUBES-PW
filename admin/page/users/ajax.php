<?php
session_start();
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
	
	$no = 1;
	$sesi = $_SESSION['login'];
	while($row = mysqli_fetch_assoc($employeeData)){
		$response[] = array(
			"no"	  => $no++,
			"id_users" => $row['id_users'],
			"username" => $row['username'],
			"created_at" => $row['created_at'],
			"last_login" => $row['last_login'],
			"level" => $row['level']
		);
	}

	echo json_encode($response);
	exit;
}

// Insert record
if($request == 2){

	$tipe_kamar = $_POST['tipe_kamar'];
	$deskripsi = $_POST['deskripsi'];
	$fasilitas = $_POST['fasilitas'];
	$harga = $_POST['harga'];
	$jumlah_bed = $_POST['jumlah_bed'];

	$namafile = $_FILES['image']['name'];
	$ukuranfile = $_FILES['image']['size'];
	$error = $_FILES['image']['error'];
	$tmpname = $_FILES['image']['tmp_name'];

	$ekstensiGambarValid = ['jpg','jpeg','png'];
	$ekstensiGambar = explode('.', $namafile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	$namafilebaru = uniqid();
	$namafilebaru .= '.';
	$namafilebaru .= $ekstensiGambar;

	move_uploaded_file($tmpname, '../../img/' . $namafilebaru);

	$response = 0;

	$query = $con->query("INSERT INTO tipe_kamar VALUES ('','$tipe_kamar', '$deskripsi', '$fasilitas', '$harga', '$jumlah_bed' ,'$namafilebaru') ");

	if ($query != 0) {
		$response = 1;
	}

	echo $response;
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
			'fasilitas' => $ambil['fasilitas'],
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

	$sql = $con->query("UPDATE tipe_kamar SET tipe_kamar = '$tipe_kamar', deskripsi = '$deskripsi', harga = '$harga', jumlah_bed = '$jumlah_bed' WHERE id_tipe = $id_tipe");

	if($sql){
		echo 1; 
	}else{
		echo 0;
	}

	exit;
}