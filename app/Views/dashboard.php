<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - SI Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">SI Akademik - Dashboard</a>
            <a href="/si-akademik/public/logout" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </nav>
    <div class="container mt-4">
        <?php if (!empty($flash)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($flash); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="card shadow-sm">
        <div class="card-body">
        <h2>Selamat Datang, <?= htmlspecialchars($username); ?>!</h2>
        <p class="text-muted">Anda berhasil masuk ke halaman terproteksi menggunakan AuthMiddleware.</p>
        <hr>
        <div class="d-flex gap-2">
            <a href="/si-akademik/public/mahasiswa" class="btn btn-primary">Kelola Data Mahasiswa</a>
            <a href="/si-akademik/public/prodi" class="btn btn-outline-primary">Lihat Data Prodi</a>
            <a href="/si-akademik/public/matakuliah" class="btn btn-outline-primary">Lihat Data Mata Kuliah</a>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>