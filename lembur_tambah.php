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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>

        body {
            font-family: "Lexend Deca", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
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
