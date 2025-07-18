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

        body h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
    </style>
</head>
<body>
<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>
    <div class="container mt-4" style="width: 900px;">
        <h2>EDIT JABATAN</h2>
        <form method="post">
            <div class="mb-3">
                <label>Nama Jabatan</label>
                <input type="text" name="nama_jabatan" class="form-control" value="<?= $row['nama_jabatan'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Gaji Pokok</label>
                <input type="number" name="gaji_pokok" class="form-control" value="<?= $row['gaji_pokok'] ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-outline-primary">Update</button>
            <a href="jabatan.php" class="btn btn-outline-secondary">Kembali</a>
        </form>

        <?php
        if (isset($_POST['update'])) {
            $nama = $_POST['nama_jabatan'];
            $gaji = $_POST['gaji_pokok'];
            mysqli_query($conn, "UPDATE jabatan SET nama_jabatan='$nama', gaji_pokok='$gaji' WHERE id=$id");
            echo "<script>window.location='jabatan.php';</script>";

            header("Location: jabatan.php?edit=sukses");
        }
        ?>
    </div>
</div>
</body>
</html>
