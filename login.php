<?php
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
// Password tidak ditampilkan ke UI untuk alasan keamanan
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Login - SI Akademik</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); text-align: center; max-width: 400px; width: 100%; }
        .user-info { font-weight: bold; color: #2ecc71; font-size: 1.1rem; margin-top: 10px; }
        a { display: inline-block; margin-top: 20px; color: #7f8c8d; text-decoration: none; font-size: 0.9rem; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="card">
        <h3>Proses Login Berhasil</h3>
        <p style="margin-top: 15px; color: #555;">Selamat datang kembali,</p>
        <div class="user-info"><?= htmlspecialchars($username); ?></div>
        <br>
        <a href="index.php">&larr; Kembali ke Halaman Utama</a>
    </div>
</body>
</html>