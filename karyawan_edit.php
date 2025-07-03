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
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jabatan_id = $_POST['jabatan_id'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $status_ = $_POST['status_'];
    $nilai_rating = $_POST['nilai_rating'];
    $tgl_bergabung = $_POST['tgl_bergabung'];

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
        nama = '$nama', umur = '$umur', jenis_kelamin = '$jenis_kelamin',
        jabatan_id = '$jabatan_id', 
        alamat = '$alamat', no_hp = '$no_hp', status_ = '$status_', foto = '$foto', tgl_bergabung = '$tgl_bergabung'
        WHERE id = $id");

    if ($update) {
        // Cek apakah rating bulan ini sudah ada
        $cek = mysqli_query($conn, "SELECT * FROM rating WHERE karyawan_id = $id AND bulan = '$bulan'");
        if (mysqli_num_rows($cek) > 0) {
            mysqli_query($conn, "UPDATE rating SET nilai_rating = '$nilai_rating' WHERE karyawan_id = $id AND bulan = '$bulan'");
        } else {
            mysqli_query($conn, "INSERT INTO rating (karyawan_id, bulan, nilai_rating) VALUES ('$id', '$bulan', '$nilai_rating')");
        }

        header("Location: karyawan.php?edit=sukses");
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

        /* kode responsive */
        @media (max-width: 768px) {
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
                <img src="uploads/<?= $karyawan['foto'] ?>" width="120" class="mb-2">
                <input type="file" name="foto" class="form-control" accept="image/*">
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
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Bergabung</label>
                <input type="date" name="tgl_bergabung" class="form-control" value="<? $karyawan['tgl_bergabung'] ?>" required>
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
