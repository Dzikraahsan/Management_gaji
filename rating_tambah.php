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
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            <a href="rating.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
</body>
</html>
