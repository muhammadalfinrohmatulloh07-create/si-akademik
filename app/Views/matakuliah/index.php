<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mata Kuliah - SI Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Daftar Mata Kuliah</h2>
    <hr>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($dataMatakuliah)): ?> <!-- Ubah jadi $dataMatakuliah -->
                <?php $no = 1; foreach ($dataMatakuliah as $mk): ?> <!-- Ubah jadi $dataMatakuliah -->
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($mk['kode'] ?? '-'); ?></td>
                    <td><?= htmlspecialchars($mk['nama'] ?? '-'); ?></td>
                    <td><?= htmlspecialchars($mk['sks'] ?? '-'); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Data mata kuliah kosong.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="/si-akademik/public/dashboard" class="btn btn-secondary">Kembali ke Dashboard</a>
</div>
</body>
</html>