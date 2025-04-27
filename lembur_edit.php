<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Tarif Lembur</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  
  <div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>
      <div class="p-4 w-100">
        <h2>Edit Tarif Lembur</h2>
        <form method="post">
            <div class="mb-3">
                <label>Tarif Per Jam</label>
                <input type="number" name="tarif_per_jam" class="form-control" value="<?= $data['tarif_per_jam'] ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="lembur.php" class="btn btn-secondary">Kembali</a>
        </form>

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

        if (isset($_POST['update'])) {
            $nama_jabatan = $_POST['nama_jabatan'];
            $tarif_per_jam = $_POST['tarif_per_jam'];

            $update = mysqli_query($conn, "UPDATE lembur SET tarif_per_jam = '$tarif_per_jam' WHERE id = $id");

            if ($update) {
                header("Location: lembur.php");
            } else {
                echo "Gagal mengupdate data: " . mysqli_error($conn);
            }

        }
        ?>

  </div>
</body>
</html>
