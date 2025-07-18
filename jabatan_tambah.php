<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jabatan</title>
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
        <h3>TAMBAH JABATAN BARU</h3>
        <form method="post">
            <div class="mb-3">
                <label>Nama Jabatan</label>
                <input type="text" name="nama_jabatan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Gaji Pokok</label>
                <input type="number" name="gaji_pokok" class="form-control" required>
            </div>
            <button type="submit" name="simpan" class="btn btn-outline-success">Simpan</button>
            <a href="jabatan.php" class="btn btn-outline-secondary">Kembali</a>
        </form>

        <?php
        if (isset($_POST['simpan'])) {
            $nama = $_POST['nama_jabatan'];
            $gaji = $_POST['gaji_pokok'];
            mysqli_query($conn, "INSERT INTO jabatan (nama_jabatan, gaji_pokok) VALUES ('$nama', '$gaji')");
            echo "<script>window.location='jabatan.php';</script>";

            header("Location: jabatan.php?tambah=sukses");
        }
        ?>
    </div>
</div>
</body>
</html>
