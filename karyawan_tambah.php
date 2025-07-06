<?php ob_start(); // aktifkan output buffering
include 'koneksi.php';

require 'vendor/autoload.php'; // Composer autoload

use Cloudinary\Cloudinary;

// Koneksi ke Cloudinary
$cloudinary = new Cloudinary([
  'cloud' => [
    'cloud_name' => 'da4fjxm1e',
    'api_key'    => '343439727781135',
    'api_secret' => 'S1DmLYGdbh0wNxc_FLygF9wi1WM',
  ]
]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jabatan_id = $_POST['jabatan_id'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $status_ = $_POST['status_'];
    $nilai_rating = $_POST['nilai_rating'];
    $tgl_bergabung = $_POST['tgl_bergabung'];

    // ==== ✅ UPLOAD FOTO KE CLOUDINARY ====
    $url_foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['tmp_name'] != '') {
        try {
            $upload = $cloudinary->uploadApi()->upload($_FILES['foto']['tmp_name'], [
                'folder' => 'karyawan_foto'
            ]);
            $url_foto = $upload['secure_url']; // simpan URL gambar
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Gagal mengupload foto: " . $e->getMessage() . "</div>";
        }
    }

    // ==== ✅ SIMPAN KE DATABASE ====
    $query = mysqli_query($conn, "INSERT INTO karyawan (nama, umur, jenis_kelamin, jabatan_id, alamat, no_hp, status_, foto, nilai_rating, tgl_bergabung)
                            VALUES ('$nama', '$umur', '$jenis_kelamin', '$jabatan_id', '$alamat', '$no_hp', '$status_', '$url_foto', '$nilai_rating', '$tgl_bergabung')");

    if ($query) {
        $karyawan_id = mysqli_insert_id($conn);
        $bulan = date('Y-m');
        mysqli_query($conn, "INSERT INTO rating (karyawan_id, bulan, nilai_rating) 
                             VALUES ('$karyawan_id', '$bulan', '$nilai_rating')");
        header("Location: karyawan.php?tambah=sukses");
        exit;
    } else {
        echo "❌ Gagal menambahkan data.";
    }
}
ob_end_flush(); ?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>

        body {
            font-family: "Lexend Deca", sans-serif;
            font-optical-sizing: auto;
            font-weight: normal;
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
        <h3>TAMBAH DATA KARYAWAN</h3>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Umur</label>
                <input type="text" name="umur" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <select name="jabatan_id" class="form-select" required>
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
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status Karyawan</label>
                <select name="status_" class="form-select" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/*" >
            </div>
            <div class="mb-3">
                <label class="form-label">Rating Bulan Ini</label>
                <div class="star-rating" style="font-size: 1.5rem; cursor: pointer;">
                    <?php
                    $nilai_rating = isset($nilai_rating) ? $nilai_rating : 0;
                    for ($i = 1; $i <= 5; $i++) {
                        $checked = $i == $nilai_rating ? 'checked' : '';
                        echo "
                            <input type='radio' id='star$i' name='nilai_rating' value='$i' $checked hidden>
                            <label for='star$i' style='color: ".($i <= $nilai_rating ? '#FFD700' : '#ccc').";' onclick='setStars($i)'>★</label>
                        ";
                    }
                    ?>
                </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Bergabung</label>
                <input type="date" name="tgl_bergabung" class="form-control" required>
            </div>

            </div>
            <button type="submit" class="btn btn-outline-success">Simpan</button>
            <a href="karyawan.php" class="btn btn-outline-secondary">Kembali</a>
        </form>
    </div>
</div>

     <script>
        function setStars(rating) {
            for (let i = 1; i <= 5; i++) {
                const star = document.querySelector("label[for='star" + i + "']");
                star.style.color = i <= rating ? '#FFD700' : '#ccc';
            }
        }
    </script>

</body>
</html>
