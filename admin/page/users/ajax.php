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

	$data = json_decode(file_get_contents("php://input"));

	$username = $data->username;
	$password = $data->password;
	$level = $data->level;

	$password = password_hash($password, PASSWORD_DEFAULT);
	
	$sql = "INSERT INTO users (id_users, username, password, level) VALUES ('', '$username', '$password' ,'$level')";
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

	$id = $_GET["id_users"];
	$sql = $con->query("SELECT * FROM users WHERE id_users = $id");

	$data = array();

	while ($ambil = $sql->fetch_assoc()) {
		$data[] = array(
			'id_users' => $ambil['id_users'],
			'username' => $ambil['username'],
			'password' => $ambil['password'],
			'level'    => $ambil['level']
		);
	}

	echo json_encode($data);
	exit;
}

if ($request == 5) {

	$data = json_decode(file_get_contents("php://input"));

	$id_users = $data->id_users;
	$username = $data->username;
	$password = $data->password;
	$level = $data->level;

	$password = password_hash($password, PASSWORD_DEFAULT);

	$sql = $con->query("UPDATE users SET username = '$username', password = '$password', level = '$level' WHERE id_users = $id_users");

	if($sql){
		echo 1; 
	}else{
		echo 0;
	}

	exit;
}