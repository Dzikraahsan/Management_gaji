
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
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="lembur.php" class="btn btn-secondary">Kembali</a>
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
