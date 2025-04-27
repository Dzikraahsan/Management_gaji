<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM gaji WHERE id = $id"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Gaji</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-4">
    <h2>Edit Gaji</h2>
    <form action="" method="post">
      <div class="mb-3">
        <label>Bulan</label>
        <input type="text" name="bulan" class="form-control" value="<?= $data['bulan'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Gaji Pokok</label>
        <input type="number" name="gaji_pokok" class="form-control" value="<?= $data['gaji_pokok'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Tarif Lembur</label>
        <input type="number" name="tarif_lembur" class="form-control" value="<?= $data['tarif_lembur'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Bonus Rating</label>
        <input type="number" name="bonus_rating" class="form-control" value="<?= $data['bonus_rating'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Total Gaji</label>
        <input type="number" name="total_gaji" class="form-control" value="<?= $data['total_gaji'] ?>" required>
      </div>
      <button type="submit" name="update" class="btn btn-primary">Update</button>
      <a href="gaji.php" class="btn btn-secondary">Kembali</a>
    </form>
    <?php
    if (isset($_POST['update'])) {
      $bulan = $_POST['bulan'];
      $gaji_pokok = $_POST['gaji_pokok'];
      $tarif_lembur = $_POST['tarif_lembur'];
      $bonus_rating = $_POST['bonus_rating'];
      $gaji = $_POST['total_gaji'];
      mysqli_query($conn, "UPDATE gaji SET bulan = '$bulan', gaji_pokok = '$gaji_pokok', tarif_lembur = '$tarif_lembur', bonus_rating = '$bonus_rating', total_gaji = '$gaji' WHERE id = $id");
      echo "<script>location.href='gaji.php';</script>";
    }
    ?>
  </div>
</body>
</html>
