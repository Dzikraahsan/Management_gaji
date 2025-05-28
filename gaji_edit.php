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
  <script src="https://cdn.tailwindcss.com"></script>
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
            <h3>EDIT GAJI KARYAWAN</h3>
            <form action="" method="post">
              <div class="mb-3">
                <label for="karyawan_id" class="form-label">Nama Karyawan</label>
                <select name="karyawan_id" class="form-select" required>
                    <?php
                    $karyawan = mysqli_query($conn, "SELECT * FROM gaji");
                    while ($row = mysqli_fetch_assoc($karyawan)) {
                        $selected = ($row['id'] == $data['karyawan_id']) ? "selected" : "";
                        echo "<option value='{$row['id']}' $selected>{$row['nama_karyawan']}</option>";
                    }
                    ?>
                </select>
            </div>
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
              $nama_karyawan = $_POST['nama_karyawan'];
              $gaji_pokok = $_POST['gaji_pokok'];
              $tarif_lembur = $_POST['tarif_lembur'];
              $bonus_rating = $_POST['bonus_rating'];
              $gaji = $_POST['total_gaji'];
              mysqli_query($conn, "UPDATE gaji SET bulan = '$bulan', nama_karyawan = '$nama_karyawan', gaji_pokok = '$gaji_pokok', tarif_lembur = '$tarif_lembur', bonus_rating = '$bonus_rating', total_gaji = '$gaji' WHERE id = $id");
              echo "<script>location.href='gaji.php';</script>";
            }
            ?>
          </div>
  </div>
  
</body>
</html>
