<?php
// Panggil file Model Mahasiswa
require_once __DIR__ . '/app/Models/Mahasiswa.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Akademik</title>
    <!-- Memanggil CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <!-- Memuat isi tampilan tabel mahasiswa -->
    <?php 
    include __DIR__ . '/app/Views/mahasiswa/index.php'; 
    ?>

    <!-- Memanggil JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>