<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Jabatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>
    <div class="p-4 w-100">
        <h2>Daftar Jabatan</h2>
        <a href="jabatan_tambah.php" class="btn btn-primary mb-3">+ Tambah Jabatan</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Jabatan</th>
                    <th>Gaji Pokok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = mysqli_query($conn, "SELECT * FROM jabatan");
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<tr>
                        <td>" . $no . "</td>
                        <td>" . $row['nama_jabatan'] . "</td>
                        <td>Rp " . number_format(is_numeric($row['gaji_pokok']) ? $row['gaji_pokok'] : 0, 0, ',', '.') . "</td>
                        <td>
                        <a href='jabatan_edit.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Edit</a> <a href='jabatan_detail.php?id=" . $row['id'] . "' class='btn btn-info btn-sm'>Detail</a>
                        <a href='jabatan_hapus.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                        </td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
