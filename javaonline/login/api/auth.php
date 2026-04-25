<?php
session_start();
header("Content-Type: application/json");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "test_login");

if ($conn->connect_error) {
    echo json_encode(["status" => "error"]);
    exit;
}

$action = $_POST['action'] ?? '';

/* ================= REGISTER ================= */
if ($action === 'register') {

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        echo json_encode([
            "status" => "fail",
            "message" => "Field tidak boleh kosong"
        ]);
        exit;
    }

    // cek username sudah ada atau belum
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode([
            "status" => "fail",
            "message" => "Username sudah digunakan"
        ]);
        exit;
    }

    $stmt->close();

    // HASH PASSWORD
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "fail"]);
    }

    $stmt->close();

/* ================= LOGIN ================= */
} elseif ($action === 'login') {

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "fail"]);
        }
    } else {
        echo json_encode(["status" => "fail"]);
    }

    $stmt->close();

/* ================= CHECK ================= */
} elseif ($action === 'check') {

    if (isset($_SESSION['username'])) {
        echo json_encode([
            "status" => "logged_in",
            "username" => $_SESSION['username']
        ]);
    } else {
        echo json_encode(["status" => "not_logged_in"]);
    }

/* ================= LOGOUT ================= */
} elseif ($action === 'logout') {

    session_destroy();
    header("Location: ../../index.html");

} else {
    echo json_encode(["status" => "invalid"]);
}

$conn->close();
?>