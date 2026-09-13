<?php $method = $_SERVER['REQUEST_METHOD']; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deteksi Metode Request</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #f1f5f9; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
        .card { background: #fff; width: 100%; max-width: 420px; border-radius: 16px; padding: 25px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); text-align: center; }
        h2 { color: #0f172a; margin-bottom: 20px; font-size: 1.3rem; }
        .box { padding: 18px; border-radius: 12px; margin-bottom: 20px; line-height: 1.5; font-size: 0.9rem; }
        .box-get { background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; }
        .box-post { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
        .box h3 { font-size: 1.1rem; margin-bottom: 6px; }
        .btn-group { display: flex; gap: 10px; }
        .btn { flex: 1; padding: 11px; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; text-decoration: none; font-size: 0.9rem; transition: 0.2s; }
        .btn-get { background: #2563eb; color: #fff; }
        .btn-get:hover { background: #1d4ed8; }
        .btn-post { background: #16a34a; color: #fff; }
        .btn-post:hover { background: #15803d; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Deteksi Metode Request</h2>
        
        <?php if ($method === 'POST'): ?>
            <div class="box box-post">
                <h3>Metode: POST</h3>
                <p>Data dikirim secara tersembunyi lewat <b>HTTP Body</b> (cocok untuk data sensitif/form login).</p>
            </div>
        <?php else: ?>
            <div class="box box-get">
                <h3>Metode: GET</h3>
                <p>Halaman diakses langsung lewat <b>URL / Query Parameter</b> (cocok untuk mengambil data).</p>
            </div>
        <?php endif; ?>

        <div class="btn-group">
            <a href="cek_method.php" class="btn btn-get">Kirim GET</a>
            <form action="cek_method.php" method="POST" style="flex:1;">
                <button type="submit" class="btn btn-post" style="width:100%;">Kirim POST</button>
            </form>
        </div>
    </div>
</body>
</html>