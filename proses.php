<?php
$keyword = $_GET['keyword'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pencarian - SI Akademik</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); text-align: center; max-width: 400px; width: 100%; }
        .badge { display: inline-block; background: #e8f4fc; color: #2980b9; padding: 6px 12px; border-radius: 20px; font-weight: 600; margin-top: 10px; }
        a { display: inline-block; margin-top: 20px; color: #7f8c8d; text-decoration: none; font-size: 0.9rem; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="card">
        <h3>Hasil Pencarian</h3>
        <p style="margin-top: 15px; color: #555;">Anda mencari kata kunci:</p>
        <div class="badge"><?= htmlspecialchars($keyword); ?></div>
        <br>
        <a href="index.php">&larr; Kembali ke Halaman Utama</a>
    </div>
</body>
</html>