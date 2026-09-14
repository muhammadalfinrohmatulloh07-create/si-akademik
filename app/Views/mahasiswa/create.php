<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa - SI Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Form Tambah Mahasiswa</h2>
    <hr>

    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    ?>

    <?php if ($flash): ?>
        <div class="alert alert-<?= htmlspecialchars($flash['type'] ?? 'info'); ?> alert-dismissible fade show mt-3" role="alert">
            <?= htmlspecialchars($flash['message'] ?? ''); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form action="/si-akademik/public/mahasiswa" method="POST" class="mt-3">
        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Mahasiswa</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <select name="prodi_id" class="form-select" required>
                <option value="1">Teknik Informatika</option>
                <option value="2">Sistem Informasi</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Angkatan</label>
            <input type="number" name="angkatan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status Mahasiswa</label>
            <select name="status" id="status" class="form-select" required>
                <option value="aktif">Aktif</option>
                <option value="cuti">Cuti</option>
                <option value="lulus">Lulus</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/si-akademik/public/mahasiswa" class="btn btn-secondary">Batal</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>