
<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM lembur WHERE id = $id");
if ($query && $row = mysqli_fetch_assoc($query)) {
    $data = $row;
} else {
    echo "Data tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Tarif Lembur</title>
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
        <h3>EDIT TARIF LEMBUR KARYAWAN</h3>
        <form method="post">
          <div class="mb-3">
                <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                  <select name="jabatan_id" class="form-control" required>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM jabatan");
                    while ($jabatan = mysqli_fetch_assoc($result)) {
                        $selected = $jabatan['id'] == $data['jabatan_id'] ? 'selected' : '';
                        echo "<option value='{$jabatan['id']}' $selected>{$jabatan['nama_jabatan']}</option>";
                    }
                    ?>
                  </select>                  
            </div>
            <div class="mb-3">
                <label>Tarif Per Jam</label>
                <input type="number" name="tarif_per_jam" class="form-control" value="<?= $data['tarif_per_jam'] ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-outline-primary">Update</button>
            <a href="lembur.php" class="btn btn-outline-secondary">Kembali</a>
        </form>

        <?php

        if (isset($_POST['update'])) {
            $jabatan_id = $_POST['jabatan_id'];
            $tarif_per_jam = $_POST['tarif_per_jam'];

            $update = mysqli_query($conn, "UPDATE lembur SET jabatan_id = '$jabatan_id', tarif_per_jam = '$tarif_per_jam' WHERE id = $id");


            if ($update) {
                header("Location: lembur.php?edit=sukses");
            } else {
                echo "Gagal mengupdate data: " . mysqli_error($conn);
            }

        }
        ?>

  </div>
</body>
</html>
