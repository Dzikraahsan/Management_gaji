<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $jabatan_id = $_POST['jabatan_id'];
    $tarif_per_jam = $_POST['tarif_per_jam'];

    $insert = mysqli_query($conn, "INSERT INTO lembur (jabatan_id, tarif_per_jam) 
                                   VALUES ('$jabatan_id', '$tarif_per_jam')");

    if ($insert) {
        header("Location: lembur.php");
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tarif Lembur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>
    <div class="p-4 w-100">
        <h3>Tambah Tarif Lembur</h3>
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
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <a href="lembur.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
</body>
</html>
