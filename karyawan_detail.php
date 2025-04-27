<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM karyawan 
    JOIN jabatan ON karyawan.jabatan_id = jabatan.id 
    WHERE karyawan.id='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container shadow p-5 mb-5 bg-body-tertiary rounded">
        <h2>Detail Karyawan</h2>
            <p><strong>Nama:</strong> <?= $d['nama'] ?></p>
            <p><strong>Jenis Kelamin:</strong> <?= $d['jenis_kelamin'] ?></p>
            <p><strong>Alamat:</strong> <?= $d['alamat'] ?></p>
            <p><strong>No. HP:</strong> <?= $d['no_hp'] ?></p>
            <p><strong>Jabatan:</strong> <?= $d['nama_jabatan'] ?></p>
            <img src="uploads/<?= $d['foto'] ?>" width="150"> <br> <br>
        <a href="karyawan.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
