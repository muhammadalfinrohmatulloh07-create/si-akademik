<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa - SI Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Daftar Mahasiswa</h2>
    <hr>
    <div class="row mb-3">
        <div class="col-md-6">
            <a href="/si-akademik/public/mahasiswa/create" class="btn btn-primary">Tambah Mahasiswa</a>
        </div>
        <div class="col-md-6">
            <form action="/si-akademik/public/mahasiswa" method="GET" class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="Cari Nama atau NIM..." value="<?= htmlspecialchars($_GET['keyword'] ?? ''); ?>">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                <?php if (!empty($_GET['keyword'])): ?>
                    <a href="/si-akademik/public/mahasiswa" class="btn btn-outline-danger">Reset</a>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Prodi</th>
                <th>Angkatan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($dataMahasiswa)): ?>
                <?php $no = 1; foreach ($dataMahasiswa as $mhs): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($mhs['nim']); ?></td>
                    <td><?= htmlspecialchars($mhs['nama']); ?></td>
                    <td><?= htmlspecialchars($mhs['email']); ?></td>
                    <td><?= htmlspecialchars($mhs['prodi_nama'] ?? '-'); ?></td>
                    <td><?= htmlspecialchars($mhs['angkatan']); ?></td>
                    <td>
                        <span class="badge bg-<?= $mhs['status'] == 'aktif' ? 'success' : 'secondary'; ?>">
                            <?= htmlspecialchars($mhs['status']); ?>
                        </span>
                    </td>
                    <td>
                        <a href="/si-akademik/public/mahasiswa/edit?id=<?= $mhs['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/si-akademik/public/mahasiswa/delete?id=<?= $mhs['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">Data mahasiswa tidak ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>