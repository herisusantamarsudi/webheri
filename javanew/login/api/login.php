<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "test_login");

if ($conn->connect_error) {
    die(json_encode(["status" => "error"]));
}

$username = $_POST['username'];
$password = $_POST['password'];

// query sederhana
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode([
        "status" => "success",
        "username" => $username
    ]);
} else {
    echo json_encode(["status" => "fail"]);
}

$conn->close();
?>