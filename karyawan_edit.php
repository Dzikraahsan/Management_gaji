<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM karyawan WHERE id = $id");
$karyawan = mysqli_fetch_assoc($data);

// Ambil rating bulan sekarang
$bulan = date('Y-m');
$rating = mysqli_query($conn, "SELECT * FROM rating WHERE karyawan_id = $id AND bulan = '$bulan'");
$ratingData = mysqli_fetch_assoc($rating);
$nilai_rating = $ratingData ? $ratingData['nilai_rating'] : '';
$foto_lama = $karyawan['foto'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jabatan_id = $_POST['jabatan_id'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $nilai_rating = $_POST['nilai_rating'];

    // Upload foto baru jika ada
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $upload_dir = 'uploads/';

    if ($foto != "") {
        move_uploaded_file($tmp, $upload_dir . $foto);
    } else {
        $foto = $foto_lama;
    }

    $update = mysqli_query($conn, "UPDATE karyawan SET 
        nama = '$nama', jabatan_id = '$jabatan_id', 
        alamat = '$alamat', no_hp = '$no_hp', foto = '$foto'
        WHERE id = $id");

    if ($update) {
        // Cek apakah rating bulan ini sudah ada
        $cek = mysqli_query($conn, "SELECT * FROM rating WHERE karyawan_id = $id AND bulan = '$bulan'");
        if (mysqli_num_rows($cek) > 0) {
            mysqli_query($conn, "UPDATE rating SET nilai_rating = '$nilai_rating' WHERE karyawan_id = $id AND bulan = '$bulan'");
        } else {
            mysqli_query($conn, "INSERT INTO rating (karyawan_id, bulan, nilai_rating) VALUES ('$id', '$bulan', '$nilai_rating')");
        }

        header("Location: karyawan.php");
        exit;
    } else {
        echo "Gagal mengupdate data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>
    <div class="p-4 w-100">
        <h3>Edit Data Karyawan</h3>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $karyawan['nama'] ?>" required>
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
                <label class="form-label">Foto Lama</label><br>
                <img src="uploads/<?= $karyawan['foto'] ?>" width="120" class="mb-2">
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
                <label class="form-label">Rating Bulan Ini</label>
                <select name="nilai_rating" class="form-select" required>
                    <option value="">-- Pilih Rating --</option>
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        $selected = $i == $nilai_rating ? 'selected' : '';
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="karyawan.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
</body>
</html>
