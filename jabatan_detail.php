<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM jabatan WHERE id='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jabatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container shadow p-5 mb-5 bg-body-tertiary rounded">
        <h2>Detail Jabatan</h2>
            <p><strong>Nama Jabatan:</strong> <?= $d['nama_jabatan'] ?></p>
            <p><strong>Gaji Pokok:</strong> Rp <?= number_format($d['gaji_pokok']) ?></p>
      <a href="jabatan.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
