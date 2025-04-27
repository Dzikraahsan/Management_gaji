<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT gaji.*, karyawan.nama FROM gaji 
    JOIN karyawan ON gaji.karyawan_id = karyawan.id 
    WHERE gaji.id='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Gaji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container shadow p-5 mb-5 bg-body-tertiary rounded">
        <h2>Detail Gaji Karyawan</h2>
            <p><strong>Nama Karyawan:</strong> <?= $d['nama'] ?></p>
            <p><strong>Bulan:</strong> <?= $d['bulan'] ?></p>
            <p><strong>Gaji Pokok:</strong> Rp <?= number_format($d['gaji_pokok']) ?></p>
            <p><strong>Tarif Lembur:</strong> Rp <?= number_format($d['tarif_lembur']) ?></p>
            <p><strong>Bonus Rating:</strong> Rp <?= number_format($d['bonus_rating']) ?></p>
            <p><strong>Total Gaji:</strong> Rp <?= number_format($d['total_gaji']) ?></p>
      <a href="gaji.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
