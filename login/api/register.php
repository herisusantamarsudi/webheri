<?php

include 'koneksi.php';

$data = json_decode(file_get_contents("php://input"), true);

$username = $data['username'];
$email = $data['email'];
$password = $data['password'];
$level = $data['level'];

/* cek username sudah ada atau belum */

$cek = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($cek);

if($result->num_rows > 0){

$response = [
"status"=>"error",
"message"=>"Username sudah digunakan"
];

}else{

/* enkripsi password */

$hashPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username,email,password,level)
VALUES ('$username','$email','$hashPassword','$level')";

if($conn->query($sql) === TRUE){

$response = [
"status"=>"success",
"message"=>"Registrasi berhasil"
];

}else{

$response = [
"status"=>"error",
"message"=>"Gagal menyimpan data"
];

}

}

header('Content-Type: application/json');

echo json_encode($response);

$conn->close();

?>