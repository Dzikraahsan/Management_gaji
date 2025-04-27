<?php include 'koneksi.php'; ?>
<?php
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM jabatan WHERE id=$id");
$row = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Jabatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>
    <div class="p-4 w-100">
        <h2>Edit Jabatan</h2>
        <form method="post">
            <div class="mb-3">
                <label>Nama Jabatan</label>
                <input type="text" name="nama_jabatan" class="form-control" value="<?= $row['nama_jabatan'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Gaji Pokok</label>
                <input type="number" name="gaji_pokok" class="form-control" value="<?= $row['gaji_pokok'] ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="jabatan.php" class="btn btn-secondary">Kembali</a>
        </form>

        <?php
        if (isset($_POST['update'])) {
            $nama = $_POST['nama_jabatan'];
            $gaji = $_POST['gaji_pokok'];
            mysqli_query($conn, "UPDATE jabatan SET nama_jabatan='$nama', gaji_pokok='$gaji' WHERE id=$id");
            echo "<script>window.location='jabatan.php';</script>";
        }
        ?>
    </div>
</div>
</body>
</html>
