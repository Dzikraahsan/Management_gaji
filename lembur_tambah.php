<?php ob_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $jabatan_id = $_POST['jabatan_id'];
    $tarif_per_jam = $_POST['tarif_per_jam'];

    // Ambil nama jabatan dari DB
    $cek_jabatan = mysqli_query($conn, "SELECT nama_jabatan FROM jabatan WHERE id = $jabatan_id");
    $row = mysqli_fetch_assoc($cek_jabatan);
    $nama_jabatan = $row['nama_jabatan'];

    $insert = mysqli_query($conn, "INSERT INTO lembur (jabatan_id, nama_jabatan, tarif_per_jam) 
                                   VALUES ('$jabatan_id', '$nama_jabatan', '$tarif_per_jam')");

    if ($insert) {
        header("Location: lembur.php?tambah=sukses");
        exit;
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($conn);
    }
}
ob_end_flush(); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tarif Lembur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preload" href="/assets/fonts/Organetto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <style>

        body {
        font-family: 'Organetto', sans-serif !important;
        font-optical-sizing: auto;
        font-weight: normal;
        font-style: normal;
        }

        @font-face {
        font-family: 'Organetto';
        src: url('assets/fonts/Organetto-Regular.woff2') format('woff2');
        font-weight: normal;
        font-style: normal;
        font-display: swap;
        }

        body h3 {
            text-align: center;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>
<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>
    <div class="container mt-4" style="width: 900px;">
        <h3>TAMBAH TARIF LEMBUR</h3>
        <form method="post">
            <div class="mb-3">
                <label for="jabatan_id" class="form-label">Jabatan</label>
                <select name="jabatan_id" id="jabatan_id" class="form-select" required>
                    <option value="">-- Pilih Jabatan --</option>
                    <?php
                    $jabatan = mysqli_query($conn, "SELECT * FROM jabatan");
                    while ($row = mysqli_fetch_assoc($jabatan)) {
                        echo '<option value="' . $row['id'] . '">' . $row['nama_jabatan'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tarif_per_jam" class="form-label">Tarif Per Jam (Rp)</label>
                <input type="number" name="tarif_per_jam" id="tarif_per_jam" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-outline-primary">Simpan</button>
            <a href="lembur.php" class="btn btn-outline-secondary">Kembali</a>
        </form>
    </div>
</div>
</body>
</html>
