<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Program Studi - SI Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Daftar Program Studi</h2>
    <hr>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama Prodi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($dataProdi)): ?>
                <?php $no = 1; foreach ($dataProdi as $prodi): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($prodi['id']); ?></td>
                    <td><?= htmlspecialchars($prodi['nama'] ?? $prodi['nama_prodi']); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">Data program studi kosong.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="/si-akademik/public/dashboard" class="btn btn-secondary">Kembali ke Dashboard</a>
</div>
</body>
</html>