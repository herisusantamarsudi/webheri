<?php
session_start();

// hapus semua session
session_unset();
session_destroy();

// redirect ke halaman index
header("Location: ../index.html");
exit();
?>