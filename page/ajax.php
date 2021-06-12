<?php

session_start();
include '../config/koneksi.php';

$request = 3;

if(isset($_GET['request'])){
	$request = $_GET['request'];
}

if($request == 1){

	$sql = "SELECT * FROM kamar JOIN tipe_kamar ON kamar.id_tipe = tipe_kamar.id_tipe ORDER BY kamar.no_kamar ASC";
	$employeeData = mysqli_query($con,$sql);

	$response = array();
	
	$no = 1;
	while($row = mysqli_fetch_assoc($employeeData)){
		$response[] = array(
			"nomer" => $no++,
			"no_kamar" => $row['no_kamar'],
			"tipe_kamar" => $row['tipe_kamar'],
			"status" => $row['status'],
			"lantai" => $row['lantai'],
			);
	}

	echo json_encode($response);
	exit;
}

if($request == 2){

	$data = json_decode(file_get_contents("php://input"));

	$no_iden = $data->no_identitas;
	$nama_tamu = $data->nama_tamu;
	$email_tamu = $data->email_tamu;
	$telp_tamu = $data->telp_tamu;
	$password_tamu = $data->password_tamu;

	$password_tamu = password_hash($password_tamu, PASSWORD_DEFAULT);
	
	$sql = "INSERT INTO tamu VALUES ('$no_iden', '$nama_tamu', '$email_tamu', '$telp_tamu', '$password_tamu')";
	if(mysqli_query($con,$sql)){
		echo 1; 
	}else{
		echo 0;
	}

	exit;
}

if ($request == 3) {

	$data = json_decode(file_get_contents("php://input"));

	$email_tamu = $data->email_tamu;
	$password_tamu = $data->password_tamu;

	$sql = $con->query("SELECT * FROM tamu WHERE email_tamu = '$email_tamu'");

	if (mysqli_num_rows($sql)  === 1) {
		$array = mysqli_fetch_assoc($sql);

		if (password_verify($password_tamu, $array['password_tamu'])) {
			$_SESSION['tamu'] = true;
			$_SESSION['nama_tamu'] = $array['nama_tamu'];
			echo 1;
		} else {
			echo 0;
		}
	} else {
		echo 0;
	}
}

if ($request == 4) {

	$no_kamar = $_GET["no_kamar"];
	$sql = $con->query("SELECT * FROM kamar WHERE no_kamar = '$no_kamar'");

	$data = array();

	while ($ambil = $sql->fetch_assoc()) {
	    $data[] = array(
	        'no_kamar' => $ambil['no_kamar'],
	        'id_tipe' => $ambil['id_tipe'],
	        'status' => $ambil['status'],
	        'lantai' => $ambil['lantai']
	    );
	}

	echo json_encode($data);
	exit;
}

if ($request == 5) {
	$data = json_decode(file_get_contents("php://input"));

	$no_kamar = $data->no_kamar;
	$id_tipe = $data->id_tipe;
	$status = $data->status;
	$lantai = $data->lantai;

	$sql = $con->query("UPDATE kamar SET id_tipe = '$id_tipe', status = '$status', lantai = '$lantai' WHERE no_kamar = $no_kamar");

	if($sql){
	    echo 1; 
	}else{
	    echo 0;
	}

	exit;
}