<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $karyawan_id = $_POST['karyawan_id'];
    $bulan = $_POST['bulan'];
    $nilai_rating = $_POST['nilai_rating'];

    $query = mysqli_query($conn, "INSERT INTO rating (karyawan_id, bulan, nilai_rating) 
                                  VALUES ('$karyawan_id', '$bulan', '$nilai_rating')");
    if ($query) {
        header("Location: rating.php?tambah=sukses");
    } else {
        echo "Gagal menambahkan data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Rating</title>
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
        <h3>TAMBAH RATING KARYAWAN</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="karyawan_id" class="form-label">Nama Karyawan</label>
                <select name="karyawan_id" id="karyawan_id" class="form-select" required>
                    <option value="">Pilih Karyawan</option>
                    <?php
                    $data = mysqli_query($conn, "SELECT * FROM karyawan");
                    while ($row = mysqli_fetch_assoc($data)) {
                        echo '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="bulan" class="form-label">Bulan</label>
                <input type="text" name="bulan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nilai_rating" class="form-label">Nilai Rating</label>
                <input type="number" name="nilai_rating" class="form-control" required>
            </div>
            <button type="submit" name="simpan" class="btn btn-outline-success">Simpan</button>
            <a href="rating.php" class="btn btn-outline-secondary">Kembali</a>
        </form>
    </div>
</div>
</body>
</html>
