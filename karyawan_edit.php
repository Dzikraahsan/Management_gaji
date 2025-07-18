<?php
include 'koneksi.php';
require 'vendor/autoload.php';

use Cloudinary\Cloudinary;

// Setup Cloudinary
$cloudinary = new Cloudinary([
  'cloud' => [
    'cloud_name' => 'da4fjxm1e',
    'api_key'    => '343439727781135',
    'api_secret' => 'S1DmLYGdbh0wNxc_FLygF9wi1WM',
  ]
]);

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM karyawan WHERE id = $id");
$karyawan = mysqli_fetch_assoc($data);

$foto_lama = $karyawan['foto'];
$bulan = date('Y-m');
$rating = mysqli_query($conn, "SELECT * FROM rating WHERE karyawan_id = $id AND bulan = '$bulan'");
$ratingData = mysqli_fetch_assoc($rating);
$nilai_rating = $ratingData ? $ratingData['nilai_rating'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jabatan_id = $_POST['jabatan_id'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $status_ = $_POST['status_'];
    $nilai_rating = $_POST['nilai_rating'];
    $tgl_bergabung = $_POST['tgl_bergabung'];

    // ✅ Upload Foto Baru ke Cloudinary (jika ada)
    $url_foto = $foto_lama;
    if (isset($_FILES['foto']) && $_FILES['foto']['tmp_name'] != '') {
        try {
            $upload = $cloudinary->uploadApi()->upload($_FILES['foto']['tmp_name'], [
                'folder' => 'karyawan_foto'
            ]);
            $url_foto = $upload['secure_url'];
        } catch (Exception $e) {
            echo "❌ Upload gagal: " . $e->getMessage();
            exit;
        }
    }

    // Jika kosong banget (tidak ada foto baru dan lama), pakai default
    if (!$url_foto) {
        $url_foto = 'https://res.cloudinary.com/da4fjxm1e/image/upload/v1751782178/karyawan_foto/default.jpg';
    }

    $update = mysqli_query($conn, "UPDATE karyawan SET 
        nama = '$nama',
        umur = '$umur',
        jenis_kelamin = '$jenis_kelamin',
        jabatan_id = '$jabatan_id',
        alamat = '$alamat',
        no_hp = '$no_hp',
        status_ = '$status_',
        foto = '$url_foto',
        tgl_bergabung = '$tgl_bergabung'
        WHERE id = $id");

    if ($update) {
        // Update rating bulan ini
        $cek = mysqli_query($conn, "SELECT * FROM rating WHERE karyawan_id = $id AND bulan = '$bulan'");
        if (mysqli_num_rows($cek) > 0) {
            mysqli_query($conn, "UPDATE rating SET nilai_rating = '$nilai_rating' WHERE karyawan_id = $id AND bulan = '$bulan'");
        } else {
            mysqli_query($conn, "INSERT INTO rating (karyawan_id, bulan, nilai_rating) VALUES ('$id', '$bulan', '$nilai_rating')");
        }

        header("Location: karyawan.php?edit=sukses");
        exit;
    } else {
        echo "❌ Gagal mengupdate data.";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Karyawan</title>
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
        <h3>Edit Data Karyawan</h3>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $karyawan['nama'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Umur</label>
                <input type="text" name="umur" class="form-control" value="<?= $karyawan['umur'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <input type="text" name="jenis_kelamin" class="form-control" value="<?= $karyawan['jenis_kelamin'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <select name="jabatan_id" class="form-select" required>
                    <option value="">-- Pilih Jabatan --</option>
                    <?php
                    $jabatan = mysqli_query($conn, "SELECT * FROM jabatan");
                    while ($row = mysqli_fetch_assoc($jabatan)) {
                        $selected = $row['id'] == $karyawan['jabatan_id'] ? 'selected' : '';
                        echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['nama_jabatan'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required><?= $karyawan['alamat'] ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control" value="<?= $karyawan['no_hp'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status Karyawan</label>
                <input type="text" name="status_" class="form-control" value="<?= $karyawan['status_'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Foto Lama</label><br>
                <img src="<?= $karyawan['foto'] ?: 'https://res.cloudinary.com/da4fjxm1e/image/upload/v1751782178/karyawan_foto/default.jpg' ?>" width="120" class="mb-2 rounded shadow">
            </div>

            <div class="mb-3">
                <label class="form-label">Ganti Foto (opsional)</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
                <small class="text-muted">Pilih foto baru jika ingin mengganti foto lama.</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Rating Bulan Ini</label>
                <div class="star-rating" style="font-size: 1.5rem; cursor: pointer;">
                    <?php
                    $nilai_rating = isset($nilai_rating) ? $nilai_rating : 0;
                    for ($i = 1; $i <= 5; $i++) {
                        $checked = $i == $nilai_rating ? 'checked' : '';
                        echo "<input type='radio' id='star$i' name='nilai_rating' value='$i' $checked hidden>
                              <label for='star$i' style='color: ".($i <= $nilai_rating ? '#FFD700' : '#ccc').";' onclick='setStars($i)'>★</label>";
                    }
                    ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Bergabung</label>
                <input type="date" name="tgl_bergabung" class="form-control" value="<?= $karyawan['tgl_bergabung'] ?>" required>
            </div>
            <button type="submit" class="btn btn-outline-primary">Update</button>
            <a href="karyawan.php" class="btn btn-outline-secondary">Batal</a>
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
