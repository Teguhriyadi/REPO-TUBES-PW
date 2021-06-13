<?php

include '../../../config/koneksi.php';

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

	$no_kamar = $data->no_kamar;
	$id_tipe = $data->id_tipe;
	$status = $data->status;
	$lantai = $data->lantai;
	
	$sql = "INSERT INTO kamar VALUES ('$no_kamar', '$id_tipe', '$status', '$lantai')";
	if(mysqli_query($con,$sql)){
		echo 1; 
	}else{
		echo 0;
	}

	exit;
}

if ($request == 3) {

	$no_kamar = $_GET['no_kamar'];

	$sql = $con->query("DELETE FROM kamar WHERE no_kamar = '$no_kamar'");

	if($sql){
	    echo 1; 
	}else{
	    echo 0;
	}

	exit;
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