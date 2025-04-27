<?php
include 'koneksi.php';
include 'includes\header.php';
include 'includes\sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
<div class="container mt-4">
    <h3>Daftar Gaji Karyawan</h3>
    <a href="gaji_tambah.php" class="btn btn-primary mb-3">+ Tambah Gaji</a>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Bulan</th>
                <th>Total Gaji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($conn, "SELECT gaji.id, karyawan.nama, gaji.bulan, gaji.total_gaji 
                                             FROM gaji 
                                             JOIN karyawan ON gaji.karyawan_id = karyawan.id 
                                             ORDER BY gaji.bulan DESC");
            while($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $data['nama'] ?></td>
                <td><?= $data['bulan'] ?></td>
                <td>Rp <?= number_format($data['total_gaji'], 0, ',', '.') ?></td>
                <td>
                    <a href="gaji_edit.php?id=<?= $data['id'] ?>" class="btn btn-warning btn-sm">Edit</a> <a href="gaji_detail.php?id=<?= $data['id'] ?>" class="btn btn-info btn-sm">Detail</a>
                    <a href="gaji_hapus.php?id=<?= $data['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php include 'includes\footer.php'; ?>
