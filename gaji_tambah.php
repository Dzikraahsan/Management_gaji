<?php
// Koneksi langsung, tanpa include
$conn = mysqli_connect("localhost", "root", "", "management_gaji");
include 'includes\header.php';
include 'includes\sidebar.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Uji Tambah Gaji</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-4">
    <h2>Tambah Data Gaji</h2>
    <form action="" method="post">
      <div class="mb-3">
        <label>Nama Karyawan</label>
        <select name="karyawan_id" class="form-control" required>
          <option value="">-- Pilih --</option>
          <?php
          $res = mysqli_query($conn, "SELECT * FROM karyawan");
          while ($k = mysqli_fetch_assoc($res)) {
            echo "<option value='{$k['id']}'>{$k['nama']}</option>";
          }
          ?>
        </select>
      </div>
      <div class="mb-3">
        <label>Bulan</label>
        <input type="text" name="bulan" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Gaji Pokok</label>
        <input type="number" name="gaji_pokok" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Tarif Lembur</label>
        <input type="number" name="tarif_lembur" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Bonus Rating</label>
        <input type="number" name="bonus_rating" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Total Gaji</label>
        <input type="number" name="total_gaji" class="form-control" required>
      </div>
      <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
      <a href="gaji.php" class="btn btn-secondary">Kembali</a>
    </form>
    <?php
    if (isset($_POST['simpan'])) {
      $kid = $_POST['karyawan_id'];
      $bulan = $_POST['bulan'];
      $gaji_pokok = $_POST['gaji_pokok'];
      $tarif_lembur = $_POST['tarif_lembur'];
      $bonus_rating = $_POST['bonus_rating'];
      $gaji = $_POST['total_gaji'];
      mysqli_query($conn, "INSERT INTO gaji (karyawan_id, bulan, gaji_pokok, tarif_lembur, bonus_rating, total_gaji) VALUES ('$kid', '$bulan', '$gaji_pokok', '$tarif_lembur', '$bonus_rating', '$gaji')");
      echo "<script>location.href='gaji.php';</script>";
    }
    ?>
  </div>
</body>
</html>
