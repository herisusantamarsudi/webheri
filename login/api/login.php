<?php
session_start();

include "koneksi.php";
$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = $data['password'];

$query = mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");

$data = mysqli_fetch_assoc($query);

if($data && password_verify($password,$data['password'])){

    $_SESSION['user'] = $data['username'];

    echo json_encode([
        "status"=>"success",
        "redirect"=>"dashboard.php"
    ]);

}else{
    echo json_encode([
        "status"=>"error",
        "message"=>"Email atau password salah"
    ]);
}
?>