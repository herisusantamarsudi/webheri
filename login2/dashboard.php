<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<link href="css/dashboard.css" rel="stylesheet">
</head>

<body>

<h1>Data Semua User</h1>

<p>Selamat datang: <b><?php echo $_SESSION['user']; ?></b></p>

<button onclick="logout()">Logout</button>

<!-- Tabel semua user -->
<table border="1" id="table-all">
<thead>
<tr>
<th>ID</th>
<th>Nama</th>
<th>Email</th>
<th>Level</th>
<th>Aksi</th>
</tr>
</thead>
<tbody id="data-all">
</tbody>
</table>

<br>

<button id="tampilSiswaBtn">Tampilkan Data Siswa</button>

<h2>Data User Level Siswa</h2>

<table border="1" id="table-siswa">
<thead>
<tr>
<th>ID</th>
<th>Nama</th>
<th>Email</th>
<th>Level</th>
</tr>
</thead>
<tbody id="data-siswa">
</tbody>
</table>

<script>
function logout(){
    window.location.href = "api/logout.php";
}
</script>

<script src="js/tampiluser.js"></script>

</body>
</html>