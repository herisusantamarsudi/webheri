<?php
include 'koneksi.php';

// Query data dari tabel
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Kirim data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
