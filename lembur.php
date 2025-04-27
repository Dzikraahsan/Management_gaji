<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tarif Lembur - Sistem Manajemen Gaji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>
    <div class="p-4 w-100">
        <h3>Daftar Tarif Lembur</h3>
        <a href="lembur_tambah.php" class="btn btn-primary mb-3">+ Tambah Tarif</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Jabatan</th>
                    <th>Tarif Per Jam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = mysqli_query($conn, "SELECT lembur.*, jabatan.nama_jabatan FROM lembur 
                                              JOIN jabatan ON lembur.jabatan_id = jabatan.id 
                                              ORDER BY lembur.id DESC");
                while ($row = mysqli_fetch_assoc($query)) {
                    echo '
                    <tr>
                        <td>' . $no++ . '</td>
                        <td>' . $row['nama_jabatan'] . '</td>
                        <td>Rp ' . number_format($row['tarif_per_jam'], 0, ',', '.') . '</td>
                        <td>
                            <a href="lembur_edit.php?id=' . $row['id'] . '" class="btn btn-sm btn-warning">Edit</a> <a href="lembur_detail.php?id=' . $row['id'] . '" class="btn btn-info btn-sm">Detail</a>
                            <a href="lembur_hapus.php?id=' . $row['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</a>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
